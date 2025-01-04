<?php

namespace App\Http\Livewire\Dta;

use Livewire\Component;
use App\Models\Dta;
use App\Models\DtaApproval;
use App\Models\User;
use App\Models\DtaRejectionComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LiasonOfficeHeadDtaComponent extends Component
{
    public $dta;
    public $comments;
    public $selDta;
    public $actionId;

    public $secretCode;
    public $showSecretCodeModal = false;


    public function mount(){

        $user = auth()->user();

        $this->dtaRequests = Dta::where('status', 'liaison_head_approval')
        ->whereDoesntHave('approvalRecords', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('role', $user->type);
        })->where('location',Auth::user()->location_type)
        ->orderBy('created_at', 'desc')->get();

        $this->approvedDtaRequests = Dta::whereHas('approvalRecords', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('role', $user->type)
                ->where('status', 'approved');
        })->where('location',Auth::user()->location_type)
        ->orderBy('created_at', 'desc')->get();
    }

    public function setDta(Dta $dta){
        $this->selDta = $dta;
    }

    public function liasonHeadApproveDta()
    {
        if ($this->selDta->status != 'liaison_head_approval') {
            $this->dispatchBrowserEvent('error', ["error" => "DTA requires an approval."]);
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

        $approverId = User::where('type', '!=', 'super admin')->where('type', '!=', 'DG')
            ->whereHas('permissions', function ($query) {
                $query->where('name', 'special duty approve');
            })->first();

        if (!$approverId) {
            $this->dispatchBrowserEvent('error',["error" =>"No next approver found with the special duty approval permission"]);
            return;
        }

        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect!"]);
            return;
        }

        $this->selDta->update(['status' => 'liaison_head_approved']);

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
                    route('dtaApproval.specialDuty')
                );
            } else {
                $this->dispatchBrowserEvent('error',["error" =>"Attempted to create a notification for a non-existing user ID: $approverId"]);
            }
        }
        $this->dispatchBrowserEvent('success',["success" =>"DTA approved successfully."]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.dta.liason-office-head-dta-component');
    }
}
