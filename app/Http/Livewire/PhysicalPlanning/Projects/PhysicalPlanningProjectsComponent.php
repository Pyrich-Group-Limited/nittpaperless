<?php

namespace App\Http\Livewire\PhysicalPlanning\Projects;

use Livewire\Component;
use App\Models\Utility;
use App\Models\Project;
use App\Models\Ergp;
use App\Models\ProjectCategory;
use App\Models\ProjectCreation;
use App\Models\ProjectUser;
use App\Models\User;
use Auth;
use Livewire\WithFileUploads;

class PhysicalPlanningProjectsComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteProject'];

    use WithFileUploads;
    public $project_name;
    public $project_number;
    public $project_category_id;
    public $supervising_staff_id;
    public $selectedStaff = [];
    public $status;
    public $users;

    public $project_id;
    public $project;
    public $setActionId;
    public $actionId;

    public $selProject2;
    public $ad_start_date;
    public $ad_end_date;
    public $ad_description;
    public $type_of_advert;


    public $selProject;
    public $start_date;
    public $end_date;
    public $description;
    public $type_of_project;

    public function mount()
    {
        $this->users = User::all();
    }

    public function createProject(){
        $this->validate([
            'project_name' => ['required'],
            // 'project_number' => ['required'],
            'description' => ['required'],
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
            'created_by' => Auth::user()->id
        ]);

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


    Public function advertiseProject(){
        $project = ProjectCreation::find($selProject->id);
        $projectDuration = round(strtotime($data['end_date']) - strtotime($data['start_date']))/ 86400;

        if($project!=null){
            $this->dispatchBrowserEvent('error',['error' => 'Sorry this project has already been advertised for applications']);
        }elseif(strtotime($this->start_date)<strtotime(date('Y-m-d'))){
            $this->dispatchBrowserEvent('error',['error' => 'Sorry your start date can not be later than today']);
        }elseif($projectDuration<=0){
            $this->dispatchBrowserEvent('error',['error' => 'Sorry your start date can not be later than start']);
        }else{
            $this->validate([
                'start_date' => ['required','string'],
                'end_date' => ['required','string'],
                'description' => ['required','string'],
                'type_of_advert' => ['required','string'],
            ]);

            ProjectCreation::create([
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'descripton' => $this->descripton,
                'advert_type' => $this->type_of_advert,
            ]);

            $this->reset();
            $this->dispatchBrowserEvent('success',['success' => 'Project successfully Published']);
        }
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

    public function render()
    {
        // dd(Auth::user()->getDirectPermissions());
        $projAccounts = Ergp::all();
        $view = 'grid';
        $categories = ProjectCategory::all();
        $projects = ProjectCreation::orderBy('created_at','desc')->get();
        $clients = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 'client')->get()->pluck('name', 'id');
        $clients->prepend('Select Client', '');
        $users   = User::where('type', '!=', 'client')->get();
        return view('livewire.physical-planning.projects.physical-planning-projects-component',compact('view','projects','clients','users','categories','projAccounts'));
    }
}
