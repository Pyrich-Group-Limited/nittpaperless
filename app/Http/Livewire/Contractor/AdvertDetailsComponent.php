<?php

namespace App\Http\Livewire\Contractor;

use Livewire\Component;
use App\Models\ProjectAdvert;
use App\Models\ProjectApplicationDocument;
use App\Models\ProjectApplication;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class AdvertDetailsComponent extends Component
{
    public $advert_id;
    public Collection $inputs;
    use WithFileUploads;
    protected $listeners = ['application-confirmed'=>'applyContract'];

    public function mount($id){
        $this->advert_id = $id;
        $this->fill([
            'inputs' => collect([['name' => '','doc_file']]),
        ]);
    }

    public function addInput(){
        $this->inputs->push(['doc_name' => '','doc_file' => '']);
    }

    public function removeInput($key){
        $this->inputs->pull($key);
    }

    public function applyContract(){

        if(count(Auth::user()->documents)<=0){
            $this->dispatchBrowserEvent('error',['error' => 'Kindly upload the neccessary to enable you submit your application for this project']);
        }{
            $advert = ProjectAdvert::find($this->advert_id);

            ProjectApplication::create([
                'project_id' => $advert->project_id,
                'user_id' => Auth::user()->id,
                'application_status' => "Pending"
            ]);


        }
    }

    public function render()
    {
        $advert = ProjectAdvert::find($this->advert_id);
        return view('livewire.contractor.advert-details-component',compact('advert'))->layout('layouts.contractor');
    }
}
