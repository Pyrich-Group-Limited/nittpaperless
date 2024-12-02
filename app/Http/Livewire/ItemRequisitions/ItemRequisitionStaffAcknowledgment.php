<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;

class ItemRequisitionStaffAcknowledgment extends Component
{
    public function acknowledgeItem(ItemRequisitionList $item) {
        $item->update(['acknowledged' => true]);
    }

    public function render()
    {
        return view('livewire.item-requisitions.item-requisition-staff-acknowledgment');
    }
}
