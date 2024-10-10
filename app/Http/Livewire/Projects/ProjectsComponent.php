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

        // $boqDocumentName = Carbon::now()->timestamp. '.' . $this->project_boq->getClientOriginalName();
        // $this->project_boq->storePubliclyAs('boqs', 'public');

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


    public function setActionId($id){
        $this->setActionId = $id;
    }

    public function selProject($id){
        $this->selProject = ProjectCreation::find($id);

        $this->project_id = $this->selProject->projectId;
        $this->project_name = $this->selProject->project_name;
        $this->project_number = $this->selProject->project_number;
        $this->description = $this->selProject->description;
        $this->start_date = $this->selProject->start_date;
        $this->end_date = $this->selProject->end_date;
        $this->project_category_id = $this->selProject->project_category_id;
        $this->selectedStaff;

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

        // $project = ProjectCreation::find($this->project_id);
        $this->selProject->update([
            'project_name' => $this->project_name,
            'projectId' => $this->project_number,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'project_category_id' => $this->project_category_id,
            'created_by' => Auth::user()->id
        ]);


        // $project->users()->attach($this->selectedStaff);

        if(Auth::user()->type=='super admin'){

            ProjectUser::create(
                [
                    'project_id' => $this->selProject->id,
                    'user_id' => Auth::user()->id,
                ]
            );

        }

        $this->dispatchBrowserEvent('success',["success" =>"Project Successfully Updated"]);
    }


    public function selProject2(ProjectCreation $project){
        $this->selProject = $project;
    }

    Public function advertiseProject(){

        // $project = ProjectCreation::find($selProject->id);
        // $projectDuration = round(strtotime($data['end_date']) - strtotime($data['start_date']))/ 86400;

        $project = ProjectAdvert::find($this->selProject->id);

        $projectDuration = round(strtotime($this->ad_end_date) - strtotime($this->ad_start_date))/ 86400;

        if($project!=null){
            $this->dispatchBrowserEvent('error',['error' => 'Sorry this project has already been advertised for applications']);
        }elseif(strtotime($this->ad_end_date)<strtotime(date('Y-m-d'))){
            $this->dispatchBrowserEvent('error',['error' => 'Sorry your start date can not be later than today']);
        }elseif($projectDuration<=0){
            $this->dispatchBrowserEvent('error',['error' => 'Sorry your start date can not be later than start']);
        }else{
            $this->validate([
                'ad_start_date' => ['required','string'],
                'ad_end_date' => ['required','string'],
                'ad_description' => ['required','string'],
                'type_of_advert' => ['required','string'],
            ]);

            ProjectAdvert::create([
                'project_id' => $this->selProject->id,
                'start_date' => $this->ad_start_date,
                'end_date' => $this->ad_end_date,
                'descripton' => $this->ad_description,
                'advert_type' => $this->type_of_advert,
            ]);

            // $this->reset();
            $this->dispatchBrowserEvent('success',['success' => 'Project successfully Published']);
        }
    }
    public function setProject(ProjectCreation $project){
        $this->selProject2 = $project;
        $this->emit('project', $project);
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
