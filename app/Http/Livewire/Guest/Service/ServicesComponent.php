<?php

namespace App\Http\Livewire\Guest\Service;

use Livewire\Component;
use App\Models\ProjectAdvert;

class ServicesComponent extends Component
{
    public function render()
    {
        $adverts = ProjectAdvert::all();
        return view('livewire.guest.service.services-component',compact('adverts'))->layout('layouts.guest');
    }
}
