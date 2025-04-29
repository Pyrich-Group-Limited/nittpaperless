<?php

namespace App\Http\Livewire\Dta;

use Livewire\Component;
use App\Models\Dta;
use App\Models\DtaApproval;
use App\Models\User;
use App\Models\DtaRejectionComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ChartOfAccount;

class PaymentVoucherDtaComponent extends Component
{
    public $dta;
    public $comments;
    public $selDta;
    public $actionId;

    public $chartAccount;
    public $secretCode;
    public $showSecretCodeModal = false;

    public function mount(){
        $user = auth()->user();

        $this->dtaRequests = Dta::where('status', 'bursar_approved')
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

    public function pvApproveDta()
    {
        if ($this->selDta->status != 'bursar_approved') {
            $this->dispatchBrowserEvent('error', ["error" => "DTA requires Bursary approval first."]);
            return;
        }

        $this->showSecretCodeModal = true;
        $this->dispatchBrowserEvent('showSecretCodeModal');
    }

    public function verifyAndApprove()
    {
        $this->validate([
            'chartAccount' => 'required',
            'secretCode' => 'required',
        ]);

        $approverId = User::where('type', '!=', 'super admin')->where('type', '!=', 'dg')
            ->whereHas('permissions', function ($query) {
                $query->where('name', 'audit approve');
            })->first();

        if (!$approverId) {
            $this->dispatchBrowserEvent('error',["error" =>"No next approver found with the audit approval permission"]);
            return; // Exit the function
        }

        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect!"]);
            return;
        }

        $this->selDta->update([
            'status' => 'pv_approved',
            'account_id' => $this->chartAccount
        ]);


        DtaApproval::create([
            'dta_id' => $this->selDta->id,
            'approver_id' => auth()->id(),
            'role' => auth()->user()->type,
            'status' => 'approved',
            'comments' => $this->comments,
        ]);
        if ($approverId) {
            $approver = User::find($approverId);
            if ($approver) {
                createNotification(
                    $approverId->id,
                    'DTA Approval Request',
                    'A new DTA approval request requires your attention.',
                    route('dtaApproval.audit')
                );
            } else {
                $this->dispatchBrowserEvent('error',["error" =>"Attempted to create a notification for a non-existing user ID: $approverId"]);
            }
        }
        $msg = sprintf("Your approval is successful and forwarded to %s for the next approval stage.", $approverId->name);
        $this->dispatchBrowserEvent('success', ["success" => $msg]);
        // $this->dispatchBrowserEvent('success',["success" =>"DTA approved successfully."]);
        $this->mount();
        $this->reset(['secretCode','chartAccount']);
    }

    public function render()
    {
        return view('livewire.dta.payment-voucher-dta-component');
    }
}
