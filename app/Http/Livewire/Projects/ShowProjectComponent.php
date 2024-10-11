<?php

namespace App\Http\Livewire\Projects;

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

class ShowProjectComponent extends Component
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

    public function mount($id){
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


    public function setActionId($id){
        $this->setActionId = $id;
    }

    public function selProject($id){
        $this->selProject = ProjectCreation::find($id);
        // $this->selectedStaff = $this->selProject->users()->pluck('id')->toArray();

    }




    public function updateProject(){
        $this->validate([
            'project_name' => ['required'],
            'project_number' => ['required'],
            'description' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'project_category_id' => ['required'],
            'selectedStaff' => 'required|array|min:1',
            'selectedStaff.*' => 'exists:users,id',
        ]);

        // $project = ProjectCreation::find($this->project_id);
        $this->selProject->update([
            'project_name' => $this->project_name,
            'projectId' => $this->project_number,
            'projectId' => $this->project_number,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'project_category_id' => $this->project_category_id,
            'created_by' => Auth::user()->id
        ]);

        ProjectUser::where('project_id',$this->selProject->id)->delete();

        $this->selProject->users()->attach($this->selectedStaff);

        $this->dispatchBrowserEvent('success',["success" =>"Project Successfully Updated"]);
    }


    public function selProject2(ProjectCreation $project){
        $this->selProject = $project;
    }

    Public function advertiseProject(){
        $this->validate([
            'ad_start_date' => ['required','string'],
            'ad_end_date' => ['required','string'],
            'ad_description' => ['required','string'],
            'type_of_advert' => ['required','string'],
        ]);

        $project = ProjectAdvert::find($this->selProject->id);

        $projectDuration = round(strtotime($this->ad_end_date) - strtotime($this->ad_start_date))/ 86400;

        if($project!=null){
            $this->dispatchBrowserEvent('error',['error' => 'Sorry this project has already been advertised for applications']);
        }elseif(strtotime($this->ad_end_date)<strtotime(date('Y-m-d'))){
            $this->dispatchBrowserEvent('error',['error' => 'Sorry your start date can not be later than today']);
        }elseif($projectDuration<=0){
            $this->dispatchBrowserEvent('error',['error' => 'Sorry your start date can not be later than start']);
        }else{
            ProjectAdvert::create([
                'project_id' => $this->selProject->id,
                'start_date' => $this->ad_start_date,
                'end_date' => $this->ad_end_date,
                'description' => $this->ad_description,
                'advert_type' => $this->type_of_advert,
            ]);

            // $this->reset();
            $this->dispatchBrowserEvent('success',['success' => 'Project successfully Published']);
        }
    }
    public function setProject(ProjectCreation $project){
        $this->selProject2 = $project;
        $this->emit('project', $project);
    }


    public function inviteProjectUserMember(Request $request, $user_id)
    {
        $authuser = Auth::user();

        $userCheck = ProjectUser::find($user_id);

        if($userCheck!=null){
            $this->dispatchBrowserEvent('error',['error' => 'this user has already been added to this project']);
        }else{
            ProjectUser::create(
                [
                    'project_id' => $this->selProject->id,
                    'user_id' => $user_id,
                    'invited_by' => $authuser->id,
                ]
            );


        // Make entry in activity_log tbl
        ActivityLog::create(
            [
                'user_id' => $authuser->id,
                'project_id' => $this->selProject->id,
                'log_type' => 'Invite User',
                'remark' => json_encode(['title' => $authuser->name]),
            ]
        );

        $this->dispatchBrowserEvent('success',["success" =>"User invited successfully."]);
        }
    }

    public function render()
    {
        $project = ProjectCreation::find($this->project_id);
        // dd($project->project_name);
        $project_data =  $this->getProjectDetails($project);
        $categories = ProjectCategory::all();
        $users = User::all();
        return view('livewire.projects.show-project-component',compact('project','project_data','categories','users'));
    }
}
