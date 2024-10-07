<?php

namespace App\Http\Controllers\DashControls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;

class HrmDashControl extends Controller
{
    public function budget(Request $request)
    {
        return view('hrm.budget');
    }

    public function hrmQuery(Request $request)
    {
        return view('hrm.query');
    }

    public function hrmLeave(Request $request)
    {
        if(Auth::user()->can('manage leave')){
            $leaves = Leave::all();
        }else{
            $leaves = Leave::where('employee_id',Auth::user()->id)->get();
        }
        $leaveTypes = LeaveType::all();
        return view('hrm.leave',compact('leaves','leaveTypes'));
    }
    public function hrmDta(Request $request)
    {
        return view('hrm.dta');
    }
    public function hrmMemo(Request $request)
    {
        return view('hrm.memo');
    }

    public function applyLeave(Request $request)
    {
        return view('hrm.modals.apply-leave');
    }


    public function applyLeavePost(Request $request){

        $data =  $request->validate([
            'type_of_leave' => ['required','string'],
            'start_date' => ['required','string'],
            'end_date' => ['required','string'],
            'reason' => ['required','string'],
        ]);

        $leaeType = LeaveType::find($data['type_of_leave']);
        $myLeave = Leave::where('employee_id',Auth::user()->id)->where('status','Pending')->first();
        $leaveDuration = round(strtotime($data['end_date']) - strtotime($data['start_date']))/ 86400;

        if($myLeave!=null){
            return back()->with('error','Sorry you already have a pending leave application');
        }elseif(strtotime($data['start_date'])<strtotime(date('Y-m-d'))){
            return back()->with('error','Sorry your start date can not be later than today')->withInput();
        }elseif($leaveDuration<=0){
            return back()->with('error','Sorry your start date can not be later than start')->withInput();
        }elseif($leaveDuration>$leaeType->days){
            return back()->with('error','Sorry you can not apply for more than '.$leaveType->days. ' for '.$leaveType->name)->withInput();

        }else{
            Leave::create([
                'employee_id' => Auth::user()->id,
                'department_id' => Auth::user()->department->id,
                'unit_id' => Auth::user()->unit->id,
                'created_by' => Auth::user()->id,
                'leave_type_id' => $data['type_of_leave'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'leave_reason' => $data['reason'],
                'status' => "Pending",
                'total_leave_days' => $leaveDuration,
            ]);

            return back()->with('success','Leave Application Successful');
        }

    }
    public function applyQuery(Request $request)
    {
        return view('hrm.modals.apply-query');
    }

    public function applyDta(Request $request)
    {
        return view('hrm.modals.apply-dta');
    }
}
