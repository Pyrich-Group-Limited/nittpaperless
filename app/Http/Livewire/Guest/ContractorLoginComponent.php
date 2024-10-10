<?php

namespace App\Http\Livewire\Guest;

use Livewire\Component;

class ContractorLoginComponent extends Component
{
    public function render()
    {
        return view('livewire.guest.contractor-login-component')->layout('layouts.guest');
    }
}
