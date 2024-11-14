<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;
use Illuminate\Support\Facades\Auth;

class HodRequisitionsComponent extends Component
{
    // protected $listeners = ['approveRequisition', 'rejectRequisition'];

    public $requisition;
    public $comments;
    public $selRequisition;
    public $actionId;

    public function mount()
    {
        $this->requisitions = StaffRequisition::where('department_id',Auth::user()->department_id)
        ->where('status','pending')->orWhere('status','dg_approved')
        ->orderBy('created_at','desc')->get();
    }

    public function setRequisition(StaffRequisition $requisition){
        $this->selRequisition = $requisition;
    }


    public function hodApproveRequisition()
    {
        if ($this->selRequisition->amount > 1000000) {
            $this->selRequisition->update(['status' => 'waiting_dg_approval']);
        } elseif ($this->selRequisition->amount > 1000000 && $this->selRequisition->status=='dg_approved') {
            $this->selRequisition->update(['status' => 'hod_approved']);
        } else {
            $this->selRequisition->update(['status' => 'hod_approved']);
        }

        // if($this->selRequisition->amount > 1000000 && $this->selRequisition->status=='dg-approved'){
        //     $this->selRequisition->update(['status' => 'hod_approved']);
        // }

        RequisitionApprovalRecord::create([
            'requisition_id' => $this->selRequisition->id,
            'approver_id' => auth()->id(),
            'role' => auth()->user()->type,
            'status' => 'approved',
            'comments' => $this->comments,
        ]);
        $this->dispatchBrowserEvent('success',["success" =>"Requisition approved successfully."]);
        $this->requisitions = StaffRequisition::where('department_id',Auth::user()->department_id)
        ->where('status','pending')->orWhere('status','dg_approved')
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
    }

    public function render()
    {
        return view('livewire.requisitions.hod-requisitions-component');
    }
}
