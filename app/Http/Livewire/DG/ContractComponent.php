<?php

namespace App\Http\Livewire\DG;

use Livewire\Component;
use App\Models\Contract;

class ContractComponent extends Component
{
    public function render()
    {
        $contracts   = Contract::all();
        return view('livewire.d-g.contract-component',compact('contracts'));
    }
}
