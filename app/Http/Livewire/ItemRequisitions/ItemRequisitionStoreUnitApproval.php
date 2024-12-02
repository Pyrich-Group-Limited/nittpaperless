<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;

class ItemRequisitionStoreUnitApproval extends Component
{

    public function approveItem(ItemRequisitionList $item) {
        $item->update(['status' => 'available']);
    }
    
    public function moveToVoucher(ItemRequisitionRequest $requisition) {
        $requisition->update(['status' => 'in_store_issue_voucher']);
    
        foreach ($requisition->items as $item) {
            if ($item->status === 'available') {
                // Add to Store Issue Voucher logic here.
            }
        }
    }


    public function render()
    {
        return view('livewire.item-requisitions.item-requisition-store-unit-approval');
    }
}
