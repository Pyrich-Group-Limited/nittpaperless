<?php

namespace App\Http\Livewire\DG;

use Livewire\Component;
use App\Models\Project;
use App\Models\ProjectAdvert;
use App\Models\ProjectCategory;
use App\Models\Ergp;
use App\Models\ProjectCreation;
use App\Models\ProjectUser;
use App\Models\User;
use Google\Service\CloudSourceRepositories\ProjectConfig;
use Illuminate\Support\Facades\Auth;

class DgProjectsComponent extends Component
{
    public function render()
    {
        $projAccounts = Ergp::all();
        $view = 'grid';
        $categories = ProjectCategory::all();
        $projects = ProjectCreation::where('project_boq','!=','')->where('isApproved',true)->get();
        $clients = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 'contractor')->get()->pluck('name', 'id');
        $clients->prepend('Select Client', '');
        $users   = User::where('type', '!=', 'contractor')->get();
        return view('livewire.d-g.dg-projects-component',compact('view','projects','clients','users','categories','projAccounts'));
    }
}
