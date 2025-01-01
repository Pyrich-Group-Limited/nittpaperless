<?php

namespace App\Http\Livewire\Dta;

use Livewire\Component;
use App\Models\Dta;
use App\Models\DtaApproval;
use App\Models\User;
use App\Models\DtaRejectionComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HodDtaComponent extends Component
{
    public $dta;
    public $comments;
    public $selDta;
    public $actionId;

    public $secretCode;
    public $showSecretCodeModal = false;


    public function mount(){

        $user = auth()->user();

        $this->dtaRequests = Dta::where('status', 'unit_head_approved')
        ->whereDoesntHave('approvalRecords', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('role', $user->type);
        })->where('department_id',Auth::user()->department_id)
        ->where('location',Auth::user()->location_type)
        ->orderBy('created_at', 'desc')->get();

        $this->approvedDtaRequests = Dta::whereHas('approvalRecords', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('role', $user->type)
                ->where('status', 'approved');
        })->where('department_id',Auth::user()->department_id)
        ->where('location',Auth::user()->location_type)
        ->orderBy('created_at', 'desc')->get();
    }

    public function setDta(Dta $dta){
        $this->selDta = $dta;
    }

    public function hodApproveDta()
    {
        if ($this->selDta->status != 'unit_head_approved') {
            $this->dispatchBrowserEvent('error', ["error" => "DTA requires unit head approval first."]);
            return;
        }

        $this->showSecretCodeModal = true;
        $this->dispatchBrowserEvent('showSecretCodeModal');
    }

    public function verifyAndApprove()
    {
        // Check if the DTA is in the correct status
        // if ($this->selDta->status != 'unit_head_approved') {
        //     $this->dispatchBrowserEvent('error', ["error" => "DTA requires unit head approval first."]);
        //     return;
        // }

        $this->validate([
            'secretCode' => 'required',
        ]);

        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect.!."]);
            return;
        }

        // Check if the HoD is under a liaison office
        $hod = auth()->user(); // The current HoD
        $isInLiaisonOffice = $hod->is_in_liaison_office;

        if ($isInLiaisonOffice) {
            $this->selDta->update(['status' => 'liaison_head_approval']);
        } else {
            $this->selDta->update(['status' => 'hod_approved']);
        }

        // Record the HoD's approval
        DtaApproval::create([
            'dta_id' => $this->selDta->id,
            'approver_id' => $hod->id,
            'role' => $hod->type,
            'status' => 'approved',
            'comments' => $this->comments,
        ]);

        $this->dispatchBrowserEvent('success', ["success" => "DTA approved successfully."]);
        $this->mount();
    }

    // public function hodApproveDta()
    // {
    //     if ($this->selDta->status != 'unit_head_approved') {
    //         $this->dispatchBrowserEvent('error',["error" =>"DTA required an approval."]);
    //     } else {
    //         $this->selDta->update(['status' => 'hod_approved']);
    //     }

    //     DtaApproval::create([
    //         'dta_id' => $this->selDta->id,
    //         'approver_id' => auth()->id(),
    //         'role' => auth()->user()->type,
    //         'status' => 'approved',
    //         'comments' => $this->comments,
    //     ]);
    //     $this->dispatchBrowserEvent('success',["success" =>"DTA approved successfully."]);
    //     $this->mount();
    // }

    public function render()
    {
        return view('livewire.dta.hod-dta-component');
    }
}
