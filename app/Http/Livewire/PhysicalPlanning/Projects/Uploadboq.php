<?php

namespace App\Http\Livewire\PhysicalPlanning\Projects;

use Livewire\Component;
use App\Models\ProjectCreation;

class Uploadboq extends Component
{
    public $selProject;
    protected $listeners = ['project' => 'incrementPostCount'];


    public function mount($project = null){
        $this->selProject = $project;
    }



    public function incrementPostCount(ProjectCreation $project)
    {
        $this->selProject = $project;
    }

    public function render()
    {
        return view('livewire.physical-planning.projects.uploadboq');
    }
}
