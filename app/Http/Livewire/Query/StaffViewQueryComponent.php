<?php

namespace App\Http\Livewire\Query;

use Livewire\Component;
use App\Models\QueryAnswer;
use App\Models\Query;
use Livewire\WithFileUploads;
use Auth;
use Carbon\Carbon;

class StaffViewQueryComponent extends Component
{
    use WithFileUploads;
    public $queries, $answer, $supporting_documents, $signature;

    public $query;
    public $query_id;
    public $description;

    public function mount($id)
    {
        // $this->queries = Query::where('staff_id', auth()->id())->get();
        $this->query_id = $id;
        $query = Query::find($this->query_id);
        $this->subject = $query->subject;
    }

    public function answerQuery()
    {
        $this->validate([
            'query_id' => 'required|exists:queries,id',
            'answer' => 'required|string',
            'supporting_documents' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $query = Query::find($this->query_id);
        if ($query->staff_id !== auth()->id()) {
            abort(403);
        }

        if($this->supporting_documents){
            $documentsPath = Carbon::now()->timestamp. '.' . $this->supporting_documents->getClientOriginalName();
            $this->supporting_documents->storeAs('documents',$documentsPath);
        }

        QueryAnswer::create([
            'query_id' => $query->id,
            'staff_id' => auth()->id(),
            'answer' => $this->answer,
            'supporting_documents' => $documentsPath,
            'answered_at' => now(),
        ]);

        $query->update(['status' => 'Answered']);
        $this->dispatchBrowserEvent('success', ['success' => 'Query answered successfully!']);
        $this->reset(['answer','supporting_documents']);
        return redirect()->route('query.index');
    }

    public function render()
    {
        return view('livewire.query.staff-view-query-component');
    }
}
