<?php

namespace App\Http\Livewire\Leave;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\Leave;
use App\Models\User;
use App\Models\LeaveApproval;
use Illuminate\Support\Facades\Auth;

class PendingLeavesComponent extends Component
{
    // public $pendingApprovals;
    // public $approvals;

    public $pendingApprovals;
    public $approvedLeaves;

    public $selLeave;

    public function mount()
    {
        $user = auth()->user();

        // Get pending approvals based on the user type
        $this->pendingApprovals = Leave::whereHas('approvals', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('status', 'Pending');
        })
        ->where(function ($query) use ($user) {
            // For Unit Head: allow approval if there is no Supervisor approval required
            if ($user->type == 'unit head') {
                $query->where(function ($subQuery) {
                    // Check if there's an 'Approved' Supervisor approval OR if no Supervisor approval exists
                    $subQuery->whereHas('approvals', function ($approvalQuery) {
                        $approvalQuery->where('type', 'supervisor')->where('status', 'Approved');
                    })->orWhereDoesntHave('approvals', function ($approvalQuery) {
                        $approvalQuery->where('type', 'supervisor');
                    });
                });
            }

            // For HOD: only allow approval if Unit Head approval exists
            if ($user->type == 'hod') {
                $query->whereHas('approvals', function ($subQuery) {
                    $subQuery->where('type', 'unit head')->where('status', 'Approved');
                });
            }
        })
        ->get();

        // Fetch leaves the user has already approved
        $this->approvedLeaves = Leave::whereHas('approvals', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('status', 'Approved');
        })->get();
            
    }

    public function approveLeave($leaveId)
    {
        $user = auth()->user();
        // Get the leave approval for the current user
        $leaveApproval = LeaveApproval::where('leave_id', $leaveId)
            ->where('approver_id', $user->id)->first();
        if ($leaveApproval) {
            // Approve the leave for this stage
            $leaveApproval->status = 'Approved';
            $leaveApproval->save();

            // Check if all approvals are complete to update the leave status
            $this->checkAllApprovalsComplete($leaveId);

            // Refresh the data
            $this->mount();
        }
        $this->dispatchBrowserEvent('success', ['success' => 'Leave request approved successfully.']);

    }

    public function checkAllApprovalsComplete($leaveId)
    {
        // Fetch the leave and its approval statuses
        $leave = Leave::find($leaveId);
        $approvalStatuses = $leave->approvals()->pluck('status');

        // If all approvals are "Approved", update the leave status
        if ($approvalStatuses->every(fn($status) => $status === 'Approved')) {
            $leave->status = 'Approved'; // or "Fully Approved"
            $leave->save();
        }
    }

    public function rejectLeave($leaveId)
    {
        $user = auth()->user();
        // Update leave approval status for the user
        $leaveApproval = LeaveApproval::where('leave_id', $leaveId)
            ->where('approver_id', $user->id)
            ->first();
        $leaveApproval->status = 'Rejected';
        $leaveApproval->save();
        $this->dispatchBrowserEvent('success', ['success' => 'Leave request rejected successfully.']);
        $this->mount();
    }

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
        return view('livewire.leave.pending-leaves-component');
    }
}
