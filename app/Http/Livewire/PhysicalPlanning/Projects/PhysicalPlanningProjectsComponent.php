<?php

namespace App\Http\Livewire\PhysicalPlanning\Projects;

use Livewire\Component;
use App\Models\Utility;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectCreation;
use App\Models\ProjectUser;
use App\Models\User;
use Auth;
class PhysicalPlanningProjectsComponent extends Component
{


    public $selProject;
    public $start_date;
    public $end_date;
    public $description;
    public $type_of_project;


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

    public function render()
    {
        $view = 'grid';
        $categories = ProjectCategory::all();
        $projects = ProjectCreation::all();
        $clients = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 'client')->get()->pluck('name', 'id');
        $clients->prepend('Select Client', '');
        $users   = User::where('type', '!=', 'client')->get();
        return view('livewire.physical-planning.projects.physical-planning-projects-component',compact('view','projects','clients','users','categories'));
    }
}
