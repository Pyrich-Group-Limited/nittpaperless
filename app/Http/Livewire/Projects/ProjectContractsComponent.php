<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Contract_attachment;
use App\Models\ContractComment;
use App\Models\ContractNotes;
use App\Models\ContractType;
use App\Models\Project;
use App\Models\User;
use App\Models\UserDefualtView;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProjectContractsComponent extends Component
{
    public function render()
    {
        $contracts   = Contract::all();
        return view('livewire.projects.project-contracts-component',compact('contracts'));
    }
}
