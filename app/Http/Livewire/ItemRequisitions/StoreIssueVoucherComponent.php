<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;
use Illuminate\Support\Facades\Auth;

class StoreIssueVoucherComponent extends Component
{
    public $requisition;

    public function mount($id)
    {
        // $this->requisition_id = $id;
        $this->requisition = ItemRequisitionRequest::find($id);
    }

    public function render()
    {
        return view('livewire.item-requisitions.store-issue-voucher-component');
    }
}
