<?php

namespace App\Http\Livewire\DG;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\ProjectCreation;
use App\Models\Utility;
use App\Models\ProjectTask;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use App\Models\ActivityLog;
use App\Models\ProjectAdvert;
use App\Models\ProjectCategory;
use App\Models\ProjectUser;
use Livewire\WithFileUploads;

class DgProjectDetailsComponent extends Component
{
    use WithFileUploads;

    // public $project_id;
    public $project_name;
    public $project_number;
    public $description;
    public $start_date;
    public $end_date;
    public $project_category_id;
    public $supervising_staff_id;
    public $selectedStaff = [];
    public $status;
    public $totalSum;
    public $project_id;
    public $selProject;
    public $setActionId;

    public $selProject2;
    public $ad_start_date;
    public $ad_end_date;
    public $ad_description;
    public $type_of_project;
    public $type_of_advert;

    // public $project;

    public function mount($id){

        // $this->project = $project;

        $this->project_id = $id;

        $this->selProject = ProjectCreation::find($id);
        $this->project_name = $this->selProject->project_name;
        $this->project_number = $this->selProject->projectId;
        $this->description = $this->selProject->description;
        $this->start_date = $this->selProject->start_date;
        $this->end_date = $this->selProject->end_date;
        $this->project_category_id = $this->selProject->project_category_id;
        $this->selectedStaff = $this->selProject->users->pluck('id')->toArray();
    }

    public function setApplicant(ProjectCreation $project){
        $this->selApplicant = $project;
    }

    public function approve($project_id){
        $project = ProjectCreation::find($project_id);
        if($project->advert_approval_status=='on_review'){
            $this->dispatchBrowserEvent('error',['error' => 'This project has already been approved for advert']);
        }else{
            $project->update([
                'advert_approval_status' => true,
           ]);
           $this->dispatchBrowserEvent('success',["success" =>"Project approved for advert successfully."]);
        }
    }


    // public function approve($project_id)
    // {
    //     $project = ProjectCreation::find($project_id);
    //     $project->update([
    //           'advert_approval_status' => true,
    //      ]);
    //     $this->dispatchBrowserEvent('success',["success" =>"Project approved for advert successfully."]);

        
    // }

    public function getProjectDetails($project){
        $usr           = Auth::user();
        if($project)
            {
                $project_data = [];
                // Task Count
                $tasks = ProjectTask::where('project_id',$project->id)->get();
                $project_task         = $tasks->count();
                $completedTask = ProjectTask::where('project_id',$project->id)->where('is_complete',1)->get();

                $project_done_task    = $completedTask->count();

                $project_data['task'] = [
                    'total' => number_format($project_task),
                    'done' => number_format($project_done_task),
                    'percentage' => Utility::getPercentage($project_done_task, $project_task),
                ];

                // end Task Count

                // Expense
                $expAmt = 0;
                foreach($project->expense as $expense)
                {
                    $expAmt += $expense->amount;
                }

                $project_data['expense'] = [
                    'allocated' => $project->budget,
                    'total' => $expAmt,
                    'percentage' => Utility::getPercentage($expAmt, $project->budget),
                ];
                // end expense


                // Users Assigned
                $total_users = User::where('created_by', '=', $usr->id)->count();


                $project_data['user_assigned'] = [
                    'total' => number_format($total_users) . '/' . number_format($total_users),
                    'percentage' => Utility::getPercentage($total_users, $total_users),
                ];
                // end users assigned

                // Day left
                $total_day                = Carbon::parse($project->start_date)->diffInDays(Carbon::parse($project->end_date));
                $remaining_day            = Carbon::parse($project->start_date)->diffInDays(now());
                $project_data['day_left'] = [
                    'day' => number_format($remaining_day) . '/' . number_format($total_day),
                    'percentage' => Utility::getPercentage($remaining_day, $total_day),
                ];
                // end Day left

                // Open Task
                    $remaining_task = ProjectTask::where('project_id', '=', $project->id)->where('is_complete', '=', 0)->where('created_by',\Auth::user()->creatorId())->count();
                    $total_task     = $project->tasks->count();

                $project_data['open_task'] = [
                    'tasks' => number_format($remaining_task) . '/' . number_format($total_task),
                    'percentage' => Utility::getPercentage($remaining_task, $total_task),
                ];
                // end open task

                // Milestone
                $total_milestone           = $project->milestones()->count();
                $complete_milestone        = $project->milestones()->where('status', 'LIKE', 'complete')->count();
                $project_data['milestone'] = [
                    'total' => number_format($complete_milestone) . '/' . number_format($total_milestone),
                    'percentage' => Utility::getPercentage($complete_milestone, $total_milestone),
                ];
                // End Milestone

                // Time spent

                    $times = $project->timesheets()->where('created_by', '=', $usr->id)->pluck('time')->toArray();
                $totaltime                  = str_replace(':', '.', Utility::timeToHr($times));
                $project_data['time_spent'] = [
                    'total' => number_format($totaltime) . '/' . number_format($totaltime),
                    'percentage' => Utility::getPercentage(number_format($totaltime), $totaltime),
                ];
                // end time spent

                // Allocated Hours
                $hrs = ProjectCreation::projectHrs($project->id);
                $project_data['task_allocated_hrs'] = [
                    'hrs' => number_format($hrs['allocated']) . '/' . number_format($hrs['allocated']),
                    'percentage' => Utility::getPercentage($hrs['allocated'], $hrs['allocated']),
                ];
                // end allocated hours

                // Chart
                $seven_days      = Utility::getLastSevenDays();
                $chart_task      = [];
                $chart_timesheet = [];
                $cnt             = 0;
                $cnt1            = 0;

                foreach(array_keys($seven_days) as $k => $date)
                {
                        $task_cnt     = $project->tasks()->where('is_complete', '=', 1)->whereRaw("find_in_set('" . $usr->id . "',assign_to)")->where('marked_at', 'LIKE', $date)->count();
                        $arrTimesheet = $project->timesheets()->where('created_by', '=', $usr->id)->where('date', 'LIKE', $date)->pluck('time')->toArray();

                    // Task Chart Count
                    $cnt += $task_cnt;

                    // Timesheet Chart Count
                    $timesheet_cnt = str_replace(':', '.', Utility::timeToHr($arrTimesheet));
                    $cn[]          = $timesheet_cnt;
                    $cnt1          += $timesheet_cnt;

                    $chart_task[]      = $task_cnt;
                    $chart_timesheet[] = $timesheet_cnt;
                }

                $project_data['task_chart']      = [
                    'chart' => $chart_task,
                    'total' => $cnt,
                ];
                $project_data['timesheet_chart'] = [
                    'chart' => $chart_timesheet,
                    'total' => $cnt1,
                ];

                return $project_data;
                // end chart
            }
    }

    public function render()
    {
        $project = ProjectCreation::find($this->project_id);
        $project_data =  $this->getProjectDetails($project);
        $categories = ProjectCategory::all();
        $users = User::all();
        return view('livewire.d-g.dg-project-details-component',compact('project','project_data','categories','users'));
    }
}
