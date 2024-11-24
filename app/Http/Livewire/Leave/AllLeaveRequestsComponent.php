<?php

namespace App\Http\Livewire\Leave;

use Livewire\Component;
use App\Models\LeaveType;
use App\Models\Leave;
use App\Models\User;
use App\Models\LeaveApproval;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;

class AllLeaveRequestsComponent extends Component
{
    public $selLeave;
    public $actionId;

    public function setLeave($leaveId)
    {
        $this->selLeave = Leave::find($leaveId);

        if ($this->selLeave) {
            $this->dispatchBrowserEvent('success', ['success' => 'Leave data loaded successfully']);
        } else {
            $this->dispatchBrowserEvent('success', ['success' => 'Leave data not found']);
        }
    }

    public function render()
    {
        $leaves = Leave::orderBy('created_at','desc')->get();
        return view('livewire.leave.all-leave-requests-component',compact('leaves'));
    }
}
