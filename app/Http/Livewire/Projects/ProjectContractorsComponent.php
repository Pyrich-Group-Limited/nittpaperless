<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;
use App\Models\Contract;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProjectContractorsComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteContractor'];

    public $contractor_name;
    public $cemail;
    public $cpassword;


    public function createContractor(){
        $this->validate([
            'contractor_name' => ['required'],
            'cemail' => ['required'],
            'cpassword' => ['required'],
        ]);

        User::create([
            'name' => $this->contractor_name,
            'email' => $this->cemail,
            'password' => Hash::make($this->cpassword),
            'type' => 'contractor',
            'created_by' => Auth::user()->id,
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('success',["success" =>"Contractor Successfully Created"]);
    }

    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function deleteContractor(){
        $contractor = User::find($this->actionId);

        if ($contractor->projects()->exists()) {
            $this->dispatchBrowserEvent('error', ['error' => "This contractor cannot be deleted because He/She has associated project."]);
            return;
        }
        $contractor->delete();
        $this->dispatchBrowserEvent('success', ['success' => "Contractor Successfully Deleted"]);
    }

    public function render()
    {
        $contractors = User::where('type','contractor')->orderBy('created_at','desc')->get();
        return view('livewire.projects.project-contractors-component',compact('contractors'));
    }
}
