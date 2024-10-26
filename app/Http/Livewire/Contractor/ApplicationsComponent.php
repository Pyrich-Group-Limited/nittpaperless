<?php

namespace App\Http\Livewire\Contractor;

use Livewire\Component;
use App\Models\ProjectApplication;
use Illuminate\Support\Facades\Auth;

class ApplicationsComponent extends Component
{
    public $project;

    public function render()
    {
        $applications = ProjectApplication::where('user_id',Auth::user()->id)->get();
        return view('livewire.contractor.applications-component',compact('applications'))->layout('layouts.contractor');
    }
}
