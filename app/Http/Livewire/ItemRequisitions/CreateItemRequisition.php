<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;
use Illuminate\Support\Facades\Auth;

class CreateItemRequisition extends Component
{
    public $items = [];
    public $comments; // Additional comments for the requisition

    // Temporary fields for item input
    public $item_name;
    public $item_description;
    public $item_quantity;

    // protected $rules = [
    //     'items.*.name' => 'required|string',
    //     'items.*.description' => 'nullable|string',
    //     'items.*.quantity' => 'required|integer|min:1',
    // ];


    public function mount(){
        $this->items = [
            ['item_name'=> '','item_description' => '', 'item_quantity' => null ]
        ];
        $this->itemRequisitions = ItemRequisitionRequest::where('user_id',Auth::user()->id)->get();
    }

    // public function addItems()
    // {
    //     $this->items[] = ['item_name'=> '','item_description' => '', 'item_quantity' => null ];
    // }


    public function addItem()
    {
        $this->items[] = [
            'name' => $this->item_name,
            'description' => $this->item_description,
            'quantity' => $this->item_quantity,
        ];

        // Clear input fields
        $this->item_name = '';
        $this->item_description = '';
        $this->item_quantity = '';
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function createItemRequisition(){
        $this->validate([
            'items.*.name' => 'required|string',
            'items.*.description' => 'nullable|string',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $requisition = ItemRequisitionRequest::create([
            'user_id' => auth()->id(),
            'department_id' => auth()->user()->department_id,
            'status' => 'pending_hod_approval',
        ]);

        foreach ($this->items as $item) {
            ItemRequisitionList::create([
                'item_requisition_request_id' => $requisition->id,
                'item_name' => $item['name'],
                'description' => $item['description'],
                'quantity_requested' => $item['quantity'],
            ]);
        }

        $this->reset(['items']);
        $this->dispatchBrowserEvent('success', ['success' => 'Requisition created successfully.']);
    }

    public function render()
    {
        return view('livewire.item-requisitions.create-item-requisition');
    }
}
