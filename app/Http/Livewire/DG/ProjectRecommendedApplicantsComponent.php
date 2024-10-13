<?php

namespace App\Http\Livewire\DG;

use Livewire\Component;
use App\Models\Project;
use App\Models\ProjectAdvert;
use App\Models\ProjectCategory;
use App\Models\Ergp;
use App\Models\ProjectCreation;
use App\Models\ProjectUser;
use App\Models\ProjectApplication;
use App\Models\User;

class ProjectRecommendedApplicantsComponent extends Component
{
    public $projectApplicant;
    public $project_id;
    public function mount($id){

        $this->project_id = $id;

    }

    public function setApplicant(ProjectApplication $projectApplicant){
        $this->selApplicant = $projectApplicant;
    }

    public function recommendToDg($user_id){
        $projectApplicant = ProjectApplication::find($user_id);
        if($projectApplicant->application_status=='selected'){
            $this->dispatchBrowserEvent('error',['error' => 'This applicant has already been recommended to the DG']);
        }else{
            $projectApplicant->update([
                'application_status' => 'selected',
            ]);
            $this->dispatchBrowserEvent('success',["success" =>"Contract applicant forwarded to DG for review/approval"]);
        }
    }

    public function render()
    {
        $projectApplicants = ProjectApplication::where('project_id',$this->project_id)
        ->where('application_status','on_review')->get();
        return view('livewire.d-g.project-recommended-applicants-component',compact('projectApplicants'));
    }
}
