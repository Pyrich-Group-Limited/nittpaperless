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
use App\Models\Contract;
use Carbon\Carbon;
use Auth;

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
        // dd($projectApplicant->user_id);
        if($projectApplicant->application_status=='selected'){
            $this->dispatchBrowserEvent('error',['error' => 'This applicant has already been selected']);
        }else{
            $projectApplicant->update([
                'application_status' => 'selected',
            ]);
            Contract::create([
                'client_name' => $projectApplicant->user_id,
                'subject' => $projectApplicant->project->project_name,
                'value' => $projectApplicant->project->budget,
                'type' => $projectApplicant->project->category->id,
                'start_date' => Carbon::now(),
                'end_date' => '',
                'description' => $projectApplicant->project->description,
                'project_id' => $projectApplicant->project_id,
                'status' => 'pending',
                'contract_description' => '',
                'company_signature' => '',
                'client_signature' => '',
                'created_by' => Auth::user()->id,
            ]);
            $this->dispatchBrowserEvent('success',["success" =>"Contractor successfully selected and approved for contract"]);
        }
    }

    public function render()
    {
        $users = User::where('type','!=','contractor')->get();
        $projectApplicants = ProjectApplication::where('project_id',$this->project_id)
        ->where('application_status','on_review')->get();
        return view('livewire.d-g.project-recommended-applicants-component',compact('projectApplicants','users'));
    }
}
