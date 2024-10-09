<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;
// use App\Models\Utility;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectCreation;
use App\Models\ProjectUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ProjectsComponent extends Component
{
    use WithFileUploads;
    public $project_name;
    public $description;
    public $start_date;
    public $end_date;
    public $project_category_id;
    public $project_boq;
    public $supervising_staff_id;
    public $selectedStaff = [];
    public $status;
    public $budget;
    public $users;

    public function mount()
    {
        $this->users = User::all();
    }

    public function createProject(){
        // dd($this);
        $this->validate([
            'project_name' => ['required','max:120'],
            'description' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'project_category_id' => ['required'],
            // 'supervising_staff_id' => ['required'],
            'selectedStaff' => 'required|array|min:1',
            'selectedStaff.*' => 'exists:users,id',
            'budget' => ['required'],
        ]);

        // $boqDocumentName = Carbon::now()->timestamp. '.' . $this->project_boq->getClientOriginalName();
        // $this->project_boq->storePubliclyAs('boqs', 'public');

        $project = ProjectCreation::create([
            'project_name' => $this->project_name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'project_category_id' => $this->project_category_id,
            // 'supervising_staff_id' => $this->supervising_staff_id,
            // 'status' => $this->status,
            'budget' => $this->budget,
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
