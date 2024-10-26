<?php

namespace App\Http\Livewire\Guest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use Hash;

class ContractorRegisterComponent extends Component
{
    public $surname;
    public $othernames;
    public $email;
    // public $company_name;
    public $password;
    public $password_confirmation;
    public $phoneno;

    public function signup(){
        $this->validate([
            'surname' => ['required','string'],
            'othernames' => ['required','string'],
            // 'company_name' => ['required','string'],
            'phoneno' => ['required','string','min:11','max:11'],
            'email' => ['required','string','unique:users'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'name' => $this->surname." ".$this->othernames,
            'email' => $this->email,
            'phoneno' => $this->phoneno,
            'password' =>Hash::make($this->password),
            'type' => "Contractor"
        ]);

        $this->dispatchBrowserEvent('success',['success' => 'Regsitraiton Successful']);
        Auth::login($user);
        return redirect()->route('contractor.dashboard');

    }

    public function render()
    {
        return view('livewire.guest.contractor-register-component')->layout('layouts.guest');
    }
}
