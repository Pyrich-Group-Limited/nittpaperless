<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;
use Illuminate\Support\Facades\Auth;

class AllRaisedRequisitionsComponent extends Component
{
    public $requisition;
    public $comments;
    public $selRequisition;
    public $actionId;

    protected $listeners = ['approveRequisition', 'rejectRequisition'];

    public function mount()
    {
        $this->requisitions = StaffRequisition::where('status','!=','pending')
        ->orderBy('created_at','desc')->get();
    }

    public function setRequisition(StaffRequisition $requisition){
        $this->selRequisition = $requisition;
    }

    public function render()
    {
        return view('livewire.requisitions.all-raised-requisitions-component');
    }
}
