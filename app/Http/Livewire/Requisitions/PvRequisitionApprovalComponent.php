<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;
use App\Models\ChartOfAccount;
use Illuminate\Support\Facades\Auth;

class PvRequisitionApprovalComponent extends Component
{
    public $requisition;
    public $comments;
    public $selRequisition;
    public $actionId;

    public $chartAccount;
    
    public function mount()
    {
        $this->requisitions = StaffRequisition::where('status','bursar_approved')
        ->orderBy('created_at','desc')->get();

        $this->accounts = ChartOfAccount::all();
    }

    public function setRequisition(StaffRequisition $requisition){
        $this->selRequisition = $requisition;
    }


    public function pvApproveRequisition()
    {
        $this->validate([
            'chartAccount' => 'required',
        ]);

        if ($this->selRequisition->status != 'bursar_approved') {
            $this->dispatchBrowserEvent('error',["error" =>"Requisition required bursar approval."]);
        } else {
            $this->selRequisition->update([
                'status' => 'pv_approved',
                'account_id' => $this->chartAccount
            ]);
        }

        RequisitionApprovalRecord::create([
            'requisition_id' => $this->selRequisition->id,
            'approver_id' => auth()->id(),
            'role' => auth()->user()->type,
            'status' => 'approved',
            'comments' => $this->comments,
        ]);
        $this->dispatchBrowserEvent('success',["success" =>"Requisition approved successfully."]);

        $this->requisitions = StaffRequisition::where('status','bursar_approved')
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
        
        $this->requisitions = StaffRequisition::where('status','bursar_approved')
        ->orderBy('created_at','desc')->get();
    }

    public function render()
    {
        return view('livewire.requisitions.pv-requisition-approval-component');
    }
}
