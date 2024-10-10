<?php

namespace App\Http\Controllers;

use App\Models\JobberCategory;
use Illuminate\Http\Request;

class JobberCategoryController extends Controller
{

    public function index()
    {
        if(\Auth::user()->can('manage Jobber category'))
        {
            $categories = JobCategory::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('jobberCategory.index', compact('categories'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        return view('jobberCategory.create');
    }


    public function store(Request $request)
    {
        if(\Auth::user()->can('create jobber category'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'title' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $jobberCategory             = new jobberCategory();
            $jobberCategory->title      = $request->title;
            $jobberCategory->created_by = \Auth::user()->creatorId();
            $jobberCategory->save();

            return redirect()->back()->with('success', __('jobber category  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(jobberCategory $jobberCategory)
    {
        //
    }


    public function edit(jobberCategory $jobberCategory)
    {
        return view('jobberCategory.edit', compact('jobberCategory'));
    }


    public function update(Request $request, jobberCategory $jobberCategory)
    {
        if(\Auth::user()->can('edit jobber category'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'title' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $jobberCategory->title = $request->title;
            $jobberCategory->save();

            return redirect()->back()->with('success', __('jobber category  successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(jobberCategory $jobberCategory)
    {
        if(\Auth::user()->can('delete jobber category'))
        {
            if($jobberCategory->created_by == \Auth::user()->creatorId())
            {
                $jobberCategory->delete();

                return redirect()->back()->with('success', __('jobber category successfully deleted.'));
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
}
