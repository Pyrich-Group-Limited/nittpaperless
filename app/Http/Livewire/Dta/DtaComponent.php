<?php

namespace App\Http\Livewire\Dta;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Dta;
use App\Models\DtaApproval;
use App\Models\User;
use App\Models\DtaRejectionComment;

class DtaComponent extends Component
{
    public $destination;
    public $purpose;
    public $travel_date;
    public $arrival_date;
    public $expense;

    public function mount(){

        $this->dtaRequests = Dta::where('user_id', auth()->id())->orderBy('created_at','DESC')->with('approval', 'rejectionComment')->get();
    }

    public function applyForDta(){
        $this->validate([
            'destination' => ['required','string'],
            'purpose' => ['required','string'],
            'travel_date' => ['required','date'],
            'arrival_date' => ['required','date'],
            'expense' => ['required','numeric','min:0'],
        ]);

        $dtaRequest = Dta::create([
            'user_id' => auth()->id(),
            'purpose' => $this->purpose,
            'destination' => $this->destination,
            'travel_date' => $this->travel_date,
            'arrival_date' => $this->arrival_date,
            'estimated_expense' => $this->expense,
            'current_approver' => 'Unit Head',
        ]);

        DtaApproval::create(['dta_id' => $dtaRequest->id]);

        $this->reset(['destination','purpose','travel_date','arrival_date','expense']);
        $this->dispatchBrowserEvent('success',["success" =>"DTA request submitted successfully."]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.dta.dta-component');
    }
}
