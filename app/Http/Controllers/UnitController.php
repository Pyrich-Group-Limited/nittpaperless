<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Unit;
use App\Models\Department;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        if(\Auth::user()->can('manage branch'))
        {
            $units = Unit::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('unit.index', compact('units'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('create department'))
        {
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $departments = Department::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('unit.create', compact('branch', 'departments'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(\Auth::user()->can('create branch'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $unit             = new Unit();
            $unit->branch_id  = $request->branch_id;
            $unit->department_id  = $request->department_id;
            $unit->name       = $request->name;
            $unit->created_by = \Auth::user()->creatorId();
            $unit->save();
           
            return redirect()->route('unit.index')->with('success', __('Unit  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Unit $unit)
    {
        return redirect()->route('unit.index');
    }

    public function edit(Unit $unit)
    {
        if(\Auth::user()->can('edit branch'))
        {
            if($unit->created_by == \Auth::user()->creatorId())
            {

                return view('unit.edit', compact('unit'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Unit $unit)
    {
        if(\Auth::user()->can('edit branch'))
        {
            if($unit->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $unit             = new Unit();
                $unit->branch_id  = $request->branch_id;
                $unit->department_id  = $request->department_id;
                $unit->name       = $request->name;
                // $unit->created_by = \Auth::user()->creatorId();
                $unit->save();

                // $unit->name = $request->name;
                // $unit->save();

                return redirect()->route('unit.index')->with('success', __('Branch successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(Unit $unit)
    {
        if(\Auth::user()->can('delete branch'))
        {
            if($unit->created_by == \Auth::user()->creatorId())
            {
                $unit->delete();

                return redirect()->route('unit.index')->with('success', __('Unit successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function getdepartment(Request $request)
    {

        if($request->branch_id == 0)
        {
            $departments = Department::get()->pluck('name', 'id')->toArray();
        }
        else
        {
            $departments = Department::where('branch_id', $request->branch_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($departments);
    }

    public function getemployee(Request $request)
    {
        if(in_array('0', $request->department_id))
        {
            $employees = Employee::get()->pluck('name', 'id')->toArray();
        }
        else
        {
            $employees = Employee::whereIn('department_id', $request->department_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($employees);
    }
}
