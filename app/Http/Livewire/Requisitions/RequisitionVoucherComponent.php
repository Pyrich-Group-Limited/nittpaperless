<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;

class RequisitionVoucherComponent extends Component
{
    // public $requisition_id;
    public $requisition;

    public function mount($id)
    {
        // $this->requisition_id = $id;
        $this->requisition = StaffRequisition::find($id);
    }

    public function render()
    {
        return view('livewire.requisitions.requisition-voucher-component');
    }
}
