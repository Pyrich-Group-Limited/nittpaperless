<?php

namespace App\Http\Livewire\Contractor;

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
use Illuminate\Support\Facades\Auth;

class ContractorContractsComponent extends Component
{
    public function render()
    {
        $contracts   = Contract::where('client_name',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('livewire.contractor.contractor-contracts-component',compact('contracts'))->layout('layouts.contractor');
    }
}
