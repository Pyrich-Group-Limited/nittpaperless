<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CreateItemRequisition extends Component
{
    public $items = [];
    public $comments;

    public $item_name;
    public $item_description;
    public $item_quantity;

    public $selRequisitionItem;
    public $actionId;

    public $secretCode;
    public $showSecretCodeModal = false;

    public function mount(){
        $this->items = [
            ['item_name'=> '','item_description' => '', 'item_quantity' => null ]
        ];
        $this->itemRequisitions = ItemRequisitionRequest::where('user_id',Auth::user()->id)
        ->orderBy('created_at','desc')->get();
    }

    public function setRequisitionItem(ItemRequisitionRequest $requisition){
        $this->selRequisitionItem = $requisition;
    }

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

    public function createItemRequisition()
    {
        $this->validate([
            'items.*.name' => 'required|string',
            'items.*.description' => 'nullable|string',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Show the secret code modal
        $this->showSecretCodeModal = true;
        $this->dispatchBrowserEvent('showSecretCodeModal');
    }

    public function verifySecretCode()
    {
        $this->validate([
            'secretCode' => 'required',
        ]);

        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect.!."]);
            return;
        }

        // Determine if the user belongs to a liaison office
        $unitId = Auth::user()->is_in_liaison_office ? null : Auth::user()->unit_id;

        // Set the requisition status based on liaison office condition
        $status = Auth::user()->is_in_liaison_office ? 'liaison_head_approval' : 'pending_hod_approval';

        $requisition = ItemRequisitionRequest::create([
            'user_id' => auth()->id(),
            'department_id' => auth()->user()->department_id,
            'status' => $status,
        ]);

        foreach ($this->items as $item) {
            ItemRequisitionList::create([
                'item_requisition_request_id' => $requisition->id,
                'item_name' => $item['name'],
                'description' => $item['description'],
                'quantity_requested' => $item['quantity'],
            ]);
        }

        $this->reset(['items', 'secretCode', 'showSecretCodeModal']);
        $this->dispatchBrowserEvent('success', ['success' => 'Item Requisition Successful.']);
        $this->dispatchBrowserEvent('hide-secret-code-modal');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.item-requisitions.create-item-requisition');
    }
}
