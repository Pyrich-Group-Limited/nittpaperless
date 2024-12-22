<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\PurchaseRequisition;
use App\Models\PurchaseRequisitionList;
use Livewire\withPagination;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class PurchaseRequisitions extends Component
{

    use withPagination;
    public $searchTerm;

    public $supply_id;
    public Collection $inputs;
    public $items = [];
    public $last_date;
    public $comment;
    public $selRequest;

    public function mount(){
        $this->fill([
            'inputs' => collect([['item_name' => '','quantity' => '','quantity_left' => '']]),
        ]);
    }

    public function addInput(){
        $this->items = $this->inputs->pluck('item')->toArray();
        $this->inputs->push(['item_name' => '','quantity' => '','quantity_left' => '']);
    }

    public function removeInput($key){
        $this->inputs->pull($key);
    }

    public function viewRequest(PurchaseRequisition $request){
        $this->selRequest = $request;
    }

    public function purchaseRequest(){
        $this->validate([
            'comment' => ['required'],
            'last_date' => ['required','max:5000'],
            'inputs.*.item_name' => 'required',
            'inputs.*.quantity' => 'required',
            'inputs.*.quantity_left' => 'required',
        ]);

        $request = PurchaseRequisition::create([
            'user_id' => Auth::user()->id,
            'comment' => $this->comment,
            'last_date' => $this->last_date,
            'status' => "Pending",
        ]);

        foreach($this->inputs as $input){
            PurchaseRequisitionList::create([
                'purchase_requisitions_id' => $request->id,
                'item_name' => $input['item_name'],
                'quantity_requested' => $input['quantity'],
                'quantity_available' => $input['quantity_left']
            ]);
        }

        $this->dispatchBrowserEvent('success',['success'=>'Purchase Requisition Request Successful']);
        $this->reset('comment','last_date');
    }

    public function getRequisition(){
        $requesitions = PurchaseRequisition::query()
        ->where(function($query) {
            if($this->searchTerm) {
                $query->where('description', 'like', '%'.$this->searchTerm.'%');
            }
        })
         ->latest()->paginate(20);
         return $requesitions;
    }
    public function render()
    {
        $requisitions = $this->getRequisition();
        return view('livewire.requisitions.purchase-requisitions',compact('requisitions'));
    }
}
