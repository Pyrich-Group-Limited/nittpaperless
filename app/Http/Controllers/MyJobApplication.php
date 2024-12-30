<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InterviewSchedule;
use App\Models\Job;
use App\Models\PayslipType;
use Auth;
use App\Models\JobApplication;
use App\Models\JobApplicationNote;
use App\Models\JobOnBoard;
use App\Models\JobStage;

class MyJobApplication extends Controller
{
    public function index(){

        $myjobs = JobApplication::where('applicant_id', '=', auth()->user()->id)->get();
        return  view('myApplication.index',compact('myjobs'));
    }


    // public function applicationStages($jobApplicationId)
    // {
    //     // Get the specific job application the user clicked on
    //     $jobApplication = JobApplication::findOrFail($jobApplicationId);

    //     // Get the job stages created by the user
    //     $stages = JobStage::where('created_by', '=', \Auth::user()->creatorId())
    //                     ->orderBy('order', 'asc')
    //                     ->get();

    //     // Get job titles (used for filtering or categorization)
    //     $jobs = Job::where('created_by', \Auth::user()->creatorId())
    //             ->get()
    //             ->pluck('title', 'id');
    //     $jobs->prepend('All', '');

    //     return view('myApplication.stage', compact('stages', 'jobs', 'jobApplication'));
    // }


    public function applicationStages($jobApplicationId)
    {
        $jobApplication = JobApplication::findOrFail($jobApplicationId);

        // Fetch stages created by the current user
        $stages = JobStage::where('created_by', '=', \Auth::user()->creatorId())
                        ->orderBy('order', 'asc')
                        ->get();

        // Group job applications by their current stage
        $applicationsByStage = JobApplication::where('applicant_id', auth()->id())
            ->where('job', $jobApplication->job) // Filter by specific job
            ->get()
            ->groupBy('stage'); // Ensure stage_id exists in the JobApplication table

        return view('myApplication.stage', compact('stages', 'jobApplication', 'applicationsByStage'));
    }
}
