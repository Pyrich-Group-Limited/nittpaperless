<?php

namespace App\Http\Livewire\DG;

use Livewire\Component;
use App\Models\Contract;

class ContractComponent extends Component
{
    public function render()
    {
        $contracts   = Contract::orderBy('created_at','desc')->get();
        return view('livewire.d-g.contract-component',compact('contracts'));
    }
}
