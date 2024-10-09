<?php

namespace App\Http\Livewire\Procurements\Projects;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProjectCreation;
class ProcurementProjectsComponent extends Component
{


    use WithPagination;
    public $selProject;
    public $start_date;
    public $end_date;
    public $description;
    public $type_of_project;

    protected $paginationTheme = 'bootstrap';
    public $actionId;
    public $paginate;
    public $failed_upload = [];


    public $searchTerm = null;
    public $searchBy = null;

    public function getProjects(){
        $projects = ProjectCreation::query()
        ->where(function($query) {
            if($this->searchTerm) {
                $query->where('project_name', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('project_description', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('othernames', 'like', '%'.$this->searchTerm.'%');
            }
        })
         ->latest();
         return $projects;
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

    public function render()
    {
        $projects = $this->getProjects();
        $totalProjects = ProjectCreation::all();
        return view('livewire.procurements.projects.procurement-projects-component',compact('projects','totalProjects'));
    }
}
