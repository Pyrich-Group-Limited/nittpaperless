<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectCreation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectsComponent extends Component
{
    public $project_name;
    public $description;
    public $start_date;
    public $end_date;
    public $project_category_id;
    public $project_boq;
    public $supervising_staff_id;
    public $status;
    public $budget;

    public function createProject(){
        $this->validate([
            'project_name' => ['required','max:120'],
            'description' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'project_category_id' => ['required'],
            'project_boq' => ['required'],
            'supervising_staff_id' => ['required'],
            'status' => ['required'],
            'budget' => ['required'],
        ]);


        $project = ProjectCreation::create([
            'project_name' => $this->email,
            'description',
            'start_date',
            'end_date',
            'project_category_id',
            'project_boq',
            'supervising_staff_id',
            'status',
            'budget',
            'created_by'
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('success',["success" =>"Project Successfully Created"]);
    }

    public function render()
    {
        $view = 'grid';
        $categories = ProjectCategory::all();
        $projects = ProjectCreation::all();
        $users   = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->get()->pluck('name', 'id');
        $clients = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 'client')->get()->pluck('name', 'id');
        $clients->prepend('Select Client', '');
        $users->prepend('Select User', '');
        return view('livewire.projects.projects-component',compact('view','projects','clients','users','categories'));
    }
}
