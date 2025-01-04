<?php

namespace App\Http\Livewire\Dta;

use Livewire\Component;
use App\Models\Dta;
use App\Models\DtaApproval;
use App\Models\User;
use App\Models\DtaRejectionComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SpecialDutyDtaComponent extends Component
{
    public $dta;
    public $comments;
    public $selDta;
    public $actionId;

    public $secretCode;
    public $showSecretCodeModal = false;

    public function mount(){

        $user = auth()->user();

        $this->dtaRequests = Dta::where('status', 'liaison_head_approved')
        ->whereDoesntHave('approvalRecords', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('role', $user->type);
        })
        ->orderBy('created_at', 'desc')->get();

        $this->approvedDtaRequests = Dta::whereHas('approvalRecords', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('role', $user->type)
                ->where('status', 'approved');
        })
        ->orderBy('created_at', 'desc')->get();
    }

    public function setDta(Dta $dta){
        $this->selDta = $dta;
    }

    public function specialDutyHeadApproveDta()
    {
        if ($this->selDta->status != 'liaison_head_approved') {
            $this->dispatchBrowserEvent('error', ["error" => "DTA requires Liaison Head approval first."]);
            return;
        }
        $this->showSecretCodeModal = true;
        $this->dispatchBrowserEvent('showSecretCodeModal');
    }

    public function verifyAndApprove()
    {
        $this->validate([
            'secretCode' => 'required'
        ]);

        $approverId = User::where('type', 'DG')
        ->first();

        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect!"]);
            return;
        }

        $this->selDta->update(['status' => 'special_duty_approved']);

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
                    route('dtaApproval.dg')
                );
            } else {
                $this->dispatchBrowserEvent('error',["error" =>"Attempted to create a notification for a non-existing user ID: $approverId"]);
            }
        }
        $this->dispatchBrowserEvent('success',["success" =>"DTA approved successfully."]);
        $this->mount();
        $this->reset('secretCode');
    }

    public function render()
    {
        return view('livewire.dta.special-duty-dta-component');
    }
}
