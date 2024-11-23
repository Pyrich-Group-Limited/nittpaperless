<?php

namespace App\Http\Controllers\DashControls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\Leave;
use App\Models\User;
use App\Models\LeaveApproval;
use Illuminate\Support\Facades\Auth;

class LeaveApprovalContoller extends Controller
{
    // Show pending approvals for the logged-in user
    public function index() {
        $approvals = LeaveApproval::where('approver_id', auth()->id())
            ->where('status', 'pending')
            ->get();
        return view('hrm.approvals', compact('approvals'));
    }

    // Approve or reject leave
    public function update(Request $request, $id) {
        $approval = LeaveApproval::find($id);
        $approval->status = $request->status;
        $approval->save();

        // If the current stage is HOD and the status is approved, update the leave status to approved
        if ($approval->approval_stage == 'hod' && $request->status == 'approved') {
            // Find the corresponding leave
            $leave = Leave::find($approval->leave_id);
            // Update leave status to approved
            $leave->status = 'Approved';
            $leave->save();
        }

        // If approved and current stage is supervisor, create next approval for Unit Head
        if ($request->status == 'approved') {
            if ($approval->approval_stage == 'supervisor') {
                $this->createNextApproval($approval->leave_id, 'unit head');
            } elseif ($approval->approval_stage == 'unit head') {
                $this->createNextApproval($approval->leave_id, 'hod');
            }
        }

        return redirect()->route('approvals.index')->with('success', 'Leave approval updated.');
    }

    private function createNextApproval($leaveId, $stage) {
        $leave = Leave::find($leaveId);
        // dd($leave);
        $approverId = $this->getApproverByStage($leave->employee_id, $stage);

        LeaveApproval::create([
            'leave_id' => $leave->id,
            'approver_id' => $approverId,
            'approval_stage' => $stage,
            'status' => 'pending'
        ]);
    }

    private function getApproverByStage($userId, $stage) {
        // Get the user who is applying for leave
        $user = User::find($userId);

        if (!$user) {
            // throw new Exception('User not found.');
            return back()->with('error','User not found.');
        }

        // Determine the approver based on the stage
        if ($stage == 'supervisor') {
            // Fetch the supervisor in the same unit and department
            $approver = User::where('type', 'supervisor')
                ->where('unit_id', $user->unit_id)
                ->where('department_id', $user->department_id)
                ->first();
        } elseif ($stage == 'unit head') {
            // Fetch the unit head in the same unit
            $approver = User::where('type', 'unit head')
                ->where('unit_id', $user->unit_id)
                ->first();
        } elseif ($stage == 'hod') {
            // Fetch the head of department in the same department
            $approver = User::where('type', 'hod')
                ->where('department_id', $user->department_id)
                ->first();
        } else {
            // throw new Exception('Invalid approval stage.');
            return back()->with('error','Invalid approval stage.');
        }

        // Check if an approver was found
        if ($approver) {
            return $approver->id;
        } else {
            return back()->with('error',"Approver for stage '{$stage}' not found.");
            // throw new Exception("Approver for stage '{$stage}' not found.");
        }
    }
}
