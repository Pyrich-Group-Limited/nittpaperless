<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
// use App\Models\Utility;
use App\Models\ProjectAdvert;
use App\Models\ProjectCategory;
use App\Models\Ergp;
use App\Models\ProjectCreation;
use App\Models\ProjectUser;
use App\Models\User;
use Google\Service\CloudSourceRepositories\ProjectConfig;
// use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ProjectsComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteProject', 'approve-confirmed'=>'approveProject'];

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
    public $actionId;

    public $selProject2;
    public $ad_start_date;
    public $ad_end_date;
    public $ad_description;
    public $type_of_project;
    public $type_of_advert;

    public $advertOption = true;

    // public $selProject;
    // public $budget;
    // public $boq_file;
    // public Collection $inputs;


    public function mount()
    {
        $this->users = User::where('type', '!=', 'contractor')->get();
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
            // 'start_date' => ['required'],
            // 'end_date' => ['required'],
            'project_category_id' => ['required'],
            'selectedStaff' => 'required|array|min:1',
            'selectedStaff.*' => 'exists:users,id',
        ]);

        $project = ProjectCreation::create([
            'project_name' => $this->project_name,
            'projectId' => $this->project_number,
            'description' => $this->description,
            'start_date' => null,
            'end_date' => null,
            'project_category_id' => $this->project_category_id,
            'created_by' => Auth::user()->id,
            'withAdvert' => $this->advertOption
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

    public function setProject(ProjectCreation $project){
        $this->selProject = $project;
        $this->emit('project', $project);
    }

    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function deleteProject(){
        $project = ProjectCreation::find($this->actionId);

        // Check if the category has any associated boq project
        if ($project->boqs()->exists()) {
            $this->dispatchBrowserEvent('error', ['error' => "This project cannot be deleted because it has associated bill of quantity."]);
            return;
        }
        $project->delete();
        $this->dispatchBrowserEvent('success', ['success' => "Project Successfully Deleted"]);
    }

    public function approveProject(){
        $project = ProjectCreation::find($this->actionId);
        $project->update(['isApproved'=>true]);
        $this->dispatchBrowserEvent('success', ['success' => "Project Approved and forwarded to DG for approval"]);
    }


    public function render()
    {
        $projAccounts = Ergp::all();
        $view = 'grid';
        $categories = ProjectCategory::all();
        $projects = ProjectCreation::orderBy('created_at','desc')->get();
        $clients = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 'contractor')->get()->pluck('name', 'id');
        $clients->prepend('Select Contractor', '');
        $users   = User::where('type', '!=', 'contractor')->get();
        return view('livewire.projects.projects-component',compact('view','projects','clients','users','categories','projAccounts'));
    }
}
