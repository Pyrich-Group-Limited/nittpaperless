<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\ChartOfAccount;

class DgRequisitionApprovalComponent extends Component
{
    public $requisition;
    public $comments;
    public $selRequisition;
    public $actionId;

    public $chartAccount;

    public function mount()
    {
        $user = auth()->user();

            $this->requisitions = StaffRequisition::with('approvalRecords.approver.signature')
            ->where('status', 'hod_approved')->orWhere('status','special_duty_head_approved')
            ->whereDoesntHave('approvalRecords', function ($query) use ($user) {
                $query->where('approver_id', $user->id)
                    ->where('role', $user->type);
            })->orderBy('created_at', 'desc')->get();

        $this->dgApprovedrequisitions = StaffRequisition::with('approvalRecords.approver.signature')
            ->whereHas('approvalRecords', function ($query) use ($user) {
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
        // Check if the file exists in the public folder
        $filePath = public_path('assets/documents/documents/' . $this->selRequisition->supporting_document);

        if (file_exists($filePath)) {
            return response()->download($filePath, $this->selRequisition->supporting_document);
        } else {
            $this->dispatchBrowserEvent('error',["error" =>"Document not found!."]);
        }
    }

    public function dgApproveRequisition()
    {
        if ($this->selRequisition->status == 'pending') {
            $this->dispatchBrowserEvent('error',["error" =>"Requisition required HoD approval."]);
        } else {
            $this->selRequisition->update(['status' => 'dg_approved']);
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
        return view('livewire.requisitions.dg-requisition-approval-component');
    }
}
