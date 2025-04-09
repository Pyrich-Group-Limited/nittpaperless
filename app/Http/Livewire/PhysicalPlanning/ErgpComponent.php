<?php

namespace App\Http\Livewire\PhysicalPlanning;

use Livewire\Component;
use App\Models\Ergp;
use App\Models\ProjectCategory;

class ErgpComponent extends Component
{
    public $projectCat;
    public $code;
    public $title;
    public $value;
    public $ergp_year;
    public $category;

    public $selErgp;
    public $editId;

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
            'category' => $this->category,
            'project_sum' => $this->value,
            'year' => $this->ergp_year,
        ]);
        // $this->reset();
        $this->dispatchBrowserEvent('success',["success" =>"ERGP Successfully Created"]);
    }


    

    // For pre-filling the form
    public function editErgp($id)
    {
        $ergp = Ergp::findOrFail($id);

        $this->editId = $id;
        $this->projectCat = $ergp->project_category_id;
        $this->code = $ergp->code;
        $this->title = $ergp->title;
        $this->category = $ergp->category_name;
        $this->value = $ergp->project_sum;
        $this->ergp_year = $ergp->year;

        $this->dispatchBrowserEvent('openEditModal'); // Trigger JS to open the modal
    }


    public function updateErgp()
    {
        $this->validate([
            'projectCat' => ['required'],
            'code' => ['required'],
            'title' => ['required'],
            'value' => ['required'],
            'ergp_year' => ['required'],
        ]);

        $project = Ergp::findOrFail($this->editId);

        $project->update([
            'project_category_id' => $this->projectCat,
            'code' => $this->code,
            'title' => $this->title,
            'category' => $this->category,
            'project_sum' => $this->value,
            'year' => $this->ergp_year,
        ]);

        $this->dispatchBrowserEvent('success', ['success' => 'ERGP Successfully Updated']);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'editId',
            'projectCat',
            'code',
            'title',
            'category',
            'value',
            'ergp_year',
        ]);
    }


    public function render()
    {
        $ergps = Ergp::all();
        $projectCats = ProjectCategory::all();
        return view('livewire.physical-planning.ergp-component',compact('ergps','projectCats'));
    }
}
