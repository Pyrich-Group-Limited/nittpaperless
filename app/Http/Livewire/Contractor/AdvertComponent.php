<?php

namespace App\Http\Livewire\Contractor;

use Livewire\Component;
use App\Models\ProjectAdvert;
class AdvertComponent extends Component
{
    public function render()
    {
        $adverts = ProjectAdvert::where('advert_type','External')->get();
        return view('livewire.contractor.advert-component',compact('adverts'))->layout('layouts.contractor');
    }
}
