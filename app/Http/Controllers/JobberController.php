<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\CustomQuestion;
use App\Models\jobber;
use App\Models\jobberStage;
use App\Models\Utility;
use App\Models\jobberApplication;
use App\Models\jobberApplicationNote;
use App\Models\jobberCategory;
use App\Models\User;
use Illuminate\Http\Request;

class JobberController extends Controller
{

    public function index()
    {
        if(\Auth::user()->can('manage job'))
        {
            $jobbers = jobber::where('created_by', '=', \Auth::user()->creatorId())->get();

            $data['total']     = jobber::where('created_by', '=', \Auth::user()->creatorId())->count();
            $data['active']    = jobber::where('status', 'active')->where('created_by', '=', \Auth::user()->creatorId())->count();
            $data['in_active'] = jobber::where('status', 'in_active')->where('created_by', '=', \Auth::user()->creatorId())->count();

            return view('jobber.index', compact('jobbers', 'data'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {

        $categories = jobberCategory::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
        $categories->prepend('--', '');

        $branches = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $branches->prepend('All', 0);

        $status = jobber::$status;

        $customQuestion = CustomQuestion::where('created_by', \Auth::user()->creatorId())->get();

        return view('jobber.create', compact('categories', 'status', 'branches', 'customQuestion'));
    }

    public function store(Request $request)
    {

        if(\Auth::user()->can('create job'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'title' => 'required',
                                   'branch' => 'required',
                                   'category' => 'required',
                                   'skill' => 'required',
                                   'position' => 'required|integer',
                                   'start_date' => 'required',
                                   'end_date' => 'required',
                                   'description' => 'required',
                                   'requirement' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $jobber                  = new jobber();
            $jobber->title           = $request->title;
            $jobber->branch          = $request->branch;
            $jobber->category        = $request->category;
            $jobber->skill           = $request->skill;
            $jobber->position        = $request->position;
            $jobber->status          = $request->status;
            $jobber->start_date      = $request->start_date;
            $jobber->end_date        = $request->end_date;
            $jobber->description     = $request->description;
            $jobber->requirement     = $request->requirement;
            $jobber->code            = uniqid();
            $jobber->applicant       = !empty($request->applicant) ? implode(',', $request->applicant) : '';
            $jobber->visibility      = !empty($request->visibility) ? implode(',', $request->visibility) : '';
            $jobber->custom_question = !empty($request->custom_question) ? implode(',', $request->custom_question) : '';
            $jobber->created_by      = \Auth::user()->creatorId();
            $jobber->save();

            return redirect()->route('jobber.index')->with('success', __('jobber  successfully created.'));
        }
        else
        {
            return redirect()->route('jobber.index')->with('error', __('Permission denied.'));
        }
    }

    public function show(jobber $jobber)
    {
        $status          = jobber::$status;
        $jobber->applicant  = !empty($jobber->applicant) ? explode(',', $jobber->applicant) : '';
        $jobber->visibility = !empty($jobber->visibility) ? explode(',', $jobber->visibility) : '';
        $jobber->skill      = !empty($jobber->skill) ? explode(',', $jobber->skill) : '';

        return view('jobber.show', compact('status', 'jobber'));
    }

    public function edit(jobber $jobber)
    {

        $categories = jobberCategory::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
        $categories->prepend('--', '');

        $branches = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $branches->prepend('All', 0);

        $status = jobber::$status;

        $jobber->applicant       = explode(',', $jobber->applicant);
        $jobber->visibility      = explode(',', $jobber->visibility);
        $jobber->custom_question = explode(',', $jobber->custom_question);

        $customQuestion = CustomQuestion::where('created_by', \Auth::user()->creatorId())->get();

        return view('jobber.edit', compact('categories', 'status', 'branches', 'jobber', 'customQuestion'));
    }

    public function update(Request $request, jobber $jobber)
    {
        if(\Auth::user()->can('edit job'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'title' => 'required',
                                   'branch' => 'required',
                                   'category' => 'required',
                                   'skill' => 'required',
                                   'position' => 'required|integer',
                                   'start_date' => 'required',
                                   'end_date' => 'required',
                                   'description' => 'required',
                                   'requirement' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $jobber->title           = $request->title;
            $jobber->branch          = $request->branch;
            $jobber->category        = $request->category;
            $jobber->skill           = $request->skill;
            $jobber->position        = $request->position;
            $jobber->status          = $request->status;
            $jobber->start_date      = $request->start_date;
            $jobber->end_date        = $request->end_date;
            $jobber->description     = $request->description;
            $jobber->requirement     = $request->requirement;
            $jobber->applicant       = !empty($request->applicant) ? implode(',', $request->applicant) : '';
            $jobber->visibility      = !empty($request->visibility) ? implode(',', $request->visibility) : '';
            $jobber->custom_question = !empty($request->custom_question) ? implode(',', $request->custom_question) : '';
            $jobber->save();

            return redirect()->route('jobber.index')->with('success', __('jobber  successfully updated.'));
        }
        else
        {
            return redirect()->route('jobber.index')->with('error', __('Permission denied.'));
        }
    }

    public function destroy(jobber $jobber)
    {
        $application = jobberApplication::where('jobber', $jobber->id)->get()->pluck('id');
        jobberApplicationNote::whereIn('application_id', $application)->delete();
        jobberApplication::where('jobber', $jobber->id)->delete();
        $jobber->delete();

        return redirect()->route('jobber.index')->with('success', __('jobber  successfully deleted.'));
    }

    public function career($id, $lang)
    {
        $jobbers= jobber::where('created_by', $id)->get();

        \Session::put('lang', $lang);

        \App::setLocale($lang);

        $companySettings['title_text']      = \DB::table('settings')->where('created_by', $id)->where('name', 'title_text')->first();
        $companySettings['footer_text']     = \DB::table('settings')->where('created_by', $id)->where('name', 'footer_text')->first();
        $companySettings['company_favicon'] = \DB::table('settings')->where('created_by', $id)->where('name', 'company_favicon')->first();
        $companySettings['company_logo']    = \DB::table('settings')->where('created_by', $id)->where('name', 'company_logo')->first();
        $languages                          = Utility::languages();

        $currantLang = \Session::get('lang');
        if(empty($currantLang))
        {
            $user        = User::find($id);
            $currantLang = !empty($user) && !empty($user->lang) ? $user->lang : 'en';
        }


        return view('jobber.career', compact('companySettings', 'jobbers', 'languages', 'currantLang','id'));
    }

    public function jobberRequirement($code, $lang)
    {
        $jobber = jobber::where('code', $code)->first();
        if($jobber->status == 'in_active')
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }

        \Session::put('lang', $lang);

        \App::setLocale($lang);

        $companySettings['title_text']      = \DB::table('settings')->where('created_by', $jobber->created_by)->where('name', 'title_text')->first();
        $companySettings['footer_text']     = \DB::table('settings')->where('created_by', $jobber->created_by)->where('name', 'footer_text')->first();
        $companySettings['company_favicon'] = \DB::table('settings')->where('created_by', $jobber->created_by)->where('name', 'company_favicon')->first();
        $companySettings['company_logo']    = \DB::table('settings')->where('created_by', $jobber->created_by)->where('name', 'company_logo')->first();
        $languages                          = Utility::languages();

        $currantLang = \Session::get('lang');
        if(empty($currantLang))
        {
            $currantLang = !empty($jobber->createdBy) ? $jobber->createdBy->lang : 'en';
        }


        return view('jobber.requirement', compact('companySettings', 'jobber', 'languages', 'currantLang'));
    }

    public function jobberApply($code, $lang)
    {
        \Session::put('lang', $lang);

        \App::setLocale($lang);

        $jobber                                = jobber::where('code', $code)->first();
        $companySettings['title_text']      = \DB::table('settings')->where('created_by', $jobber->created_by)->where('name', 'title_text')->first();
        $companySettings['footer_text']     = \DB::table('settings')->where('created_by', $jobber->created_by)->where('name', 'footer_text')->first();
        $companySettings['company_favicon'] = \DB::table('settings')->where('created_by', $jobber->created_by)->where('name', 'company_favicon')->first();
        $companySettings['company_logo']    = \DB::table('settings')->where('created_by', $jobber->created_by)->where('name', 'company_logo')->first();

        $questions = CustomQuestion::where('created_by', $jobber->created_by)->get();

        $languages = Utility::languages();

        $currantLang = \Session::get('lang');
        if(empty($currantLang))
        {
            $currantLang = !empty($jobber->createdBy) ? $jobber->createdBy->lang : 'en';
        }


        return view('jobber.apply', compact('companySettings', 'jobber', 'questions', 'languages', 'currantLang'));
    }

    public function jobberApplyData(Request $request, $code)
    {

        $validator = \Validator::make(
            $request->all(), [
                               'name' => 'required',
                               'email' => 'required',
                               'phone' => 'required',
//                               'profile' => 'mimes:jpeg,png,jpg,gif,svg|max:20480',
//                               'resume' => 'mimes:jpeg,png,jpg,gif,svg,pdf,doc,zip|max:20480',
                           ]
        );

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $jobber = jobber::where('code', $code)->first();

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
//            if($path['flag'] == 1){
//                $url = $path['url'];
//            }else{
//                return redirect()->back()->with('error', __($path['msg']));
//            }
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

//            if($path['flag'] == 1){
//                $url = $path['url'];
//            }else{
//                return redirect()->back()->with('error', __($path['msg']));
//            }
        }

        $stage=jobberStage::where('created_by',$jobber->created_by)->first();
        $jobberApplication                  = new jobberApplication();
        $jobberApplication->jobber            = $jobber->id;
        $jobberApplication->name            = $request->name;
        $jobberApplication->email           = $request->email;
        $jobberApplication->phone           = $request->phone;
        $jobberApplication->profile         = !empty($request->profile) ? $fileNameToStore : '';
        $jobberApplication->resume          = !empty($request->resume) ? $fileNameToStore1 : '';
        $jobberApplication->cover_letter    = $request->cover_letter;
        $jobberApplication->dob             = $request->dob;
        $jobberApplication->gender          = $request->gender;
        $jobberApplication->country         = $request->country;
        $jobberApplication->state           = $request->state;
        $jobberApplication->city            = $request->city;
        $jobberApplication->custom_question = json_encode($request->question);
        $jobberApplication->created_by      = $jobber->created_by;
        $jobberApplication->stage           = $stage->id;
        $jobberApplication->save();

        return redirect()->back()->with('success', __('jobber application successfully send.'));
    }


}
