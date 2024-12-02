<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;

class ItemRequisitionBursarApproval extends Component
{
    public function approveRequisition(ItemRequisitionRequest $requisition) {
        $requisition->update(['status' => 'pending_store_approval']);
    
        ItemRequisitionApproval::create([
            'item_requisition_request_id' => $requisition->id,
            'approved_by' => auth()->id(),
            'role' => 'Bursar',
            'comments' => 'Approved by Bursar',
            'status' => 'approved',
        ]);
    }


    public function render()
    {
        return view('livewire.item-requisitions.item-requisition-bursar-approval');
    }
}
