<?php

namespace App\Http\Livewire\Dta;

use Livewire\Component;
use App\Models\Dta;
use App\Models\DtaApproval;
use App\Models\User;
use App\Models\DtaRejectionComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UnitHeadDtaComponent extends Component
{
    public $dta;
    public $comments;
    public $selDta;
    public $actionId;

    public $secretCode;
    public $showSecretCodeModal = false;


    public function mount(){

        // $this->dtaRequests = Dta::where('department_id',Auth::user()->department_id)->where('unit_id',Auth::user()->unit_id)
        // ->orderBy('created_at','DESC')->get();

        $user = auth()->user();

        $this->dtaRequests = Dta::where('status', 'pending')
        ->whereDoesntHave('approvalRecords', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('role', $user->type);
        })->where('department_id',Auth::user()->department_id)->where('unit_id',Auth::user()->unit_id)
        ->orderBy('created_at', 'desc')->get();

        $this->approvedDtaRequests = Dta::whereHas('approvalRecords', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('role', $user->type)
                ->where('status', 'approved');
        })->where('department_id',Auth::user()->department_id)->where('unit_id',Auth::user()->unit_id)
        ->orderBy('created_at', 'desc')->get();
    }

    public function setDta(Dta $dta){
        $this->selDta = $dta;
    }

    public function unitHeadApproveDta()
    {
        if ($this->selDta->status != 'pending') {
            $this->dispatchBrowserEvent('error', ["error" => "DTA required an approval."]);
            return;
        }

        $this->showSecretCodeModal = true;
        $this->dispatchBrowserEvent('showSecretCodeModal');
    }



    public function verifyAndApprove()
    {
        $approverId = User::where('type', 'hod')
        ->where('department_id', Auth::user()->department_id)
        ->first();

        $this->validate([
            'secretCode' => 'required',
        ]);

        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect.!."]);
            return;
        }

        $this->selDta->update(['status' => 'unit_head_approved']);

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
                    route('dtaApproval.hod')
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
        return view('livewire.dta.unit-head-dta-component');
    }
}
