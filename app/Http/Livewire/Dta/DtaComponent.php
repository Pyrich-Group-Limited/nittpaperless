<?php

namespace App\Http\Livewire\Dta;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Dta;
use App\Models\DtaApproval;
use App\Models\User;
use App\Models\DtaRejectionComment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class DtaComponent extends Component
{
    use WithFileUploads;

    public $destination;
    public $purpose;
    public $travel_date;
    public $arrival_date;
    public $expense;
    public $document;

    public $allUsers, $selected_users = [];

    public function mount(){

        $this->dtaRequests = Dta::where('user_id', auth()->id())->orderBy('created_at','DESC')->get();

        $this->allUsers = User::where('department_id', Auth::user()->department_id)->get();
    }

    public function applyForDta(){
        $this->validate([
            'destination' => ['required','string'],
            'purpose' => ['required','string'],
            'travel_date' => ['required','date'],
            'arrival_date' => ['required','date'],
            'expense' => ['required','numeric','min:0'],
            'document' => 'nullable|file|mimes:pdf,docx,txt,jpg,png|max:2048',

            'selected_users' => ['nullable', 'array'], // For additional users
            'selected_users.*' => ['exists:users,id'], // Ensure valid user IDs
        ]);

        // Determine if the user belongs to a liaison office
        $unitId = Auth::user()->is_in_liaison_office ? null : Auth::user()->unit_id;

        // Add the authenticated user ID to the list of users
        $users = array_merge([auth()->id()], $this->selected_users ?? []);

        

        foreach ($users as $userId) {
            $user = User::find($userId);

            if($this->document){
                $supportingDocument = Carbon::now()->timestamp. '.' . $this->document->getClientOriginalName();
                $this->document->storeAs('documents',$supportingDocument);
            }
    
            Dta::create([
                'user_id' => $userId,
                'department_id' => $user->department_id,
                'unit_id' => $user->is_in_liaison_office ? null : $user->unit_id,
                'location' => $user->location_type ?: null,
                'purpose' => $this->purpose,
                'destination' => $this->destination,
                'travel_date' => $this->travel_date,
                'arrival_date' => $this->arrival_date,
                'estimated_expense' => $this->expense,
                'current_approver' => 'Unit Head',
                'supporting_document' => $supportingDocument,

            ]);
        }

        // $dtaRequest = Dta::create([
        //     'user_id' => auth()->id(),
        //     'department_id' => Auth::user()->department_id,
        //     'unit_id' => $unitId,
        //     'location' => Auth::user()->location_type ? : null,
        //     'purpose' => $this->purpose,
        //     'destination' => $this->destination,
        //     'travel_date' => $this->travel_date,
        //     'arrival_date' => $this->arrival_date,
        //     'estimated_expense' => $this->expense,
        //     'current_approver' => 'Unit Head',
        // ]);
        $this->reset(['destination','purpose','travel_date','arrival_date','expense','selected_users']);
        $this->dispatchBrowserEvent('success',["success" =>"DTA request submitted successfully."]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.dta.dta-component');
    }
}
