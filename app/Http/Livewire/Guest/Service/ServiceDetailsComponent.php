<?php

namespace App\Http\Livewire\Guest\Service;

use Livewire\Component;
use App\Models\Service;

class ServiceDetailsComponent extends Component
{
    public $service;


    public function mount($title,$id){
        $this->service = Service::find($id);
    }

    public function render()
    {
        $services = Service::all();
        return view('livewire.guest.service.service-details-component',compact('services'))->layout('layouts.guest');
    }
}
