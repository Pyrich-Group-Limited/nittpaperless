<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ChartOfAccount;
use App\Models\User;

class SpecialDutyHeadApprovalComponent extends Component
{
    public $requisition;
    public $comments;
    public $selRequisition;
    public $actionId;

    public $chartAccount;
    public $secretCode;
    public $showSecretCodeModal = false;

    public function mount()
    {
        $user = auth()->user();

            $this->requisitions = StaffRequisition::where('status','liaison_head_approved')
            ->whereDoesntHave('approvalRecords', function ($query) use ($user) {
                $query->where('approver_id', $user->id)
                    ->where('role', $user->type);
            })->orderBy('created_at', 'desc')->get();

        $this->dgApprovedrequisitions = StaffRequisition::whereHas('approvalRecords', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('role', $user->type)
                ->where('status', 'approved');
        })->orderBy('created_at', 'desc')->get();

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

    public function specialDutyApproveRequisition()
    {
        if ($this->selRequisition->status != 'liaison_head_approved') {
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

        $approverId = User::where('type','dg')->first();

        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect!"]);
            return;
        }

        $this->selRequisition->update(['status' => 'special_duty_head_approved']);

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
                route('dg.requisitions')
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
        return view('livewire.requisitions.special-duty-head-approval-component');
    }
}
