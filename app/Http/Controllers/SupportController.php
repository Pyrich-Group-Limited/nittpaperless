<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Support;
use App\Models\SupportReply;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Department;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function index()
    {
        $dep = Department::where('name',"DG's Office")->first()->id;
        if(\Auth::user()->department_id == $dep)
        {
            // $supports = Support::where('created_by', \Auth::user()->creatorId())->get();
            // $countTicket      = Support::where('created_by', '=', \Auth::user()->creatorId())->count();
            // $countOpenTicket  = Support::where('status', '=', 'open')->where('created_by', '=', \Auth::user()->creatorId())->count();
            // $countonholdTicket  = Support::where('status', '=', 'on hold')->where('created_by', '=', \Auth::user()->creatorId())->count();
            // $countCloseTicket = Support::where('status', '=', 'close')->where('created_by', '=', \Auth::user()->creatorId())->count();

            $supports = Support::all();
            $countTicket      = Support::where('created_by', '=', \Auth::user()->creatorId())->count();
            $countOpenTicket  = Support::where('status', '=', 'open')->count();
            $countonholdTicket  = Support::where('status', '=', 'on hold')->count();
            $countCloseTicket = Support::where('status', '=', 'close')->count();
            return view('support.index', compact('supports','countTicket','countOpenTicket','countonholdTicket','countCloseTicket'));
        }
        else {

            // $supports = Support::where('user', \Auth::user()->id)->where('created_by', \Auth::user()->creatorId())->get();
            // $countTicket      = Support::where('user', \Auth::user()->id)->where('created_by', \Auth::user()->creatorId())->count();
            // $countOpenTicket  = Support::where('status', '=', 'open')->where('user', \Auth::user()->id)->where('created_by', \Auth::user()->creatorId())->count();
            // $countonholdTicket  = Support::where('status', '=', 'on hold')->where('user', \Auth::user()->id)->where('created_by', \Auth::user()->creatorId())->count();
            // $countCloseTicket = Support::where('status', '=', 'close')->where('user', \Auth::user()->id)->where('created_by', \Auth::user()->creatorId())->count();

            $supports = Support::where('created_by', \Auth::user()->id)->get();
            $countTicket      = Support::where('user', \Auth::user()->id)->where('created_by', \Auth::user()->creatorId())->count();
            $countOpenTicket  = Support::where('status', '=', 'open')->where('created_by', \Auth::user()->id)->count();
            $countonholdTicket  = Support::where('status', '=', 'on hold')->where('created_by', \Auth::user()->id)->count();
            $countCloseTicket = Support::where('status', '=', 'close')->where('created_by', \Auth::user()->id)->count();
            return view('support.index', compact('supports','countTicket','countOpenTicket','countonholdTicket','countCloseTicket'));
        }

    }
    public function create()
    {
        $priority = [
            __('Low'),
            __('Medium'),
            __('High'),
            __('Critical'),
        ];
//        $status = Support::$status;
        $dep = Department::where('name','Servicom')->first()->id;
        $status = Support::status();
        $users = User::where('department_id', $dep)->where('type', '!=', 'contractor')->get()->pluck('name', 'id');
        return view('support.create', compact('priority', 'users','status'));
    }


    public function store(Request $request)
    {

        $validator = \Validator::make(
            $request->all(), [
                'subject' => 'required',
                'priority' => 'required',
            ]
        );

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $support              = new Support();
        $support->subject     = $request->subject;
        $support->priority    = $request->priority;
        $support->end_date    = $request->end_date;
        $support->ticket_code = date('hms');
        $support->status      = 'Open';

        if(!empty($request->attachment))
        {

            if($support->attachment)
            {
                $path = storage_path('uploads/supports' . $support->attachment);
                if(file_exists($path))
                {
                    \File::delete($path);
                }
            }
            $fileName = time() . "_" . $request->attachment->getClientOriginalName();
            $support->attachment = $fileName;
            $dir        = 'uploads/supports';
            $path = Utility::upload_file($request,'attachment',$fileName,$dir,[]);
            if($path['flag']==0){
                return redirect()->back()->with('error', __($path['msg']));
            }
//            $request->attachment  = $fileName;
//            $support->save();
        }
        $support->description    = $request->description;
        $support->created_by     = \Auth::user()->id;
        $support->ticket_created = \Auth::user()->id;
        $support->user = $request->user;
        // if(\Auth::user()->type == 'contractor')
        // {
        //     $support->user = \Auth::user()->id;
        // }
        // else
        // {
        //     $request->user= $request->user;
        // }

        $support->save();

        //For Notification
        $setting  = Utility::settings(\Auth::user()->creatorId());
        $support_priority = \App\Models\Support::$priority[$support->priority];
        $user = User::find($request->user);
        $supportNotificationArr = [
            'support_priority' =>  $support_priority,
            'support_user_name' =>  $user->name,
        ];
        //Slack Notification
        // if(isset($setting['support_notification']) && $setting['support_notification'] ==1)
        // {
        //     Utility::send_slack_msg('new_support_ticket', $supportNotificationArr);
        // }

        // //Telegram Notification
        // if(isset($setting['telegram_support_notification']) && $setting['telegram_support_notification'] ==1)
        // {
        //     Utility::send_telegram_msg('new_support_ticket', $supportNotificationArr);
        // }

        // send mail
        // $id =!empty($request->user )? $request->user: \Auth::user()->id;
        // $employee             = User::find($id);
        // $support_priority = \App\Models\Support::$priority[$support->priority];
        // $supportArr = [
        //     'support_name'=> $employee->name,
        //     'support_title' => $support->subject,
        //     'support_priority' =>  $support_priority,
        //     'support_end_date' => $support->end_date,
        //     'support_description' => $support->description,

        // ];
        // $resp = Utility::sendEmailTemplate('new_support_ticket', [$employee->id => $employee->email], $supportArr);


        //webhook
        $module ='New Support Ticket';
        $webhook=  Utility::webhookSetting($module);
        if($webhook)
        {
            $parameter = json_encode($support);
            $status = Utility::WebhookCall($webhook['url'],$parameter,$webhook['method']);
            if($status == true)
            {
                return redirect()->route('support.index')->with('success', __('Support successfully added.').((!empty ($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));
            }
            else
            {
                return redirect()->back()->with('error', __('Webhook call failed.'));
            }
        }

        return redirect()->route('support.index')->with('success', __('Support successfully added.').((!empty ($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));

    }


    public function show(Support $support)
    {
        //
    }


    public function edit(Support $support)
    {
        $priority = [
            __('Low'),
            __('Medium'),
            __('High'),
            __('Critical'),
        ];
//        $status = Support::$status;
        $status = Support::status();
        $users = User::where('created_by', \Auth::user()->creatorId())->where('type', '!=', 'registrar')->get()->pluck('name', 'id');

        return view('support.edit', compact('priority', 'users', 'support','status'));
    }


    public function update(Request $request, Support $support)
    {

        $validator = \Validator::make(
            $request->all(), [
                               'subject' => 'required',
                               'priority' => 'required',
                           ]
        );

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $support->subject  = $request->subject;
        $support->user     = $request->user;
        $support->priority = $request->priority;
        $support->status  = $request->status;
        $support->end_date = $request->end_date;

        if(!empty($request->attachment))
        {

            if($support->attachment)
            {
                $path = storage_path('uploads/supports' . $support->attachment);
                if(file_exists($path))
                {
                    \File::delete($path);
                }
            }
            $fileName = time() . "_" . $request->attachment->getClientOriginalName();
            $support->attachment = $fileName;
            $dir        = 'uploads/supports';
            $path = Utility::upload_file($request,'attachment',$fileName,$dir,[]);
            if($path['flag']==0){
                return redirect()->back()->with('error', __($path['msg']));
            }
//            $request->attachment  = $fileName;
//            $support->save();
        }
        $support->description = $request->description;

        $support->save();

        return redirect()->route('support.index')->with('success', __('Support successfully updated.'));

    }


    public function destroy(Support $support)
    {
        $support->delete();
        if($support->attachment)
        {
            \File::delete(storage_path('uploads/supports/' . $support->attachment));
        }

        return redirect()->route('support.index')->with('success', __('Support successfully deleted.'));

    }

    public function reply($ids)
    {
        try {
            $id              = Crypt::decrypt($ids);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Support Not Found.'));
        }
        $id      = \Crypt::decrypt($ids);
        $replyes = SupportReply::where('support_id', $id)->get();
        $support = Support::find($id);

        foreach($replyes as $reply)
        {
            $supportReply          = SupportReply::find($reply->id);
            $supportReply->is_read = 1;
            $supportReply->save();
        }

        return view('support.reply', compact('support', 'replyes'));
    }

    public function replyAnswer(Request $request, $id)
    {
        $supportReply              = new SupportReply();
        $supportReply->support_id  = $id;
        $supportReply->user        = \Auth::user()->id;
        $supportReply->description = $request->description;
        $supportReply->created_by  = \Auth::user()->creatorId();
        $supportReply->save();

        return redirect()->back()->with('success', __('Support reply successfully send.'));
    }

    public function grid()
    {
        $dep = Department::where('name','Servicom')->first()->id;
        if(\Auth::user()->department_id == $dep)
        {
            $supports = Support::all();

            return view('support.grid', compact('supports'));
        }
        else
        {
            $supports = Support::where('created_by', \Auth::user()->id)->get();

            return view('support.grid', compact('supports'));
        }
        // elseif(\Auth::user()->type == 'Employee')
        // {

        //     $supports = Support::where('user', \Auth::user()->id)->orWhere('ticket_created', \Auth::user()->id)->get();

        //     return view('support.grid', compact('supports'));
        // }
        // else
        // {
        //     return redirect()->back()->with('error', __('Permission denied.'));
        // }
    }
}
