<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;

class ItemRequisitionHodApproval extends Component
{
    public function approveRequisition(ItemRequisitionRequest $requisition) {
        $requisition->update(['status' => 'pending_bursar_approval']);
    
        ItemRequisitionApproval::create([
            'item_requisition_request_id' => $requisition->id,
            'approved_by' => auth()->id(),
            'role' => 'HOD',
            'comments' => 'Approved by HOD',
            'status' => 'approved',
        ]);
    }

    public function rejectRequisition(ItemRequisitionRequest $requisition, $comments) {
        $requisition->update(['status' => 'rejected']);
    
        ItemRequisitionApproval::create([
            'item_requisition_request_id' => $requisition->id,
            'approved_by' => auth()->id(),
            'role' => 'HOD',
            'comments' => $comments,
            'status' => 'rejected',
        ]);
    }

    public function render()
    {
        return view('livewire.item-requisitions.item-requisition-hod-approval');
    }
}
