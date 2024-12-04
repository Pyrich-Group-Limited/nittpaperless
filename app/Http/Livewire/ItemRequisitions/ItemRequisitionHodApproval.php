<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;
use Illuminate\Support\Facades\Auth;

class ItemRequisitionHodApproval extends Component
{
    public $itemRequisitions;
    public $selectedRequisition;
    public $comments;

    public $filter = 'all';

    protected $rules = [
        'comments' => 'nullable|string',
    ];

    public function mount()
    {
        $this->loadRequisitions();
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->loadRequisitions();
    }

    public function loadRequisitions()
    {
        $query = ItemRequisitionRequest::where('department_id', Auth::user()->department_id)
        ->with('items');

        if ($this->filter === 'pending') {
            $query->where('status', 'pending_hod_approval');
        } elseif ($this->filter === 'approved') {
            $query->where('status', 'hod_approved');
        } elseif ($this->filter === 'rejected') {
            $query->where('status', 'rejected');
        }

        $this->itemRequisitions = $query->orderBy('created_at','desc')->get();
    }

    public function selectRequisition($id)
    {
        $this->selectedRequisition = ItemRequisitionRequest::with('items')->find($id);
        $this->comments = '';
    }

    public function approveRequisition()
    {
        if (!$this->selectedRequisition) {
            $this->dispatchBrowserEvent('error', ['message' => 'No requisition selected.']);
            return;
        }

        $this->selectedRequisition->update(['status' => 'hod_approved']);

        ItemRequisitionApproval::create([
            'item_requisition_request_id' => $this->selectedRequisition->id,
            'approved_by' => Auth::id(),
            'role' => Auth::user()->type,
            'status' => 'approved',
            'comments' => $this->comments,
        ]);

        $this->dispatchBrowserEvent('success', ['success' => 'Requisition approved successfully.']);
        $this->loadRequisitions();
        $this->selectedRequisition = null;
    }

    public function rejectRequisition()
    {
        if (!$this->selectedRequisition) {
            $this->dispatchBrowserEvent('error', ['error' => 'No requisition selected.']);
            return;
        }

        $this->selectedRequisition->update(['status' => 'rejected']);

        ItemRequisitionApproval::create([
            'item_requisition_request_id' => $this->selectedRequisition->id,
            'approved_by' => Auth::id(),
            'role' => Auth::user()->type,
            'status' => 'rejected',
            'comments' => $this->comments,
        ]);

        $this->dispatchBrowserEvent('success', ['success' => 'Requisition rejected successfully.']);
        $this->loadRequisitions();
        $this->selectedRequisition = null;
    }

    public function render()
    {
        return view('livewire.item-requisitions.item-requisition-hod-approval');
    }
}
