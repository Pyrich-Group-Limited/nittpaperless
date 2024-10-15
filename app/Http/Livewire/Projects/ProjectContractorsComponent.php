<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;
use App\Models\ClientDeal;
use App\Models\ClientPermission;
use App\Models\Contract;
use App\Models\CustomField;
use App\Models\Estimation;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Utility;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class ProjectContractorsComponent extends Component
{
    public function render()
    {
        
            $user    = \Auth::user();
            $clients = User::where('created_by', '=', $user->creatorId())->where('type','contractor')->get();
        return view('livewire.projects.project-contractors-component',compact('clients'));
    }
}
