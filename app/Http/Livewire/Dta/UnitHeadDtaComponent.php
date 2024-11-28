<?php

namespace App\Http\Livewire\Dta;

use Livewire\Component;
use App\Models\Dta;
use App\Models\DtaApproval;
use App\Models\User;
use App\Models\DtaRejectionComment;
use Illuminate\Support\Facades\Auth;

class UnitHeadDtaComponent extends Component
{
    public $dta;
    public $comments;
    public $selDta;
    public $actionId;


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
            $this->dispatchBrowserEvent('error',["error" =>"DTA required an approval."]);
        } else {
            $this->selDta->update(['status' => 'unit_head_approved']);
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
        return view('livewire.dta.unit-head-dta-component');
    }
}
