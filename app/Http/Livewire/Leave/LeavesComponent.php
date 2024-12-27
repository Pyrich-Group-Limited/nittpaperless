<?php

namespace App\Http\Livewire\Leave;

use Livewire\Component;
use App\Models\LeaveType;
use App\Models\Leave;
use App\Models\User;
use App\Models\Unit;
use App\Models\Department;
use App\Models\LeaveApproval;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;
use Livewire\WithFileUploads;

class LeavesComponent extends Component
{
    use WithFileUploads;
    protected $listeners = ['approveRequisition', 'rejectRequisition'];

    public $type_of_leave;
    public $start_date;
    public $end_date;
    public $reason;

    public $relieving_staff;
    public $leave_for_staff;
    public $unit_id;
    public $supportingDocument;

    public $sickPersonDetails;

    public $isSickLeave = false;
    public $selectedDepartment;
    public $departmentStaff = [];
    public $departmentUnits = [];


    public $selLeave;
    public $actionId;

    public function updatedTypeOfLeave($value)
    {
        $leaveType = LeaveType::find($value);
        $this->isSickLeave = $leaveType && $leaveType->title === 'Sick Leave';

        if ($this->isSickLeave && !Auth::user()->can('raise sick leave')) {
            $this->dispatchBrowserEvent('error', ['error' => 'You do not have permission to apply for sick leave.']);
            $this->type_of_leave = null;
            $this->isSickLeave = false;
        }
    }

    public function updatedSelectedDepartment($departmentId)
    {
        if ($departmentId) {
            $this->departmentStaff = User::where('department_id', $departmentId)->get();
            $this->departmentUnits = Unit::where('department_id', $departmentId)->get();
        } else {
            $this->departmentStaff = [];
            $this->departmentUnits = [];
        }
    }


