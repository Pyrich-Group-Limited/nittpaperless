<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use App\Models\ChartOfAccount;


class RaiseRequisitionComponent extends Component
{
    use WithFileUploads;
    protected $listeners = ['delete-confirmed'=>'deleteRequisition'];

    public $type, $purpose, $amount, $description, $document, $requisitions, $actionId, $selRequisition;

    public function mount()
    {
        $this->requisitions = StaffRequisition::where('staff_id',Auth::user()->id)->orderBy('created_at','desc')->get();
    }

    public function createRequisition()
    {
        $this->validate([
            'type' => 'required|string',
            'purpose' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'document' => 'required',
        ]);


        $supportDocument = Carbon::now()->timestamp. '.' . $this->document->getClientOriginalName();
        $this->document->storeAs('documents',$supportDocument);

        // Determine if the user belongs to a liaison office
        $unitId = Auth::user()->is_in_liaison_office ? null : Auth::user()->unit_id;

        StaffRequisition::create([
            'staff_id' => auth()->id(),
            'requisition_type' => $this->type,
            'purpose' => $this->purpose,
            'department_id' => Auth::user()->department_id,
            'unit_id' => $unitId,
            'location' => Auth::user()->location_type ? : null,
            'description' => $this->description,
            'amount' => $this->amount,
            'status' => 'pending',
            'supporting_document' => $supportDocument,
        ]);

        $this->dispatchBrowserEvent('success',["success" =>"Requisition raised successfully."]);
        $this->reset();
        $this->mount();
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


    public function setRequisition(StaffRequisition $requisition){
        $this->selRequisition = $requisition;
        $this->type = $requisition->requisition_type;
        $this->purpose = $requisition->purpose;
        $this->amount = $requisition->amount;
        $this->description = $requisition->description;
    }

    public function updateRequisition(){
        $this->validate([
            'type' => 'required|string',
            'purpose' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);
        if ($this->selRequisition->status!='pending') {
            $this->dispatchBrowserEvent('error', ['error' => "You can't modify an already been processed requisition."]);
            return;
        }
        $this->selRequisition->update([
            'staff_id' => auth()->id(),
            'requisition_type' => $this->type,
            'purpose' => $this->purpose,
            'description' => $this->description,
            'amount' => $this->amount,
            'status' => 'pending',
        ]);
        $this->dispatchBrowserEvent('success',["success" =>"Requisition updated successfully."]);
        $this->mount();
    }


    //set action id when the confirmation is required
    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function deleteRequisition(){
        $requisition = StaffRequisition::find($this->actionId);

        if ($requisition->status!='pending') {
            $this->dispatchBrowserEvent('error', ['error' => "This requisition cannot be deleted because it has already been processed."]);
            return;
        }
        $requisition->delete();
        $this->dispatchBrowserEvent('success', ['success' => "Requisition Successfully Deleted"]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.requisitions.raise-requisition-component');
    }
}
