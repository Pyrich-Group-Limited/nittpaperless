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
use Livewire\WithPagination;

class DtaComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $destination;
    public $purpose;
    public $travel_date;
    public $arrival_date;
    public $expense;
    public $document;

    public $allUsers, $selected_users = [];

    public function mount(){

        // $this->dtaRequests = Dta::where('user_id', auth()->id())->orderBy('created_at','DESC')->simplePaginate(10);

        $this->allUsers = User::where('department_id', Auth::user()->department_id)
        ->where('location', Auth::user()->location)
        ->get();
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
        $isLiaisonOffice = Auth::user()->is_in_liaison_office;

        $unitId = Auth::user()->is_in_liaison_office ? null : Auth::user()->unit_id;

        // Get the list of approvers
    $liaisonHead = User::where('type', 'liaison officer')
        ->where('location_type', Auth::user()->location_type)
        ->first();

    $unitHead = User::where('type', 'unit head')
        ->where('unit_id', Auth::user()->unit_id)
        ->first();

    // Determine the approver ID
    $approverId = $isLiaisonOffice ? ($liaisonHead ? $liaisonHead->id : null) : ($unitHead ? $unitHead->id : null);

        // Add the authenticated user ID to the list of users
        $users = array_merge([auth()->id()], $this->selected_users ?? []);

        foreach ($users as $userId) {
            $user = User::find($userId);

            $supportingDocument = null;
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
                'current_approver' => $isLiaisonOffice ? 'Liaison Head' : 'Unit Head',
                'status' => $isLiaisonOffice ? 'liaison_head_approval' : 'pending',
                'supporting_document' => $supportingDocument,

            ]);
        }
        if ($approverId) {
            createNotification(
                $approverId,
                'DTA Approval Request',
                'A new DTA approval request requires your attention.',
                ''
            );
        }
        $this->reset(['destination','purpose','travel_date','arrival_date','expense','selected_users']);
        $this->dispatchBrowserEvent('success',["success" =>"DTA request submitted successfully."]);
        $this->mount();
    }

    public function render()
    {
        $dtaRequests = Dta::where('user_id', auth()->id())
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('livewire.dta.dta-component', compact('dtaRequests'));
    }
}
