<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;
use Illuminate\Support\Facades\Auth;

class AuditRequisitionApprovalComponent extends Component
{
    public $requisition;
    public $comments;
    public $selRequisition;
    public $actionId;
    
    public function mount()
    {
        $this->requisitions = StaffRequisition::where('status','pv_approved')
        ->orderBy('created_at','desc')->get();
    }

    public function setRequisition(StaffRequisition $requisition){
        $this->selRequisition = $requisition;
    }


    public function auditApproveRequisition()
    {
        if ($this->selRequisition->status != 'pv_approved') {
            $this->dispatchBrowserEvent('error',["error" =>"Requisition required payment voucher approval."]);
        } else {
            $this->selRequisition->update(['status' => 'audit_approved']);
        }

        RequisitionApprovalRecord::create([
            'requisition_id' => $this->selRequisition->id,
            'approver_id' => auth()->id(),
            'role' => auth()->user()->type,
            'status' => 'approved',
            'comments' => $this->comments,
        ]);
        $this->dispatchBrowserEvent('success',["success" =>"Requisition approved successfully."]);

        $this->requisitions = StaffRequisition::where('status','pv_approved')
        ->orderBy('created_at','desc')->get();
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
        
        $this->requisitions = StaffRequisition::where('status','pv_approved')
        ->orderBy('created_at','desc')->get();
    }

    public function render()
    {
        return view('livewire.requisitions.audit-requisition-approval-component');
    }
}
