<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\CustomQuestion;
use App\Models\Job;
use App\Models\JobStage;
use App\Models\Utility;
use App\Models\JobApplication;
use App\Models\JobApplicationNote;
use App\Models\JobCategory;
use App\Models\User;
use App\Models\LiasonOffice;

class JobsAvailableController extends Controller
{
    public function index()
    {
        
            $jobs = Job::where('created_by', '=', \Auth::user()->creatorId())->get();

            $data['total']     = Job::where('created_by', '=', \Auth::user()->creatorId())->count();
            $data['active']    = Job::where('status', 'active')->where('created_by', '=', \Auth::user()->creatorId())->count();
            $data['in_active'] = Job::where('status', 'in_active')->where('created_by', '=', \Auth::user()->creatorId())->count();

            return view('jobsAvailable.index', compact('jobs', 'data'));
       
    }
}
