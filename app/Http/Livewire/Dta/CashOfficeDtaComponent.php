<?php

namespace App\Http\Livewire\Dta;

use Livewire\Component;
use App\Models\Dta;
use App\Models\DtaApproval;
use App\Models\User;
use App\Models\DtaRejectionComment;
use Illuminate\Support\Facades\Auth;
use App\Models\ChartOfAccount;
use Livewire\WithFileUploads;
use Carbon\Carbon;


class CashOfficeDtaComponent extends Component
{
    use WithFileUploads;
    public $dta;
    public $comments;
    public $selDta;
    public $actionId;
    public $chartAccount;
    public $paymentEvidence;

    public function mount(){
        $user = auth()->user();

        $this->dtaRequests = Dta::where('status', 'audit_approved')
        ->whereDoesntHave('approvalRecords', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('role', $user->type);
        })->orderBy('created_at', 'desc')->get();
        
        $this->approvedDtaRequests = Dta::whereHas('approvalRecords', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('role', $user->type)
                ->where('status', 'approved');
        })->orderBy('created_at', 'desc')->get();

        $this->accounts = ChartOfAccount::all();
    }

    public function setDta(Dta $dta){
        $this->selDta = $dta;
    }

    public function cashOfficeApproveDta()
    {
        $this->validate([
            'paymentEvidence' => 'required',
        ]);

        $payEvidence = Carbon::now()->timestamp. '.' . $this->paymentEvidence->getClientOriginalName();
        $this->paymentEvidence->storeAs('documents',$payEvidence);

        if ($this->selDta->status != 'audit_approved') {
            $this->dispatchBrowserEvent('error',["error" =>"DTA required an approval."]);
        } else {
            $this->selDta->update([
                // 'status' => 'cash_office_approved',
                'status' => 'approved',
                'payment_evidence' => $payEvidence
            ]);
        }

        DtaApproval::create([
            'dta_id' => $this->selDta->id,
            'approver_id' => auth()->id(),
            'role' => auth()->user()->type,
            'status' => 'approved',
            'comments' => $this->comments,
        ]);
        $this->dispatchBrowserEvent('success',["success" =>"DTA approved successfully."]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.dta.cash-office-dta-component');
    }
}
