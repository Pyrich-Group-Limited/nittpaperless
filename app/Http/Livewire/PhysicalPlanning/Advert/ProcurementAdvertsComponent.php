<?php

namespace App\Http\Livewire\Procurements\Advert;

use Livewire\Component;
use App\Models\ProjectAdvert;

class ProcurementAdvertsComponent extends Component
{

    protected $paginationTheme = 'bootstrap';
    public $actionId;
    public $paginate;
    public $failed_upload = [];


    public $searchTerm = null;
    public $searchBy = null;

    public function getAdverts(){
        $adverts = ProjectAdvert::latest();
         return $adverts;
    }

    public function render()
    {
        $adverts = $this->getAdverts();
        $totalAdverts = ProjectAdvert::all();
        return view('livewire.procurements.advert.procurement-adverts-component',compact('adverts','totalAdverts'));
    }
}
