<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;
use App\Models\ProjectAdvert;
use App\Models\ProjectCategory;
use App\Models\Ergp;
use App\Models\ProjectCreation;
use App\Models\ProjectUser;
use App\Models\ProjectApplication;
use App\Models\ProjectApplicationDocument;
use App\Models\User;

class ProjectApplicantsComponent extends Component
{
    public $projectApplicant;
    public $project_id;
    public $selApplicant;

    public function mount($id){

        $this->project_id = $id;

    }

    public function setApplicant(ProjectApplication $projectApplicant){
        $this->selApplicant = $projectApplicant;
    }

    public function recommendToDg($user_id){
        $projectApplicant = ProjectApplication::find($user_id);
        if($projectApplicant->application_status=='on_review'){
            $this->dispatchBrowserEvent('error',['error' => 'This applicant has already been recommended to the DG']);
        }elseif($projectApplicant->application_status=='selected'){
            $this->dispatchBrowserEvent('error',['error' => 'This applicant has already been selected']);
        }else{
            $projectApplicant->update([
                'application_status' => 'on_review',
            ]);
            $this->dispatchBrowserEvent('success',["success" =>"Contract applicant forwarded to DG for review/approval"]);
        }
    }

    public function downloadFile($document)
    {
        foreach ($this->selApplicant->documents  as $applicationDocument){

        }
            $filePath = public_path('assets/documents/documents/' . $applicationDocument->document);
            
            if (file_exists($filePath)) {
                return response()->download($filePath, $applicationDocument->document);
            } else {
                $this->dispatchBrowserEvent('error',["error" =>"Document not found!."]);
            }
        
    }


    public function render()
    {
        $projectApplicants = ProjectApplication::where('project_id',$this->project_id)
        ->get();
        return view('livewire.projects.project-applicants-component',compact('projectApplicants'));
    }
}
