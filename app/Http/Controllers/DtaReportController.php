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
        if (\Auth::user()->can('manage report')) {
            $user = \Auth::user();

            // Super admin can select any department, while directors are restricted to their own department
            if ($user->type === 'super admin') {
                $departments = Department::all()->pluck('name', 'id');
            } else {
                $departments = Department::where('id', $user->department_id)->pluck('name', 'id');
            }
            $departments->prepend('Select Department', '');

            // Default Filters
            $filterYear['department']    = __('All');
            $filterYear['type']          = __('Monthly');
            $filterYear['dateYearRange'] = date('M-Y');

            // Employee Query (Super Admin sees all, Directors see only their department)
            $employees = User::where('type', '!=', 'contractor');

            if ($user->type !== 'super admin') {
                $employees->where('department_id', $user->department_id); // Restrict directors to their department
            }

            // Apply department filter (Only for Super Admin)
            if (!empty($request->department) && $user->type === 'super admin') {
                $employees->where('department_id', $request->department);
                $filterYear['department'] = Department::find($request->department)?->name ?? '';
            } elseif ($user->type !== 'super admin') {
                $filterYear['department'] = Department::find($user->department_id)?->name ?? '';
            }

            $employees = $employees->get();

            $dtas          = [];
            $totalApproved = $totalReject = $totalPending = 0;

            foreach ($employees as $employee) {
                $employeeLeave['id']          = $employee->id;
                $employeeLeave['employee_id'] = $employee->employee_id;
                $employeeLeave['employee']    = $employee->name;

                // Leave Status Queries
                $approved = Dta::where('user_id', $employee->id)->where('status', 'Approved');
                $rejected = Dta::where('user_id', $employee->id)->where('status', 'Rejected');
                $pending  = Dta::where('user_id', $employee->id)->where('status', 'Pending');

                // Monthly Filter
                if ($request->type == 'monthly' && !empty($request->month)) {
                    $month = date('m', strtotime($request->month));
                    $year  = date('Y', strtotime($request->month));

                    $approved->whereMonth('created_at', $month)->whereYear('created_at', $year);
                    $rejected->whereMonth('created_at', $month)->whereYear('created_at', $year);
                    $pending->whereMonth('created_at', $month)->whereYear('created_at', $year);

                    $filterYear['dateYearRange'] = date('M-Y', strtotime($request->month));
                    $filterYear['type'] = __('Monthly');
                } elseif (!isset($request->type)) {
                    $month = date('m');
                    $year  = date('Y');
                    $approved->whereMonth('created_at', $month)->whereYear('created_at', $year);
                    $rejected->whereMonth('created_at', $month)->whereYear('created_at', $year);
                    $pending->whereMonth('created_at', $month)->whereYear('created_at', $year);

                    $filterYear['dateYearRange'] = date('M-Y');
                    $filterYear['type']          = __('Monthly');
                }

                // Yearly Filter
                if ($request->type == 'yearly' && !empty($request->year)) {
                    $approved->whereYear('created_at', $request->year);
                    $rejected->whereYear('created_at', $request->year);
                    $pending->whereYear('created_at', $request->year);

                    $filterYear['dateYearRange'] = $request->year;
                    $filterYear['type']          = __('Yearly');
                }

                // Count Records
                $employeeLeave['approved'] = $approved->count();
                $employeeLeave['rejected'] = $rejected->count();
                $employeeLeave['pending']  = $pending->count();

                $totalApproved += $employeeLeave['approved'];
                $totalReject   += $employeeLeave['rejected'];
                $totalPending  += $employeeLeave['pending'];

                $dtas[] = $employeeLeave;
            }

            // Year Range for Selection
            $filterYear['starting_year'] = date('Y', strtotime('-5 year'));
            $filterYear['ending_year']   = date('Y', strtotime('+5 year'));

            $filter['totalApproved'] = $totalApproved;
            $filter['totalReject']   = $totalReject;
            $filter['totalPending']  = $totalPending;

            return view('dta.reports', compact('departments', 'dtas', 'filterYear', 'filter'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }



    public function employeeDta(Request $request, $employee_id, $status, $type, $month, $year)
    {
        if(\Auth::user()->can('manage report'))
        {
            $leaveTypes = Dta::where('user_id', $employee_id)->get();
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
