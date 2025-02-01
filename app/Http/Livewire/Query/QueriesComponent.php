<?php

namespace App\Http\Livewire\Query;

use Livewire\Component;
use App\Models\Query;
use App\Models\User;
use Livewire\WithFileUploads;
use Auth;
use Carbon\Carbon;
use Livewire\WithPagination;

class QueriesComponent extends Component
{
    use WithPagination;

    protected $listeners = ['approve-confirmed'=>'assignQuery'];

    // public $queries;

    protected $queries;

    public $selQuery;
    public $actionId;

    public $selQueryAnswer;

    public function mount()
    {

    }

    public function setQuery($queryId)
    {
        $this->selQuery = Query::find($queryId);
    }

    public function setQueryAnswer($queryId)
    {
        $this->selQueryAnswer = Query::find($queryId);
    }

    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function assignQuery()
    {
        $user = auth()->user();
        $queryId = $this->actionId;

        // Ensure the user has the 'assign query' permission
        if (!$user->can('assign query')) {
            $this->dispatchBrowserEvent('error', ['error' => 'You do not have permission to assign queries!']);
            return;
        }

        $query = Query::find($queryId);

        // Ensure the query exists and is pending
        if (!$query || $query->status !== 'Pending') {
            $this->dispatchBrowserEvent('error', ['error' => 'Query not found or is not in a pending state!']);
            return;
        }

        // Assign the query to the staff
        $query->status = 'Issued';
        $query->assigned_by = $user->id; // The HRM assigning the query
        $query->save();

        $this->dispatchBrowserEvent('success', ['success' => 'Query assigned successfully.']);
        $this->mount();
    }

    public function downloadFile($attachment)
    {
        $filePath = public_path('assets/documents/documents/' . $this->selQuery->attachment);

        if (file_exists($filePath)) {
            return response()->download($filePath, $this->selQuery->attachment);
        } else {
            $this->dispatchBrowserEvent('error',["error" =>"Document not found!."]);
        }
    }


    public function downloadAnserDocument($supporting_documents)
    {
        $filePath = public_path('assets/documents/documents/' . $this->selQueryAnswer->answers->supporting_documents);

        if (file_exists($filePath)) {
            return response()->download($filePath, $this->selQueryAnswer->answers->supporting_documents);
        } else {
            $this->dispatchBrowserEvent('error',["error" =>"Document not found!."]);
        }
    }

    public function render()
    {
        $user = auth()->user();

        if ($user->can('raise query') && in_array($user->type, ['director', 'unit head', 'supervisor', 'DG'])) {
            $this->queries = Query::where('raised_by', $user->id)->orderBy('created_at','desc')->simplePaginate(10);
        }
        elseif ($user->can('assign query') && $user->type == 'registrar') {
            $this->queries = Query::where('assigned_by', $user->id)->orWhere('status', 'Pending')
            ->orderBy('created_at','desc')->simplePaginate(10);
        }
        else {
            $this->queries = Query::where('staff_id', $user->id)->where('status','!=', 'Pending')
            ->orderBy('created_at','desc')->simplePaginate(10);
        }
        return view('livewire.query.queries-component',[
            'queries' => $this->queries,
        ]);
    }
}
