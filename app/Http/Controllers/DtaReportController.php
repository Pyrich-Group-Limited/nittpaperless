<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dta;
use App\Models\DtaApproval;
use App\Models\DtaRejectionComment;
use App\Models\Branch;
use App\Models\Department;
use App\Models\User;
use App\Models\Employee;
use App\Models\Leave;

class DtaReportController extends Controller
{
    public function dta(Request $request)
    {

        if(\Auth::user()->can('manage report'))
        {

            // $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $branch = Branch::all()->pluck('name', 'id');
            $branch->prepend('Select Branch', '');

            // $department = Department::where('id', \Auth::user()->department_id)->get()->pluck('name', 'id');
            $department = Department::all()->pluck('name', 'id');
            $department->prepend('Select Department', '');

            $filterYear['branch']        = __('All');
            $filterYear['department']    = __('All');
            $filterYear['type']          = __('Monthly');
            $filterYear['dateYearRange'] = date('M-Y');
            $employees                   = User::all();
            // $employees                   = User::where('created_by', \Auth::user()->creatorId());
            if(!empty($request->branch))
            {
                $employees->where('branch_id', $request->branch);
                $filterYear['branch'] = !empty(Branch::find($request->branch)) ? Branch::find($request->branch)->name : '';
            }
            if(!empty($request->department))
            {
                $employees->where('department_id', $request->department);
                $filterYear['department'] = !empty(Department::find($request->department)) ? Department::find($request->department)->name : '';
            }


            // $employees = $employees->get();

            $dtas        = [];
            $totalApproved = $totalReject = $totalPending = 0;
            foreach($employees as $employee)
            {

                $employeeLeave['id']          = $employee->id;
                $employeeLeave['employee_id'] = $employee->employee_id;
                $employeeLeave['employee']    = $employee->name;

                $approved = Dta::where('user_id', $employee->id)->where('status', 'Approved');
                $rejected   = Dta::where('user_id', $employee->id)->where('status', 'Rejected');
                $pending  = Dta::where('user_id', $employee->id)->where('status', 'Pending');

                if($request->type == 'monthly' && !empty($request->month))
                {
                    $month = date('m', strtotime($request->month));
                    $year  = date('Y', strtotime($request->month));

                    $approved->whereMonth('created_at', $month)->whereYear('created_at', $year);
                    $rejected->whereMonth('created_at', $month)->whereYear('created_at', $year);
                    $pending->whereMonth('created_at', $month)->whereYear('created_at', $year);

                    $filterYear['dateYearRange'] = date('M-Y', strtotime($request->month));
                    $filterYear['type']          = __('Monthly');

                }
                elseif(!isset($request->type))
                {
                    $month     = date('m');
                    $year      = date('Y');
                    $monthYear = date('Y-m');

                    $approved->whereMonth('created_at', $month)->whereYear('created_at', $year);
                    $rejected->whereMonth('created_at', $month)->whereYear('created_at', $year);
                    $pending->whereMonth('created_at', $month)->whereYear('created_at', $year);

                    $filterYear['dateYearRange'] = date('M-Y', strtotime($monthYear));
                    $filterYear['type']          = __('Monthly');
                }


                if($request->type == 'yearly' && !empty($request->year))
                {
                    $approved->whereYear('created_at', $request->year);
                    $rejected->whereYear('created_at', $request->year);
                    $pending->whereYear('created_at', $request->year);


                    $filterYear['dateYearRange'] = $request->year;
                    $filterYear['type']          = __('Yearly');
                }

                $approved = $approved->count();
                $rejected   = $rejected->count();
                $pending  = $pending->count();

                $totalApproved += $approved;
                $totalReject   += $rejected;
                $totalPending  += $pending;

                $employeeLeave['approved'] = $approved;
                $employeeLeave['rejected']   = $rejected;
                $employeeLeave['pending']  = $pending;


                $dtas[] = $employeeLeave;
            }

            $starting_year = date('Y', strtotime('-5 year'));
            $ending_year   = date('Y', strtotime('+5 year'));

            $filterYear['starting_year'] = $starting_year;
            $filterYear['ending_year']   = $ending_year;

            $filter['totalApproved'] = $totalApproved;
            $filter['totalReject']   = $totalReject;
            $filter['totalPending']  = $totalPending;


            return view('dta.reports', compact('department', 'branch', 'dtas', 'filterYear', 'filter'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function employeeDta(Request $request, $employee_id, $status, $type, $month, $year)
    {
        if(\Auth::user()->can('manage report'))
        {
            // $leaveTypes = LeaveType::where('created_by', \Auth::user()->creatorId())->get();
            $leaveTypes = Dta::where('user_id', $employee_id)->get();
            // $leaveTypes = Dta::all();
            $dtas     = [];
            foreach($leaveTypes as $leaveType)
            {
                $leave        = new Dta();
                $leave->title = $leaveType->title;
                $totalLeave   = Dta::where('user_id', $employee_id)->where('status', $status);
                if($type == 'yearly')
                {
                    $totalLeave->whereYear('created_at', $year);
                }
                else
                {
                    $m = date('m', strtotime($month));
                    $y = date('Y', strtotime($month));

                    $totalLeave->whereMonth('created_at', $m)->whereYear('created_at', $y);
                }
                $totalLeave = $totalLeave->count();

                $leave->total = $totalLeave;
                $dtas[]     = $leave;
            }

            $dtaData = Dta::where('user_id', $employee_id)->where('status', $status);
            if($type == 'yearly')
            {
                $dtaData->whereYear('created_at', $year);
            }
            else
            {
                $m = date('m', strtotime($month));
                $y = date('Y', strtotime($month));

                $dtaData->whereMonth('created_at', $m)->whereYear('created_at', $y);
            }


            $dtaData = $dtaData->get();


            return view('dta.dtaShow', compact('dtas', 'dtaData'));
        }
        else
        {
            return redirect()->back()->with('error','Permission denied.');
        }


    }
}
