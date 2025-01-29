<?php

namespace App\Http\Livewire\Query;

use Livewire\Component;
use App\Models\Query;
use App\Models\User;
use Livewire\WithFileUploads;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class RaiseQueryComponent extends Component
{
    use WithFileUploads;

    public $staff_id, $subject, $query_details, $queryDocument;
    public $description;

    public $secretCode;
    public $showSecretCodeModal = false;


    public function raiseQuery()
    {
        $this->showSecretCodeModal = true;
        $this->dispatchBrowserEvent('showSecretCodeModal');
    }


    public function verifyAndApprove()
    {
        $this->validate([
            'staff_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'query_details' => 'required|string',
            'queryDocument' => 'nullable|file|mimes:pdf,docx,txt,jpg,png|max:2048',
        ]);

        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code you entered is incorrect!"]);
            return;
        }

        if($this->queryDocument){
            $document = Carbon::now()->timestamp. '.' . $this->queryDocument->getClientOriginalName();
            $this->queryDocument->storeAs('documents',$document);
        }

        $query = Query::create([
            'raised_by' => auth()->id(),
            'staff_id' => $this->staff_id,
            'subject' => $this->subject,
            'query_details' => $this->query_details,
            'attachment' => $document ?? null,
            'status' => 'Pending',
        ]);


        $this->dispatchBrowserEvent('success', ['success' => 'Query raised successfully!']);
        $this->reset();
        return redirect()->route('query.index');
    }

    public function getStaffRecords()
    {
        $authUser = Auth::user();

        $staff = User::query()->where('type', '!=', 'contractor');

        // Check user role and apply filtering conditions
        if ($authUser->type === 'DG') {
            return $staff->get();
        }

        if ($authUser->type === 'director') {
            $staff->where('department_id', $authUser->department_id);
        }

        if ($authUser->type === 'unit head') {
            $staff->where('department_id', $authUser->department_id)
                ->where('unit_id', $authUser->unit_id);
        }

        if ($authUser->type === 'liaison officer') {
            $staff->where('location', $authUser->location)
                ->where('location_type', $authUser->location_type);
        }

        if ($authUser->type === 'supervisor') {
            $staff->where('department_id', $authUser->department_id);
        }

        return $staff->get();
    }

    public function render()
    {
        $staff = $this->getStaffRecords();

        return view('livewire.query.raise-query-component',compact('staff'));
    }
}
