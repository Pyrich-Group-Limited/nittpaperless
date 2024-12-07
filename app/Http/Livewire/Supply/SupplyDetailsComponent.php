<?php

namespace App\Http\Livewire\Supply;

use Livewire\Component;
use App\Models\ProjectCreation;
use App\Models\GoodsReceiveNote;
use App\Models\ProjectSupplyHistory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class SupplyDetailsComponent extends Component
{
    public $supply_id;
    public Collection $inputs;
    public $items = [];
    public $supplier;
    public $comment;

    public function mount($id){
        $this->supply_id = $id;
        $this->fill([
            'inputs' => collect([['item' => '','quantity' => '']]),
        ]);
    }


    public function addInput(){
        $this->items = $this->inputs->pluck('item')->toArray();
        $this->inputs->push(['item' => '','quantity' => '']);
    }

    public function removeInput($key){
        $this->inputs->pull($key);
    }


    public function addGoodsRecived(){
        $invoiceNo ="NITT/SUPP/".date('Y')."/".date('i').date('s');
        $project = ProjectCreation::find($this->supply_id);

        $this->validate([
            'comment' => ['required','string'],
            'supplier' => ['required','string'],
            'inputs.*.item' => 'required',
            'inputs.*.quantity' => 'required',
        ]);

        $goods = GoodsReceiveNote::create([
            'project_id' => $project->id,
            'comment' => $this->comment,
            'supplier_name' => $this->supplier,
            'invoice_no' => $invoiceNo,
            'user_id' => Auth::user()->id
        ]);

        foreach($this->inputs as $index => $input){
            ProjectSupplyHistory::create([
                'project_id' => $project->id,
                'goods_receive_notes_id' => $goods->id,
                'item_id' => $input['item'],
                'quantity' => $input['quantity'],
            ]);
        }
        $this->reset('supplier','comment');
        $this->dispatchBrowserEvent('success',['success'=>'Good recoved successful']);

    }

    public function render()
    {
        $project = ProjectCreation::find($this->supply_id);
        $totalSum = 0;
        return view('livewire.supply.supply-details-component',compact('project','totalSum'));
    }
}
