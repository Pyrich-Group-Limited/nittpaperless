<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ChartOfAccount;
use App\Models\User;

class HodRequisitionsComponent extends Component
{
    // protected $listeners = ['approveRequisition', 'rejectRequisition'];

    public $requisition;
    public $comments;
    public $selRequisition;
    public $actionId;

    public $chartAccount;

    public $approvals;
    public $selectedRequisitionId;

    public $secretCode; // To store the secret code input
    public $showSecretCodeModal = false;

    public function mount()
    {
        $user = auth()->user();

        $this->requisitions = StaffRequisition::with('approvalRecords.approver.signature')
            ->where('status', 'pending')
            ->whereDoesntHave('approvalRecords', function ($query) use ($user) {
                $query->where('approver_id', $user->id)
                    ->where('role', $user->type);
            })->where('department_id', $user->department_id)
            ->where('location', $user->location_type)
            ->orderBy('created_at', 'desc')->get();

        $this->approvedRequisitions = StaffRequisition::with('approvalRecords.approver.signature')
            ->whereHas('approvalRecords', function ($query) use ($user) {
                $query->where('approver_id', $user->id)
                    ->where('role', $user->type)
                    ->where('status', 'approved');
            })->where('department_id', $user->department_id)
            ->where('location', $user->location_type)
            ->orderBy('created_at', 'desc')->get();

        $this->accounts = ChartOfAccount::all();

        // Set the first requisition as default
        if ($this->requisitions->isNotEmpty()) {
            $this->setRequisition($this->requisitions->first());
        } elseif ($this->approvedRequisitions->isNotEmpty()) {
            $this->setRequisition($this->approvedRequisitions->first());
        }
    }

    public function loadApprovals()
    {
        $this->approvals = RequisitionApprovalRecord::with(['approver.signature'])
            ->where('requisition_id', $this->selectedRequisitionId)
            ->orderBy('created_at', 'asc') // Sort approvals chronologically
            ->get();
    }


    public function setRequisition(StaffRequisition $requisition){
        $this->selRequisition = $requisition;
        $this->loadApprovals();
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


    public function hodApproveRequisition()
    {
        // Ensure the requisition is valid for approval
        if (!$this->selRequisition || $this->selRequisition->status != 'pending') {
            $this->dispatchBrowserEvent('error', ["error" => "Requisition requires approval."]);
            return;
        }

        // Show the secret code modal
        $this->showSecretCodeModal = true;
        $this->dispatchBrowserEvent('showSecretCodeModal');
    }

    public function verifyAndApprove()
    {
        $approverId = User::where('type','dg')->first();

        // Validate the secret code input
        $this->validate([
            'secretCode' => 'required',
        ]);

        // Check if the secret code matches
        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect.!."]);
            return;
        }

        $hod = auth()->user();
        $isInLiaisonOffice = $hod->is_in_liaison_office;

        // Update requisition status
        if ($isInLiaisonOffice) {
            $this->selRequisition->update(['status' => 'liaison_head_approval']);
        } else {
            $this->selRequisition->update(['status' => 'hod_approved']);
        }

        // Log the approval record
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

        // Reset and show success message
        $this->reset(['secretCode', 'comments', 'selRequisition']);
        $this->dispatchBrowserEvent('success', ["success" => "Requisition approved successfully."]);
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
        return view('livewire.requisitions.hod-requisitions-component');
    }
}
