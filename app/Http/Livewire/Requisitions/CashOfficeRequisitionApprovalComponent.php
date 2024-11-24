<?php

namespace App\Http\Livewire\Requisitions;

use Livewire\Component;
use App\Models\StaffRequisition;
use App\Models\RequisitionApprovalRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\ChartOfAccount;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class CashOfficeRequisitionApprovalComponent extends Component
{
    use WithFileUploads;
    public $requisition;
    public $comments;
    public $selRequisition;
    public $actionId;

    public $chartAccount;

    // public $account;
    public $paymentEvidence;
    
    public function mount()
    {
        $user = auth()->user();
        // $this->requisitions = StaffRequisition::where('status','audit_approved')
        // ->orderBy('created_at','desc')->get();

        $this->requisitions = StaffRequisition::where(function($query) use ($user) {
            $query->where('status', 'audit_approved')
                  ->orWhereHas('approvalRecords', function($subQuery) use ($user) {
                      $subQuery->where('approver_id', $user->id)
                        ->where('role', $user->type); 
                  });
        })
        ->orderBy('created_at', 'desc')
        ->get();

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

    public function cashOfficeApproveRequisition()
    {
        $this->validate([
            'paymentEvidence' => 'required',
        ]);

        $payEvidence = Carbon::now()->timestamp. '.' . $this->paymentEvidence->getClientOriginalName();
        $this->paymentEvidence->storeAs('documents',$payEvidence);

        if ($this->selRequisition->status != 'audit_approved') {
            $this->dispatchBrowserEvent('error',["error" =>"Requisition required audit approval."]);
        } else { 
            $this->selRequisition->update([
                'status' => 'cash_office_approved',
                'payment_evidence' => $payEvidence
            ]);
        }

        RequisitionApprovalRecord::create([
            'requisition_id' => $this->selRequisition->id,
            'approver_id' => auth()->id(),
            'role' => auth()->user()->type,
            'status' => 'approved',
            'comments' => $this->comments,
        ]);
        $this->dispatchBrowserEvent('success',["success" =>"Requisition approved successfully."]);

        $this->mount();
    }

    public function rejectRequisition()
    {
        RequisitionApprovalRecord::create([
            'requisition_id' => $this->selRequisition->id,
            'approver_id' => auth()->id(),
            'role' => auth()->user()->type,
            'status' => 'rejected',
            'comments' => $this->comments,
        ]);
        $this->requisition->update(['status' => 'rejected']);
        $this->dispatchBrowserEvent('success',["success" =>"Requisition rejected."]);
        
        $this->mount();
    }

    public function render()
    {
        return view('livewire.requisitions.cash-office-requisition-approval-component');
    }
}
