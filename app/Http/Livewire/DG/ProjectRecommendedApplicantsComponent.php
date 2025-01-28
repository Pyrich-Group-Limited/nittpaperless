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
use App\Models\ProjectHod;
use App\Models\ProjectComment;
use Carbon\Carbon;
use Auth;
use App\Notifications\ProjectSharedNotification;

class ProjectRecommendedApplicantsComponent extends Component
{
    public $projectApplicant;
    public $project_id;
    public $selApplicant;

    public $selectedHods = [];

    public function mount($id){

        $this->project_id = $id;
    }


    public function shareProjectDetails()
    {
        $this->validate([
            'selectedHods' => 'required|array',
            'selectedHods' => 'required|exists:users,id'
        ]);

        $project = ProjectCreation::find($this->project_id);
         // Track duplicate HODs
        $duplicates = [];

        foreach ($this->selectedHods as $hodId) {
            // Check if the project has already been shared with this HOD
            $existing = ProjectHod::where('project_id', $this->project_id)
                ->where('hod_id', $hodId)
                ->first();

            if ($existing) {
                // Add to duplicate list and skip
                $duplicates[] = User::find($hodId)->name;
                continue;
            }

            try {
                // Associate the HOD with the project if not already associated
                ProjectHod::create([
                    'project_id' => $this->project_id,
                    'hod_id' => $hodId,
                ]);

                 // Send notification to HOD
                // $hod = User::find($hodId);
                // $hod->notify(new ProjectSharedNotification($project, auth()->user())); // Notify HOD

            } catch (QueryException $e) {
                $this->dispatchBrowserEvent('error',["error" =>"Error sharing project with Director."]);
            }
        }

        // If there are duplicates, show a warning message
        if (count($duplicates) > 0) {
            $this->dispatchBrowserEvent('error',["error" =>"The project has already been shared with the following Directors: ". implode(', ', $duplicates)]);
        } else {
            $this->dispatchBrowserEvent('success',["success" =>"Project shared with selected Directors successfully!"]);
        }

    }


    public function setApplicant(ProjectApplication $projectApplicant){
        $this->selApplicant = $projectApplicant;
    }

    public function approveContractor($user_id){
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
        $users = User::where('type','director')->get();
        $projectApplicants = ProjectApplication::where('project_id',$this->project_id)
        ->where('application_status','on_review')->get();
        return view('livewire.d-g.project-recommended-applicants-component',compact('projectApplicants','users'));
    }
}
