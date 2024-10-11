<?php

namespace App\Http\Livewire\Contractor;

use Livewire\Component;

class ContractorDashboard extends Component
{
    public function render()
    {
        return view('livewire.contractor.contractor-dashboard')->layout('layouts.contractor');
    }
}
