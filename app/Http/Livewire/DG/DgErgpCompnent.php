<?php

namespace App\Http\Livewire\DG;

use Livewire\Component;
use App\Models\Ergp;
use App\Models\ProjectCategory;

class DgErgpCompnent extends Component
{
    public $projectCat;
    public $code;
    public $title;
    public $value;
    public $ergp_year;

    public function createProject(){
        $this->validate([
            'projectCat' => ['required'],
            'code' => ['required'],
            'title' => ['required'],
            'value' => ['required'],
            'ergp_year' => ['required'],

        ]);

        Ergp::create([
            'project_category_id' => $this->projectCat,
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
        $projectCats = ProjectCategory::all();
        return view('livewire.d-g.dg-ergp-compnent',compact('ergps','projectCats'));
    }
}
