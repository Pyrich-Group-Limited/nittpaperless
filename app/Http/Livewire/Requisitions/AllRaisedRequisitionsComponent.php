<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\ChartOfAccount;

class AllRaisedRequisitionsComponent extends Component
{
    public $requisition;
    public $comments;
    public $selRequisition;
    public $actionId;

    public $chartAccount;

    protected $listeners = ['approveRequisition', 'rejectRequisition'];

    public function mount()
    {
        $this->requisitions = StaffRequisition::where('status','!=','pending')
        ->orderBy('created_at','desc')->get();

        $this->accounts = ChartOfAccount::all();
    }

    public function setRequisition(StaffRequisition $requisition){
        $this->selRequisition = $requisition;
    }

    public function downloadFile($supporting_document)
    {
        // Check if the file exists in the public folder
        $filePath = public_path('assets/documents/documents/' . $this->selRequisition->supporting_document);
        
        if (file_exists($filePath)) {
            return response()->download($filePath, $this->selRequisition->supporting_document);
        } else {
            $this->dispatchBrowserEvent('error',["error" =>"Document not found!."]);
        }
    }

    public function render()
    {
        return view('livewire.requisitions.all-raised-requisitions-component');
    }
}
