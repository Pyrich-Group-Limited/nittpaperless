<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;

class ItemRequisitionStoreUnitApproval extends Component
{
    public $requisitions = [];
    public $selectedRequisition = null;
    public $comments = [];

    public $filter = 'all'; // Default filter

    public function mount()
    {
        $this->loadRequisitions();
    }

    public function loadRequisitions()
    {
        // $this->requisitions = ItemRequisitionRequest::where('status', 'bursar_approved')
        //     ->with('items')
        //     ->get();

        $query = ItemRequisitionRequest::with('items')
        ->where(function ($query) {
            $query->where('status', 'bursar_approved')
                  ->orWhere('status', 'store_approved');
        });

            // Apply filter
        if ($this->filter === 'pending') {
            $query->where('status', 'bursar_approved');
        } elseif ($this->filter === 'approved') {
            $query->where('status', 'store_approved');
        }    
        $this->requisitions = $query->orderBy('created_at','desc')->get();
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->loadRequisitions();
    }

    public function selectRequisition($id)
    {
        $this->selectedRequisition = ItemRequisitionRequest::with('items')->find($id);
    }

    public function markAvailability($itemId, $availability)
    {
        $item = ItemRequisitionList::find($itemId);
        $item->update(['status' => $availability]);

        $this->selectedRequisition = ItemRequisitionRequest::with('items')->find($this->selectedRequisition->id); // Refresh requisition data
    }

    public function finalizeApproval()
    {
        if (!$this->selectedRequisition) {
            $this->dispatchBrowserEvent('error', ['error' => 'No requisition selected.']);
            return;
        }

        $unmarkedItems = $this->selectedRequisition->items->whereNull('status');
        if ($unmarkedItems->count() > 0) {
            $this->dispatchBrowserEvent('error', ['error' => 'Please mark all items as available or not available.']);
            return;
        }

        $this->selectedRequisition->update(['status' => 'store_approved']);

        $this->dispatchBrowserEvent('success', ['success' => 'Requisition finalized successfully.']);
        $this->loadRequisitions();
        $this->selectedRequisition = null;
    }

    public function render()
    {
        return view('livewire.item-requisitions.item-requisition-store-unit-approval');
    }
}
