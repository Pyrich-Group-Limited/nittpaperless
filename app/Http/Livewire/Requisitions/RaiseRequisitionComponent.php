<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use App\Models\ChartOfAccount;
use App\Models\User;


class RaiseRequisitionComponent extends Component
{
    use WithFileUploads;
    protected $listeners = ['delete-confirmed'=>'deleteRequisition'];

    public $type, $purpose, $amount, $description, $document, $requisitions, $actionId, $selRequisition;

    public $approvals;
    public $selectedRequisitionId;

    public $secretCode;
    public $showSecretCodeModal = false;


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'type' => 'required|string',
            'purpose' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'document' => 'required',
            'secretCode' => 'required|string',
        ]);
    }


    public function mount()
    {
        $this->requisitions = StaffRequisition::where('staff_id',Auth::user()->id)->orderBy('created_at','desc')->get();

        // Set default selected requisition to the first one (if any)
        if ($this->requisitions->isNotEmpty()) {
            $this->selectedRequisitionId = $this->requisitions->first()->id;
            $this->loadApprovals();
        }
    }

    public function loadApprovals()
    {
        $this->approvals = RequisitionApprovalRecord::with(['approver.signature'])
            ->where('requisition_id', $this->selectedRequisitionId)
            ->get();
    }

    public function selectRequisition($requisitionId)
    {
        $this->selectedRequisitionId = $requisitionId;
        $this->loadApprovals();
    }

    public function submitForm()
    {
        // Validate the first step of the form
        $this->validate([
            'type' => 'required|string',
            'purpose' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'document' => 'required',
        ]);

        // Show the secret code modal
        $this->showSecretCodeModal = true;
        $this->dispatchBrowserEvent('showSecretCodeModal');
    }

    public function verifyAndSubmit()
    {
        $this->validate([
            'secretCode' => 'required',
        ]);

        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect.!."]);
            return;
        }

        $supportDocument = Carbon::now()->timestamp . '.' . $this->document->getClientOriginalName();
        $this->document->storeAs('documents', $supportDocument);

        // Determine if the user belongs to a liaison office
        $unitId = Auth::user()->is_in_liaison_office ? null : Auth::user()->unit_id;

        // Set the requisition status based on liaison office condition
        $status = Auth::user()->is_in_liaison_office ? 'liaison_head_approval' : 'pending';

        // Determine if the user belongs to a liaison office
        $isLiaisonOffice = Auth::user()->is_in_liaison_office;

        $liaisonHead = User::where('type', 'liaison officer')
            ->where('location_type', Auth::user()->location_type)
            ->first();

        $departmentHead = User::where('type', 'director')
            ->where('department_id', Auth::user()->department_id)
            ->first();

        // Determine the approver ID
        $approverId = $isLiaisonOffice ? ($liaisonHead ? $liaisonHead->id : null) : ($departmentHead ? $departmentHead->id : null);

        StaffRequisition::create([
            'staff_id' => auth()->id(),
            'requisition_type' => $this->type,
            'purpose' => $this->purpose,
            'department_id' => Auth::user()->department_id,
            'unit_id' => $unitId,
            'location' => Auth::user()->location_type ?: null,
            'description' => $this->description,
            'amount' => $this->amount,
            'status' => $status,
            'supporting_document' => $supportDocument,
        ]);

        if ($approverId) {
            $route = Auth::user()->is_in_liaison_office
            ? route('liaison.requisitions')
            : route('hod.requisitions');

            createNotification(
                $approverId,
                'Requsition Approval Request',
                'A new Requsition by '. Auth::user()->name.' requires your approval.',
                $route,
            );
        }

        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('success', ["success" => "Requisition raised successfully."]);
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
