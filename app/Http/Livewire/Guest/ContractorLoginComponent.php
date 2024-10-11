<?php

namespace App\Http\Livewire\Guest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
class ContractorLoginComponent extends Component
{

    public $password;
    public $email;

    public function login(){
        $this->validate([
            'email' => ['required','string'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

            if (Auth::attempt($credentials)) {
                //check type of user and redirected to dashboard
                if(Auth::user()->type=="Contractor"){
                    session()->flash('feedback', 'Login Successful');
                    return redirect()->route('contractor.dashboard');
                }
            }else{
            session()->flash('errorfeedback', 'Invalid Login Credencials');
            }
    }

    public function render()
    {
        return view('livewire.guest.contractor-login-component')->layout('layouts.guest');
    }
}
