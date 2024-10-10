<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
// use App\Models\Utility;
use App\Models\ProjectAdvert;
use App\Models\ProjectCategory;
use App\Models\ProjectCreation;
use App\Models\ProjectUser;
use App\Models\User;
use Google\Service\CloudSourceRepositories\ProjectConfig;
// use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ProjectsComponent extends Component
{
    use WithFileUploads;
    public $project_name;
    public $project_number;
    public $description;
    public $start_date;
    public $end_date;
    public $project_category_id;
    public $supervising_staff_id;
    public $selectedStaff = [];
    public $status;
    public $users;

    public $project_id;
    public $project;
    public $selProject;
    public $setActionId;

    public $selProject2;
    public $ad_start_date;
    public $ad_end_date;
    public $ad_description;
    public $type_of_project;
    public $type_of_advert;

    public function mount()
    {

        $this->users = User::all();
    }

    // public function setProject(ProjectCreation $project){
    //     $this->selProject = $project;
    // }

    public function createProject(){
        // dd($this);
        $this->validate([
            'project_name' => ['required'],
            'project_number' => ['required'],
            'description' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'project_category_id' => ['required'],
            'selectedStaff' => 'required|array|min:1',
            'selectedStaff.*' => 'exists:users,id',
        ]);

        $project = ProjectCreation::create([
            'project_name' => $this->project_name,
            'projectId' => $this->project_number,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'project_category_id' => $this->project_category_id,
            // 'supervising_staff_id' => $this->supervising_staff_id,
            // 'status' => $this->status,
            'created_by' => Auth::user()->id
        ]);

        $project->users()->attach($this->selectedStaff);
        // $project->users()->sync($this->selectedStaff);

        if(Auth::user()->type=='super admin'){

            ProjectUser::create(
                [
                    'project_id' => $project->id,
                    'user_id' => Auth::user()->id,
                ]
            );

        }

        $this->reset();
        $this->dispatchBrowserEvent('success',["success" =>"Project Successfully Created"]);
    }


    public function render()
    {
        $view = 'grid';
        $categories = ProjectCategory::all();
        $projects = ProjectCreation::all();
        $clients = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 'client')->get()->pluck('name', 'id');
        $clients->prepend('Select Client', '');
        $users   = User::where('type', '!=', 'client')->get();
        return view('livewire.projects.projects-component',compact('view','projects','clients','users','categories'));
    }
}
