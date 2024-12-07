<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;
use Illuminate\Support\Facades\Auth;

class ItemRequisitionStaffAcknowledgment extends Component
{
    public $requisitions;
    public $selectedRequisition = null;

    public function mount()
    {
        $this->loadRequisitions();
    }

    public function loadRequisitions()
    {
        $this->requisitions = ItemRequisitionRequest::where('user_id', Auth::id())
            ->where('status', 'store_approved')
            ->with('items')
            ->get();
    }

    public function selectRequisition($id)
    {
        $this->selectedRequisition = ItemRequisitionRequest::with('items')->find($id);
    }

    public function acknowledgeItem($itemId)
    {
        $item = ItemRequisitionList::find($itemId);
        $item->update(['acknowledged' => true]);

        $this->selectedRequisition = ItemRequisitionRequest::with('items')->find($this->selectedRequisition->id);

        // $this->dispatchBrowserEvent('success', ['success' => 'Item acknowledged successfully!']);
    }

    public function render()
    {
        return view('livewire.item-requisitions.item-requisition-staff-acknowledgment');
    }
}
