<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectCreation;
use App\Models\ProjectUser;
use App\Models\User;
// use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;


class EditProjectComponent extends Component
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
    public $users;
    public $project_id;
    public $project;
    public $selProject;

    public function mount($project_id)
    {
        $project = ProjectCreation::find($project_id);
        $this->project_id = $project_id;
        $this->project_name = $project->project_name;
        $this->project_number = $project->projectId;
        $this->description = $project->description;
        $this->start_date = $project->start_date;
        $this->end_date = $project->end_date;
        $this->project_category_id = $project->project_category_id;
        $this->project_category_id = $project->project_category_id;
        $this->selectedStaff = ProjectUser::all()->pluck('id')->toArray();
    }

    public function setProject(ProjectCreation $project){
        $this->selProject = $project;
    }

    public function updateProject(){
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

        $project = ProjectCreation::find($this->project_id);
        $project->update([
            'project_name' => $this->project_name,
            'projectId' => $this->project_number,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'project_category_id' => $this->project_category_id,
            'created_by' => Auth::user()->id
        ]);

        // foreach ($this->selectedStaff as $id) {
        //     $staff = ProjectUser::find($id);
        //     $staff->update(['user_id' => $this->selectedStaff]);
        // }

        $project->users()->attach($this->selectedStaff);

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
        $clients = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 'registrar')->get()->pluck('name', 'id');
        $clients->prepend('Select Client', '');
        $users   = User::where('type', '!=', 'registrar')->get();
        return view('livewire.projects.edit-project-component',compact('view','projects','clients','users','categories'));
    }
}
