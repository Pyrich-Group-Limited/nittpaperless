<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\CustomQuestion;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Document;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\GenerateOfferLetter;
use App\Models\InterviewSchedule;
use App\Models\Jobber;
use App\Models\PayslipType;
use Auth;
use App\Models\JobberApplication;
use App\Models\JobberApplicationNote;
use App\Models\JobberOnBoard;
use App\Models\JobberStage;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class JobberApplicationController extends Controller
{

    public function index(Request $request)
    {

        if(\Auth::user()->can('manage Jobberber application'))
        {
            $stages = JobberStage::where('created_by', '=', \Auth::user()->creatorId())->orderBy('order', 'asc')->get();

            $jobbers = Jobber::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
            $jobbers->prepend('All', '');

            if(isset($request->start_date) && !empty($request->start_date))
            {
                $filter['start_date'] = $request->start_date;
            }
            else
            {
                $filter['start_date'] = date("Y-m-d", strtotime("-1 month"));
            }

            if(isset($request->end_date) && !empty($request->end_date))
            {
                $filter['end_date'] = $request->end_date;
            }
            else
            {
                $filter['end_date'] = date("Y-m-d H:i:s", strtotime("+1 hours"));
            }

            if(isset($request->jobber) && !empty($request->jobber))
            {
                $filter['jobber'] = $request->jobber;
            }
            else
            {
                $filter['jobber'] = '';
            }


            return view('jobberApplication.index', compact('stages', 'jobbers', 'filter'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        $jobbers = Jobber::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
        $jobbers->prepend('--', '');

        $questions = CustomQuestion::where('created_by', \Auth::user()->creatorId())->get();

        return view('jobberApplication.create', compact('jobbers', 'questions'));
    }

    public function store(Request $request)
    {

        if(\Auth::user()->can('create job application'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'jobber' => 'required',
                                   'name' => 'required',
                                   'email' => 'required',
                                   'phone' => 'required',

                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            if(!empty($request->profile))
            {

                $filenameWithExt = $request->file('profile')->getClientOriginalName();
                $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension       = $request->file('profile')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                $dir        = 'uploads/jobber/profile';

                $image_path = $dir . $filenameWithExt;
                if (\File::exists($image_path)) {
                    \File::delete($image_path);
                }
                $url = '';
                $path = Utility::upload_file($request,'profile',$fileNameToStore,$dir,[]);
                if($path['flag'] == 1){
                    $url = $path['url'];
                }else{
                    return redirect()->back()->with('error', __($path['msg']));
                }
            }


            if(!empty($request->resume))
            {

                $filenameWithExt1 = $request->file('resume')->getClientOriginalName();
                $filename1        = pathinfo($filenameWithExt1, PATHINFO_FILENAME);
                $extension1       = $request->file('resume')->getClientOriginalExtension();
                $fileNameToStore1 = $filename1 . '_' . time() . '.' . $extension1;

                $dir        = 'uploads/jobber/resume';

                $image_path = $dir . $filenameWithExt1;
                if (\File::exists($image_path)) {
                    \File::delete($image_path);
                }
                $url = '';
                $path = Utility::upload_file($request,'resume',$fileNameToStore1,$dir,[]);

                if($path['flag'] == 1){
                    $url = $path['url'];
                }else{
                    return redirect()->back()->with('error', __($path['msg']));
                }
            }
            $stages = JobberStage::where('created_by',\Auth::user()->creatorId())->first();

            $jobber                  = new jobberApplication();
            $jobber->jobber             = $request->jobber;
            $jobber->name            = $request->name;
            $jobber->email           = $request->email;
            $jobber->phone           = $request->phone;
            $jobber->profile         = !empty($request->profile) ? $fileNameToStore : '';
            $jobber->resume          = !empty($request->resume) ? $fileNameToStore1 : '';
            $jobber->cover_letter    = $request->cover_letter;
            $jobber->dob             = $request->dob;
            $jobber->gender          = $request->gender;
            $jobber->country         = $request->country;
            $jobber->state           = $request->state;
            $jobber->city            = $request->city;
            $jobber->stage           = !empty($stages)?$stages->id:1;
            $jobber->custom_question = json_encode($request->question);
            $jobber->created_by      = \Auth::user()->creatorId();
            $jobber->save();

            return redirect()->route('job-application.index')->with('success', __('Jobberberber application successfully created.'));
        }
        else
        {
            return redirect()->route('job-application.index')->with('error', __('Permission denied.'));
        }
    }

    public function show($ids)
    {

        if(\Auth::user()->can('show job application'))
        {
            $id             = Crypt::decrypt($ids);
            $jobApplication = JobberApplication::find($id);

            $notes = JobberApplicationNote::where('application_id', $id)->get();

            $stages = JobberStage::where('created_by', \Auth::user()->creatorId())->get();

            return view('jobberApplication.show', compact('jobberApplication', 'notes', 'stages'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(JobberApplication $jobApplication)
    {
        if(\Auth::user()->can('delete job application'))
        {
            $jobApplication->delete();
            return redirect()->route('job-application.index')->with('success', __('Jobberberber application successfully deleted.'));
        }
        else
        {
            return redirect()->route('job-application.index')->with('error', __('Permission denied.'));
        }

    }

    public function order(Request $request)
    {
        if(\Auth::user()->can('move job application'))
        {
            $post = $request->all();
            foreach($post['order'] as $key => $item)
            {
                $application        = JobberApplication::where('id', '=', $item)->first();
                $application->order = $key;
                $application->stage = $post['stage_id'];
                $application->save();
            }
        }
        else
        {
            return redirect()->route('job-application.index')->with('error', __('Permission denied.'));
        }

    }

    public function addSkill(Request $request, $id)
    {
        if(\Auth::user()->can('add job application skill'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'skill' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $job        = JobberApplication::find($id);
            $job->skill = $request->skill;
            $job->save();

            return redirect()->back()->with('success', __('Jobber application skill successfully added.'));
        }
        else
        {
            return redirect()->route('jobber-application.index')->with('error', __('Permission denied.'));
        }


    }

    public function addNote(Request $request, $id)
    {
        if(\Auth::user()->can('add job application note'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'note' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $note                 = new JobberApplicationNote();
            $note->application_id = $id;
            $note->note           = $request->note;
            $note->note_created   = \Auth::user()->id;
            $note->created_by     = \Auth::user()->creatorId();
            $note->save();

            return redirect()->back()->with('success', __('Jobber application notes successfully added.'));
        }
        else
        {
            return redirect()->route('jobber-application.index')->with('error', __('Permission denied.'));
        }


    }

    public function destroyNote($id)
    {
        if(\Auth::user()->can('delete job application note'))
        {
            $note = JobberApplicationNote::find($id);
            $note->delete();

            return redirect()->back()->with('success', __('Jobber application notes successfully deleted.'));
        }
        else
        {
            return redirect()->route('jobber-application.index')->with('error', __('Permission denied.'));
        }


    }

    public function rating(Request $request, $id)
    {
        $jobberApplication         = JobberApplication::find($id);
        $jobberApplication->rating = $request->rating;
        $jobberApplication->save();
    }

    public function archive($id)
    {
        $jobberApplication = JobberApplication::find($id);
        if($jobberApplication->is_archive == 0)
        {
            $jobberApplication->is_archive = 1;
            $jobberApplication->save();

            return redirect()->route('jobber.application.candidate')->with('success', __('Jobber application successfully added to archive.'));
        }
        else
        {
            $jobberApplication->is_archive = 0;
            $jobberApplication->save();

            return redirect()->route('jobber-application.index')->with('success', __('Jobberberber application successfully remove to archive.'));
        }

    }

    public function candidate()
    {
        if(\Auth::user()->can('manage job onBoard'))
        {
            $archive_application = JobberApplication::where('created_by', \Auth::user()->creatorId())->where('is_archive', 1)->get();

            return view('jobberApplication.candidate', compact('archive_application'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    //    -----------------------Jobber OnBoard-----------------------------_

    public function jobberBoardCreate($id)
    {
        $status       = JobberOnBoard::$status;
        $job_type        = JobberOnBoard::$job_type;
        $salary_duration = JobberOnBoard::$salary_duration;
        $salary_type     = PayslipType::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $applications = InterviewSchedule::select('interview_schedules.*', 'job_applications.name')->join('job_applications', 'interview_schedules.candidate', '=', 'job_applications.id')->where('interview_schedules.created_by', \Auth::user()->creatorId())->get()->pluck('name', 'candidate');
        $applications->prepend('-', '');

        return view('jobberApplication.onboardCreate', compact('id', 'status', 'applications','job_type','salary_type','salary_duration'));
    }

    public function jobberOnBoard()
    {
        if(\Auth::user()->can('manage jobber onBoard'))
        {
            $jobOnBoards = JobberOnBoard::where('created_by', \Auth::user()->creatorId())->get();

            return view('jobberApplication.onboard', compact('jobberOnBoards'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function jobBoardStore(Request $request, $id)
    {
        $validator = \Validator::make(
            $request->all(), [
                                'joining_date' => 'required',
                                'job_type' => 'required',
                                'days_of_week'=>'required|gt:0',
                                'salary'=>'required|gt:0',
                                'salary_type'=>'required',
                                'salary_duration'=>'required',
                                'status' => 'required',
                           ]
        );

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $id = ($id == 0) ? $request->application : $id;

        $jobBoard               = new JobberOnBoard();
        $jobBoard->application  = $id;
        $jobBoard->joining_date         = $request->joining_date;
        $jobBoard->job_type              = $request->job_type;
        $jobBoard->days_of_week          =$request->days_of_week;
        $jobBoard->salary                =$request->salary;
        $jobBoard->salary_type           =$request->salary_type;
        $jobBoard->salary_duration       =$request->salary_duration;
        $jobBoard->status                = $request->status;
        $jobBoard->created_by   = \Auth::user()->creatorId();
        $jobBoard->save();

        $interview = InterviewSchedule::where('candidate', $id)->first();
        if(!empty($interview))
        {
            $interview->delete();
        }

        return redirect()->route('job.on.board')->with('success', __('Candidate succefully added in job board.'));
    }

    public function jobBoardUpdate(Request $request, $id)
    {
        $validator = \Validator::make(
            $request->all(), [
                                'joining_date' => 'required',
                                'job_type' => 'required',
                                'days_of_week'=>'required',
                                'salary'=>'required',
                                'salary_type'=>'required',
                                'salary_duration'=>'required',
                                'status' => 'required',
                           ]
        );

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $jobberBoard                        = JobberOnBoard::find($id);
        $jobberBoard->joining_date          = $request->joining_date;
        $jobberBoard->job_type              = $request->job_type;
        $jobberBoard->days_of_week          =$request->days_of_week;
        $jobberBoard->salary                =$request->salary;
        $jobberBoard->salary_type           =$request->salary_type;
        $jobberBoard->salary_duration     =$request->salary_duration;
        $jobberBoard->status                = $request->status;
        $jobberBoard->save();

        return redirect()->route('job.on.board')->with('success', __('Jobberberber board Candidate succefully updated.'));
    }

    public function jobBoardEdit($id)
    {
        $jobberOnBoard = JobberOnBoard::find($id);
        $status     = JobberOnBoard::$status;
        $job_type       = JobberOnBoard::$job_type;
        $salary_duration = JobberOnBoard::$salary_duration;
        $salary_type      = PayslipType::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');


        return view('jobberApplication.onboardEdit', compact('jobberOnBoard', 'status','job_type','salary_type','salary_duration'));
    }

    public function jobberBoardDelete($id)
    {

        $jobBoard = JobberOnBoard::find($id);
        $jobBoard->delete();

        return redirect()->route('jobber.on.board')->with('success', __('Jobberberber onBoard successfully deleted.'));
    }

    public function jobBoardConvert($id)
    {
        $jobberOnBoard       = JobberOnBoard::find($id);
        $company_settings = Utility::settings();
        $documents        = Document::where('created_by', \Auth::user()->creatorId())->get();
        $branches         = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $departments      = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $designations     = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $employees        = User::where('created_by', \Auth::user()->creatorId())->get();
        $employeesId      = \Auth::user()->employeeIdFormat($this->employeeNumber());

        return view('jobApplication.convert', compact('jobberOnBoard', 'employees', 'employeesId', 'departments', 'designations', 'documents', 'branches', 'company_settings'));

    }

    public function jobBoardConvertData(Request $request, $id)
    {
        $validator = \Validator::make(
            $request->all(), [
                               'name' => 'required',
                               'dob' => 'required',
                               'gender' => 'required',
                               'phone' => 'required',
                               'address' => 'required',
                               'email' => 'required|unique:users',
                               'password' => 'required',
                               'department_id' => 'required',
                               'designation_id' => 'required',
//                               'document.*' => 'mimes:jpeg,png,jpg,gif,svg,pdf,doc,zip|max:20480',
                           ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->withInput()->with('error', $messages->first());
        }
        $objUser = \Auth::user();
        $employees        = User::where('type','!=','client')->where('type','!=','super admin')->where('created_by',\Auth::user()->creatorId())->get();

        $total_employee = $employees->count();
        $user = User::create(
            [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'type' => 'employee',
                'lang' => 'en',
                'created_by' => \Auth::user()->creatorId(),
            ]
        );
        $user->save();
        $user->assignRole('Employee');


        if(!empty($request->document) && !is_null($request->document))
        {
            $document_implode = implode(',', array_keys($request->document));
        }
        else
        {
            $document_implode = null;
        }


        $employee = Employee::create(
            [
                'user_id' => $user->id,
                'name' => $request['name'],
                'dob' => $request['dob'],
                'gender' => $request['gender'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'employee_id' => $this->employeeNumber(),
                'branch_id' => $request['branch_id'],
                'department_id' => $request['department_id'],
                'designation_id' => $request['designation_id'],
                'company_doj' => $request['company_doj'],
                'documents' => $document_implode,
                'account_holder_name' => $request['account_holder_name'],
                'account_number' => $request['account_number'],
                'bank_name' => $request['bank_name'],
                'bank_identifier_code' => $request['bank_identifier_code'],
                'branch_location' => $request['branch_location'],
                'tax_payer_id' => $request['tax_payer_id'],
                'created_by' => \Auth::user()->creatorId(),
            ]
        );

        if(!empty($employee))
        {
            $JobberOnBoard                      = JobberOnBoard::find($id);
            $JobberOnBoard->convert_to_employee = $employee->id;
            $JobberOnBoard->save();
        }
        if($request->hasFile('document'))
        {
            foreach($request->document as $key => $document)
            {

                $filenameWithExt = $request->file('document')[$key]->getClientOriginalName();
                $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension       = $request->file('document')[$key]->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $dir             = storage_path('uploads/document/');
                $image_path      = $dir . $filenameWithExt;

                if(\File::exists($image_path))
                {
                    \File::delete($image_path);
                }

                if(!file_exists($dir))
                {
                    mkdir($dir, 0777, true);
                }
                $path              = $request->file('document')[$key]->storeAs('uploads/document/', $fileNameToStore);
                $employee_document = EmployeeDocument::create(
                    [
                        'employee_id' => $employee['employee_id'],
                        'document_id' => $key,
                        'document_value' => $fileNameToStore,
                        'created_by' => \Auth::user()->creatorId(),
                    ]
                );
                $employee_document->save();

            }

        }
        $setings = Utility::settings();

        if($setings['new_user'] == 1)
        {
            $userArr = [
                'email' => $user->email,
                'password' => $user->password,
            ];

            $resp = Utility::sendEmailTemplate('new_user', [$user->id => $user->email], $userArr);

            return redirect()->back()->with('success', __('Application successfully converted to employee.') .((!empty($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));

        }

        return redirect()->back()->with('success', __('Application successfully converted to employee.'));
    }

    function employeeNumber()
    {
        $latest = Employee::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->employee_id + 1;
    }

    public function getByJobber(Request $request)
    {
        $job                  = Jobber::find($request->id);
        $job->applicant       = !empty($job->applicant) ? explode(',', $job->applicant) : '';
        $job->visibility      = !empty($job->visibility) ? explode(',', $job->visibility) : '';
        $job->custom_question = !empty($job->custom_question) ? explode(',', $job->custom_question) : '';


        return json_encode($job);
    }

    public function stageChange(Request $request)
    {
        $application        = JobberApplication::where('id', '=', $request->schedule_id)->first();
        $application->stage = $request->stage;
        $application->save();


        return response()->json(
            [
                'success' => __('This candidate stage successfully changed.'),
            ], 200
        );

    }
    public function offerletterPdf($id)
    {
        $users = \Auth::user();
        $currantLang = $users->currentLanguage();
        // $Offerletter=GenerateOfferLetter::where('lang', $currantLang)->first();
        $Offerletter=GenerateOfferLetter::where(['lang' =>   $currantLang,'created_by' =>  \Auth::user()->creatorId()])->first();

        $job = JobberApplication::find($id);
        $Onboard=JobberOnBoard::find($id);
        $name=JobberApplication::find($Onboard->application);
        $job_title=jobber::find($name->job);
        // dd($job);
        $salary=PayslipType::find($Onboard->salary_type);


        //  dd($salary->name);
        $obj = [
            'applicant_name' => $name->name,
            'app_name' => env('APP_NAME'),
            'job_title' => $job_title->title,
            'job_type' =>!empty($Onboard->job_type)?$Onboard->job_type:'' ,
            'start_date' => $Onboard->joining_date,
            'workplace_location' => !empty($job->jobs->branches->name)?$job->jobs->branches->name:'',
            'days_of_week' => !empty($Onboard->days_of_week)?$Onboard->days_of_week:'',
            'salary' => !empty($Onboard->salary)?$Onboard->salary:'',
            'salary_type' => !empty($salary->name)?$salary->name:'',
            'salary_duration' => !empty($Onboard->salary_duration)?$Onboard->salary_duration:'',
            'offer_expiration_date' => !empty($Onboard->joining_date)?$Onboard->joining_date:'',

        ];
        $Offerletter->content = GenerateOfferLetter::replaceVariable($Offerletter->content, $obj);
        return view('jobApplication.template.offerletterpdf', compact('Offerletter','name'));

    }
    public function offerletterDoc($id)
    {
        $users = \Auth::user();
        $currantLang = $users->currentLanguage();
        $Offerletter=GenerateOfferLetter::where(['lang' =>   $currantLang,'created_by' =>  \Auth::user()->creatorId()])->first();
        // ['lang' =>   $currantLang,'created_by' =>  \Auth::user()->id]
        $job = JobberApplication::find($id);
        $Onboard=JobberOnBoard::find($id);
        $name=JobberApplication::find($Onboard->application);
        $job_title=jobber::find($name->job);
        // dd($job_title->title);
        $salary=PayslipType::find($Onboard->salary_type);
        // dd($Offerletter);


        //  dd($salary->name);
        $obj = [
            'applicant_name' => $name->name,
            'app_name' => env('APP_NAME'),
            'job_title' => $job_title->title,
            'job_type' =>!empty($Onboard->job_type)?$Onboard->job_type:'' ,
            'start_date' => $Onboard->joining_date,
            'workplace_location' => !empty($job->jobs->branches->name)?$job->jobs->branches->name:'',
            'days_of_week' => !empty($Onboard->days_of_week)?$Onboard->days_of_week:'',
            'salary' => !empty($Onboard->salary)?$Onboard->salary:'',
            'salary_type' => !empty($salary->name)?$salary->name:'',
            'salary_duration' => !empty($Onboard->salary_duration)?$Onboard->salary_duration:'',
            'offer_expiration_date' => !empty($Onboard->joining_date)?$Onboard->joining_date:'',

        ];
        $Offerletter->content = GenerateOfferLetter::replaceVariable($Offerletter->content, $obj);
        return view('jobApplication.template.offerletterdocx', compact('Offerletter','name'));

    }
}