    public function applyForLeave(){
        $this->validate([
            'type_of_leave' => ['required', 'integer', 'exists:leave_types,id'],
            'start_date' => ['required','string'],
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => ['required','string'],
            'leave_for_staff' => 'nullable|exists:users,id',
            'relieving_staff' => 'nullable|exists:users,id',
            'supportingDocument' => 'nullable|file|mimes:pdf,docs,jpg,png|max:2048',
        ]);

        $leaeType = LeaveType::find($this->type_of_leave);
        $myLeave = Leave::where('employee_id',Auth::user()->id)->where('status','Pending')->first();
        $leaveDuration = round((strtotime($this->end_date) - strtotime($this->start_date)) / 86400);

        if ($this->supportingDocument) {
            $document = Carbon::now()->timestamp. '.' . $this->supportingDocument->getClientOriginalName();
            $this->supportingDocument->storeAs('documents',$document);
        }

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
                'employee_id' => Auth::user()->can('raise sick leave') ? $this->leave_for_staff : Auth::user()->id,

                'department_id' => Auth::user()->can('raise sick leave')
                    ? $this->selectedDepartment
                    : Auth::user()->department->id,

                'unit_id' => Auth::user()->can('raise sick leave')
                    ? ($this->unit_id ? $this->unit_id : null)
                    : (Auth::user()->unit ? Auth::user()->unit->id : null),

                'created_by' => Auth::user()->id,
                'leave_type_id' => $this->type_of_leave,
                'applied_on' => Carbon::now(),
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'leave_reason' => $this->reason,
                'status' => "Pending",
                'relieving_staff_id' => $this->relieving_staff,
                'total_leave_days' => $leaveDuration,
                'supporting_document' => Auth::user()->can('raise sick leave') ? $document : null,
            ]);

            $specialDutyDepartment = Department::where('name', 'Special Duty Department')->first();

            $applicant = Auth::user()->can('raise sick leave') ? User::find($this->leave_for_staff) : Auth::user();

            if ($applicant->is_in_liaison_office) {
                // Liaison office-specific approval flow

                // Add liaison office head as the first approver
                $liaisonHead = User::where('type', 'liason office head')
                    ->where('location', $applicant->location)
                    ->first();
                if ($liaisonHead) {
                    $this->createApproval($leave, $liaisonHead->id, $liaisonHead->type, $liaisonHead->department_id ?? '');
                }

                // Add head of special duty department as the next approver
                $specialDutyHead = User::where('type', 'hod')->where('department_id',$specialDutyDepartment->id)->first();
                if ($specialDutyHead) {
                    $this->createApproval($leave, $specialDutyHead->id, $specialDutyHead->type, $specialDutyHead->department_id);
                }

                // Add registrar as the final approver
                $registrar = User::where('type', 'client')->first();
                if ($registrar) {
                    $this->createApproval($leave, $registrar->id, $registrar->type, $registrar->department_id ?? '');
                }
            } else {

                // Check if the user has the 'raise sick leave' permission
                if (Auth::user()->can('raise sick leave') && $this->leave_for_staff) {
                    // Find the selected staff's details
                    $selectedStaff = User::find($this->leave_for_staff);

                    // Find the supervisor in the same unit and department as the selected staff
                    $supervisor = User::where('type', 'supervisor')
                        ->where('unit_id', $selectedStaff->unit_id)
                        ->where('department_id', $selectedStaff->department_id)
                        ->first();
                } else {
                    // Find the supervisor in the authenticated user's unit and department
                    $supervisor = User::where('type', 'supervisor')
                        ->where('unit_id', Auth::user()->unit_id)
                        ->where('department_id', Auth::user()->department_id)
                        ->first();
                }

                if (Auth::user()->can('raise sick leave') && $this->leave_for_staff) {
                    // Find the selected staff's details
                    $selectedStaff = User::find($this->leave_for_staff);

                    // Find the unit head in the same unit as the selected staff
                    $unitHead = User::where('type', 'unit head')
                        ->where('unit_id', $selectedStaff->unit_id)
                        ->first();
                } else {
                    // Find the unit head in the authenticated user's unit
                    $unitHead = User::where('type', 'unit head')
                        ->where('unit_id', Auth::user()->unit_id)
                        ->first();
                }

                if (Auth::user()->can('raise sick leave') && $this->leave_for_staff) {
                    $selectedStaff = User::find($this->leave_for_staff);

                    $departmentHead = User::where('type', 'hod')
                        ->where('department_id', $selectedStaff->department_id)
                        ->first();
                } else {
                    $departmentHead = User::where('type', 'hod')
                        ->where('department_id', Auth::user()->department_id)
                        ->first();
                }


                // Add approvals based on availability
                if ($supervisor) {
                    $this->createApproval($leave, $supervisor->id, $supervisor->type, $supervisor->department_id); // Add supervisor as first approver
                    if ($unitHead) {
                        $this->createApproval($leave, $unitHead->id, $unitHead->type, $unitHead->department_id); // Add unit head as second approver
                    }
                } elseif ($unitHead) {
                    $this->createApproval($leave, $unitHead->id, $unitHead->type, $unitHead->department_id); // Add unit head as first approver
                }

                if ($departmentHead) {
                    $this->createApproval($leave, $departmentHead->id, $departmentHead->type, $departmentHead->department_id); // Add department head as final approver
                }

                $registrar = User::where('type', 'client')->first();
                if ($registrar) {
                    $this->createApproval($leave, $registrar->id, $registrar->type, $registrar->department_id ?? ''); // Add registrar as final approver
                }
            }

            $this->reset();
            $this->dispatchBrowserEvent('success', ['success' => 'Leave request submitted successfully.']);

        }
    }

    private function createApproval($leave, $approverId, $type, $department_id)
    {
        LeaveApproval::create([
            'leave_id' => $leave->id,
            'approver_id' => $approverId,
            'approval_stage' => '',
            'type' => $type,
            'department_id' => $department_id,
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
        $leaves = Leave::where('employee_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        $leaveTypes = LeaveType::all();
        $staffs = User::where('type','!=','contractor')->where('department_id',Auth::user()->department->id)->get();
        return view('livewire.leave.leaves-component',[
            'relievingStaffs' => User::all(),
            'departments' => Department::all(),
        ],
        compact('leaves','leaveTypes','staffs'));
    }
}
