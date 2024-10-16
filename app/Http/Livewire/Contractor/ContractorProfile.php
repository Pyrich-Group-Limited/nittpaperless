<?php

namespace App\Http\Livewire\Contractor;

use Livewire\Component;
use App\Models\ProjectApplicant;
use Illuminate\Support\Facades\Auth;

class ContractorProfile extends Component
{

    public $company_name;
    public $tin;
    public $email;
    public $phoneno;
    public $year;
    public $address;

    public function updateProfile(){
        $this->validate([
            'company_name' => ['required','string'],
            'tin' => ['required','string'],
            'email' => ['required','string'],
            'phoneno' => ['required','string'],
            'address' => ['required','string'],
            'year' => ['required','string'],
        ]);

        ProjectApplicant::create([
            'company_name' => $this->company_name,
            'company_address' => $this->address,
            'year_of_incorporation' => $this->year,
            'company_tin' => $this->tin,
            'user_id' => Auth::user()->id,
            'phone' => $this->phoneno,
            'email' => $this->email,
        ]);

        return redirect()->route('contractor.advert');
    }

    public function render()
    {
        return view('livewire.contractor.contractor-profile')->layout('layouts.contractor');
    }
}
