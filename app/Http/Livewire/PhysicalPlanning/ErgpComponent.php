<?php

namespace App\Http\Livewire\PhysicalPlanning;

use Livewire\Component;
use App\Models\Ergp;

class ErgpComponent extends Component
{
    public $code;
    public $title;
    public $value;
    public $ergp_year;

    public function createProject(){
        $this->validate([
            'code' => ['required'],
            'title' => ['required'],
            'value' => ['required'],
            'ergp_year' => ['required'],

        ]);

        Ergp::create([
            'code' => $this->code,
            'title' => $this->title,
            'project_sum' => $this->value,
            'year' => $this->ergp_year,
        ]);
        // $this->reset();
        $this->dispatchBrowserEvent('success',["success" =>"ERGP Successfully Created"]);
    }

    public function render()
    {
        $ergps = Ergp::all();
        return view('livewire.physical-planning.ergp-component',compact('ergps'));
    }
}
