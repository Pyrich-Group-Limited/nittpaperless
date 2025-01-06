<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ItemRequisitionStoreUnitApproval extends Component
{
    public $requisitions = [];
    public $selectedRequisition = null;
    public $comments = [];

    public $secretCode;
    public $showSecretCodeModal = false;

    public $filter = 'all';

    public function mount()
    {
        $this->loadRequisitions();
    }

    public function loadRequisitions()
    {
        $query = ItemRequisitionRequest::with('items')
        ->where(function ($query) {
            $query->where('status', 'bursar_approved')
                  ->orWhere('status', 'store_approved');
        });

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
        $this->showSecretCodeModal = true;
        $this->dispatchBrowserEvent('showSecretCodeModal');
    }

    public function verifyAndApprove()
    {
        $this->validate([
            'secretCode' => 'required',
        ]);

        $approverId = User::where('id',$this->selectedRequisition->user_id)->first();

        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect!"]);
            return;
        }

        $unmarkedItems = $this->selectedRequisition->items->whereNull('status');
        if ($unmarkedItems->count() > 0) {
            $this->dispatchBrowserEvent('error', ['error' => 'Please mark all items as available or not available.']);
            return;
        }

        $this->selectedRequisition->update(['status' => 'store_approved']);

        if ($approverId) {
            createNotification(
                $approverId->id,
                'Items Requsition Approved',
                'Your Requsition for items has been approved',
                route('itemRequisition.index')
            );
        }

        $this->dispatchBrowserEvent('success', ['success' => 'Requisition finalized successfully.']);
        $this->loadRequisitions();
        // $this->selectedRequisition = null;
        $this->reset(['secretCode', 'comments', 'selectedRequisition']);
    }

    public function render()
    {
        return view('livewire.item-requisitions.item-requisition-store-unit-approval');
    }
}
