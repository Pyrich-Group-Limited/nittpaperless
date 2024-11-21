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

class LeavesComponent extends Component
{
    public $type_of_leave;
    public $start_date;
    public $end_date;
    public $reason;
    public $relieving_staff;


    public function applyForLeave(){
        $this->validate([
            'type_of_leave' => ['required','string'],
            'start_date' => ['required','string'],
            'end_date' => ['required','string'], 
            'reason' => ['required','string'],
            'relieving_staff' => ['required'],
        ]);

        $leaeType = LeaveType::find($this->type_of_leave);
        $myLeave = Leave::where('employee_id',Auth::user()->id)->where('status','Pending')->first();
        $leaveDuration = round(strtotime($this->end_date) - strtotime($this->start_date))/ 86400;

        if($myLeave!=null){
            $this->dispatchBrowserEvent('error',["error" =>"Sorry you already have a pending leave application"]);
        }elseif(strtotime($this->start_date)<strtotime(date('Y-m-d'))){
            $this->dispatchBrowserEvent('error',["error" =>"Sorry your start date can not be later than today"]);
        }elseif($leaveDuration<=0){
            $this->dispatchBrowserEvent('error',["error" =>"Sorry your start date can not be later than start"]);
        }elseif($leaveDuration>$leaeType->days){
            $this->dispatchBrowserEvent('error',["error" =>'Sorry you can not apply for more than '.$leaveType->days. ' for '.$leaveType->name]);

        }else{
            $leave = Leave::create([
                'employee_id' => Auth::user()->id,
                'department_id' => Auth::user()->department->id,
                'unit_id' => Auth::user()->unit ? Auth::user()->unit->id : null, // Set to null if no unit
                'created_by' => Auth::user()->id,
                'leave_type_id' => $this->type_of_leave,
                'applied_on' => Carbon::now(),
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'leave_reason' => $this->reason,
                'status' => "Pending", 
                'relieving_staff_id' => $this->relieving_staff,
                'total_leave_days' => $leaveDuration,
            ]);

            // Create first approval request (Supervisor)
            LeaveApproval::create([
                'leave_id' => $leave->id,
                'approver_id' => $this->getSupervisorId(auth()->user()->id),
                'approval_stage' => 'supervisor',
                'status' => 'pending'
            ]);

            $this->reset();
            $this->dispatchBrowserEvent('success',["success" =>"Leave Application Submitted Successful"]);
        }
    }

    private function getSupervisorId($userId) {
        // Get the user who is applying for leave
        $user = User::find($userId);

        // Fetch the supervisor in the same unit and department
        $supervisor = User::where('type', 'supervisor')
            ->where('unit_id', $user->unit_id)
            ->where('department_id', $user->department_id)
            ->first();

        // Check if a supervisor was found
        if ($supervisor) {
            return $supervisor->id;
        } else {
            // If no supervisor is found, handle appropriately (return null or throw exception)
            throw new Exception('Supervisor not found in the same unit and department.');
        }
    }

    public function render()
    {
        if(Auth::user()->can('manage leave')){
            $leaves = Leave::all();
        }else{
            $leaves = Leave::where('employee_id',Auth::user()->id)->get();
        }
        $leaveTypes = LeaveType::all();
        $staffs = user::where('type','!=','contractor')->where('department_id',Auth::user()->department->id)->get();
        return view('livewire.leave.leaves-component',compact('leaves','leaveTypes','staffs'));
    }
}
