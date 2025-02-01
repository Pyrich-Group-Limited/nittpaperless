<?php

namespace App\Http\Livewire\Leave;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\Leave;
use App\Models\User;
use App\Models\Department;
use App\Models\LeaveApproval;
use Illuminate\Support\Facades\Auth;

class PendingLeavesComponent extends Component
{
    protected $listeners = ['approve-confirmed'=>'approveLeave', 'delete-confirmed'=>'rejectLeave'];

    public $pendingApprovals;
    public $approvedLeaves;

    public $selLeave;

    public $actionId;

    public function mount()
    {
        $user = auth()->user();

        $specialDutyDepartment = Department::where('name', 'Special Duty Department')->first();

        $this->pendingApprovals = Leave::whereHas('approvals', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('status', 'Pending');
        })
        ->where(function ($query) use ($user,$specialDutyDepartment) {
            // For Unit Head: allow approval if there is no Supervisor approval required
            if ($user->type == 'unit head') {
                $query->where(function ($subQuery) {
                    $subQuery->whereHas('approvals', function ($approvalQuery) {
                        $approvalQuery->where('type', 'supervisor')->where('status', 'Approved');
                    })->orWhereDoesntHave('approvals', function ($approvalQuery) {
                        $approvalQuery->where('type', 'supervisor');
                    });
                });
            }

            // For Normal HOD: only allow approval if Unit Head approval exists
                if ($user->type == 'director' && $user->department_id != $specialDutyDepartment->id) {
                    $query->whereHas('approvals', function ($subQuery) {
                        $subQuery->where('type', 'unit head')->where('status', 'Approved');
                    });
                }

            if ($user->department_id == $specialDutyDepartment->id && $user->type == 'director') {
                $query->whereHas('approvals', function ($subQuery) {
                    $subQuery->where('type', 'liaison officer')->where('status', 'Approved');
                });
            }

            // For Registrar: only allow approval if HOD approval exists
            if ($user->type == 'registrar') {
                $query->whereHas('approvals', function ($subQuery) {
                    $subQuery->where('type', 'director')->where('status', 'Approved');
                });
            }
        })
        ->orderBy('created_at', 'desc')->get();

        // Fetch leaves the user has already approved
        $this->approvedLeaves = Leave::whereHas('approvals', function ($query) use ($user) {
            $query->where('approver_id', $user->id)
                ->where('status', 'Approved');
        })->orderBy('created_at', 'desc')->get();

        // dd($this->pendingApprovals);
    }


    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function approveLeave()
    {
        $user = auth()->user();
        $leaveId = $this->actionId;

        if (!$leaveId) {
            $this->dispatchBrowserEvent('error', ['error' => 'No leave ID provided.']);
            return;
        }

        // Get the leave approval for the current user
        $leaveApproval = LeaveApproval::where('leave_id', $leaveId)
            ->where('approver_id', $user->id)->first();
        if ($leaveApproval) {
            // Approve the leave for this stage
            $leaveApproval->status = 'Approved';
            $leaveApproval->save();

            // Check if all approvals are complete to update the leave status
            $this->checkAllApprovalsComplete($leaveId);

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
            $leave->status = 'Approved';
            $leave->save();

            createNotification(
                $leave->employee_id,
                'Leave Approved',
                'Your Leave Request has been approved',
                route('hrm.leave'),
            );
        }


    }

    public function rejectLeave()
    {
        $user = auth()->user();
        $leaveId = $this->actionId;

        $leave = Leave::find($leaveId);
        // Update leave approval status for the user
        $leaveApproval = LeaveApproval::where('leave_id', $leaveId)
            ->where('approver_id', $user->id)
            ->first();
        $leaveApproval->status = 'Rejected';
        $leaveApproval->save();

        $leave->status = 'Rejected';
        $leave->save();

        $this->dispatchBrowserEvent('success', ['success' => 'Leave request rejected successfully.']);
        $this->mount();
    }

    public function setLeave($leaveId)
    {
        $this->selLeave = Leave::find($leaveId);
    }

    public function downloadFile($supporting_document)
    {
        $filePath = public_path('assets/documents/documents/' . $this->selLeave->supporting_document);

        if (file_exists($filePath)) {
            return response()->download($filePath, $this->selLeave->supporting_document);
        } else {
            $this->dispatchBrowserEvent('error',["error" =>"Document not found!."]);
        }
    }

    public function render()
    {
        return view('livewire.leave.pending-leaves-component');
    }
}
