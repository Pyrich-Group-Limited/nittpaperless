<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\ChartOfAccount;

class HodRequisitionsComponent extends Component
{
    // protected $listeners = ['approveRequisition', 'rejectRequisition'];

    public $requisition;
    public $comments;
    public $selRequisition;
    public $actionId;

    public $chartAccount;

    public $approvals;     // Approvals for the selected requisition
    public $selectedRequisitionId; // ID of the currently selected requisition

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

        if (!$this->selRequisition || $this->selRequisition->status != 'pending') {
            $this->dispatchBrowserEvent('error',["error" =>"Requisition required an approval."]);
            return;
        }

        $hod = auth()->user();
        $isInLiaisonOffice = $hod->is_in_liaison_office;

        if ($isInLiaisonOffice) {
            $this->selRequisition->update(['status' => 'liaison_head_approval']);
        } else {
            $this->selRequisition->update(['status' => 'hod_approved']);
        }

        RequisitionApprovalRecord::create([
            'requisition_id' => $this->selRequisition->id,
            'approver_id' => auth()->id(),
            'role' => auth()->user()->type,
            'status' => 'approved',
            'comments' => $this->comments,
        ]);
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
        return view('livewire.requisitions.hod-requisitions-component');
    }
}
