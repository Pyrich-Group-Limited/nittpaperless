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
    protected $listeners = ['approveRequisition', 'rejectRequisition'];

    public $type_of_leave;
    public $start_date;
    public $end_date;
    public $reason;
    public $relieving_staff;

    public $selLeave;
    public $actionId;

    public function applyForLeave(){
        $this->validate([
            'type_of_leave' => ['required', 'integer', 'exists:leave_types,id'],
            // 'type_of_leave' => ['required'],
            'start_date' => ['required','string'],
            'end_date' => ['required','string'], 
            'reason' => ['required','string'],
            'relieving_staff' => ['required'],
        ]);

        $leaeType = LeaveType::find($this->type_of_leave);
        $myLeave = Leave::where('employee_id',Auth::user()->id)->where('status','Pending')->first();
        $leaveDuration = round((strtotime($this->end_date) - strtotime($this->start_date)) / 86400);
        // $leaveDuration = round(strtotime($this->end_date) - strtotime($this->start_date))/ 86400;

        if($myLeave!=null){
            $this->dispatchBrowserEvent('error',["error" =>"Sorry you already have a pending leave application"]);
        }elseif(strtotime($this->start_date)<strtotime(date('Y-m-d'))){
            $this->dispatchBrowserEvent('error',["error" =>"Sorry your start date can not be later than today"]);
        }elseif($leaveDuration<=0){
            $this->dispatchBrowserEvent('error',["error" =>"Sorry your start date can not be later than start"]);
        }elseif($leaveDuration>$leaeType->days){
            $this->dispatchBrowserEvent('error',["error" =>'Sorry you can not apply for more than '.$leaeType->days. ' for '.$leaeType->name]);

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

            // Find the supervisor in the same unit and department
            $supervisor = User::where('type', 'supervisor')
                ->where('unit_id', Auth::user()->unit_id)
                ->where('department_id', Auth::user()->department_id)->first();

            // Find the unit head
            $unitHead = User::where('type', 'unit head')
                ->where('unit_id', Auth::user()->unit_id)->first();

            // Find the department head
            $departmentHead = User::where('type', 'hod')
                ->where('department_id', Auth::user()->department_id)->first();

            // Add approvals based on availability
            if ($supervisor) {
                $this->createApproval($leave, $supervisor->id, $supervisor->type); // Add supervisor as first approver
                if ($unitHead) {
                    $this->createApproval($leave, $unitHead->id, $unitHead->type); // Add unit head as second approver
                }
            } elseif ($unitHead) {
                $this->createApproval($leave, $unitHead->id, $unitHead->type); // Add unit head as first approver
            }

            if ($departmentHead) {
                $this->createApproval($leave, $departmentHead->id, $departmentHead->type); // Add department head as final approver
            }

            $this->reset();
            $this->dispatchBrowserEvent('success', ['success' => 'Leave request submitted successfully.']);
            
        }
    }

    private function createApproval($leave, $approverId, $type)
    {
        LeaveApproval::create([
            'leave_id' => $leave->id,
            'approver_id' => $approverId,
            'approval_stage' => '',
            'type' => $type,
            'status' => 'Pending'
        ]);
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
        $leaves = Leave::where('employee_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        $leaveTypes = LeaveType::all();
        $staffs = user::where('type','!=','contractor')->where('department_id',Auth::user()->department->id)->get();
        return view('livewire.leave.leaves-component',compact('leaves','leaveTypes','staffs'));
    }
}
