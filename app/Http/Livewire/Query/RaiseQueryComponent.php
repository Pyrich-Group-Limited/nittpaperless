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


        // Notify HRM (optional: use notification or event)
        $this->dispatchBrowserEvent('success', ['success' => 'Query raised successfully!']);
        $this->reset();
        return redirect()->route('query.index');
    }

    public function render()
    {
        $staff = User::where('department_id', Auth::user()->department_id)->get();

        return view('livewire.query.raise-query-component',compact('staff'));
    }
}
