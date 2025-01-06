<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ChartOfAccount;
use App\Models\User;

class LiaisonHeadApprovalComponent extends Component
{
    public $requisition;
    public $comments;
    public $selRequisition;
    public $actionId;

    public $chartAccount;
    public $secretCode; // To store the secret code input
    public $showSecretCodeModal = false;

    public function mount()
    {
        $user = auth()->user();

        $this->requisitions = StaffRequisition::with('approvalRecords.approver.signature')
            ->where('status', 'liaison_head_approval')
            ->whereDoesntHave('approvalRecords', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('role', $user->type);
        })->where('location',Auth::user()->location_type)->orderBy('created_at', 'desc')->get();

        $this->dgApprovedrequisitions = StaffRequisition::with('approvalRecords.approver.signature')
            ->whereHas('approvalRecords', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('role', $user->type)
                ->where('status', 'approved');
        })->where('location',Auth::user()->location_type)->orderBy('created_at', 'desc')->get();

        $this->accounts = ChartOfAccount::all();
    }

    public function setRequisition(StaffRequisition $requisition){
        $this->selRequisition = $requisition;
    }

    public function downloadFile($supporting_document)
    {
        $filePath = public_path('assets/documents/documents/' . $this->selRequisition->supporting_document);

        if (file_exists($filePath)) {
            return response()->download($filePath, $this->selRequisition->supporting_document);
        } else {
            $this->dispatchBrowserEvent('error',["error" =>"Document not found!."]);
        }
    }

    public function liaisonHeadApproveRequisition()
    {
        if ($this->selRequisition->status != 'liaison_head_approval') {
            $this->dispatchBrowserEvent('error', ["error" => "Requisition requires an approval."]);
            return;
        }
        $this->showSecretCodeModal = true;
        $this->dispatchBrowserEvent('showSecretCodeModal');
    }

    public function verifyAndApprove()
    {
        $this->validate([
            'secretCode' => 'required',
        ]);

        $approverId = User::where('type', '!=', 'super admin')->where('type', '!=', 'DG')
            ->whereHas('permissions', function ($query) {
                $query->where('name', 'approve as special duty');
            })->first();

        if (!$approverId) {
            $this->dispatchBrowserEvent('error',["error" =>"No next approver found with the special duty approval permission"]);
            return;
        }

        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect!"]);
            return;
        }

        $this->selRequisition->update(['status' => 'liaison_head_approved']);

        RequisitionApprovalRecord::create([
            'requisition_id' => $this->selRequisition->id,
            'approver_id' => auth()->id(),
            'role' => auth()->user()->type,
            'status' => 'approved',
            'comments' => $this->comments,
        ]);

        if ($approverId) {
            createNotification(
                $approverId->id,
                'Requsition Approval Request',
                'A new Requsition from '. Auth::user()->name.' requires your approval.',
                route('sd.requisitions')
            );
        }
        $this->reset(['secretCode', 'comments', 'selRequisition']);
        $this->dispatchBrowserEvent('success',["success" =>"Requisition approved successfully."]);

        $this->mount();
    }

    public function rejectRequisition()
    {
        RequisitionApprovalRecord::create([
            'requisition_id' => $this->selRequisition->id,
            'approver_id' => auth()->id(),
            'role' => auth()->user()->type,
            'status' => 'rejected',
            'comments' => $this->comments,
        ]);
        $this->requisition->update(['status' => 'rejected']);
        $this->dispatchBrowserEvent('success',["success" =>"Requisition rejected."]);

        $this->mount();
    }

    public function render()
    {
        return view('livewire.requisitions.liaison-head-approval-component');
    }
}
