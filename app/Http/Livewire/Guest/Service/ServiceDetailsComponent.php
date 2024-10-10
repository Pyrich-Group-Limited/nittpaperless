<?php

namespace App\Http\Livewire\Guest\Service;

use Livewire\Component;
use App\Models\ProjectAdvert;

class ServiceDetailsComponent extends Component
{
    public $advert;


    public function mount($title,$id){
        $this->advert = ProjectAdvert::find($id);
    }

    public function render()
    {
        return view('livewire.guest.service.service-details-component')->layout('layouts.guest');
    }
}
