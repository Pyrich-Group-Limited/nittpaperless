@php
    $logo=\App\Models\Utility::get_file('uploads/logo/');

    $company_logo=Utility::getValByName('company_logo_dark');
    $company_logos=Utility::getValByName('company_logo_light');
    $setting = \App\Models\Utility::colorset();
    $mode_setting = \App\Models\Utility::mode_layout();
    $emailTemplate     = \App\Models\EmailTemplate::first();
    $lang= Auth::user()->lang;
@endphp

{{--<nav class="dash-sidebar light-sidebar {{(isset($mode_setting['cust_theme_bg']) && $mode_setting['cust_theme_bg'] == 'on')?'transprent-bg':''}}">--}}

@if (isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on')
    <nav class="dash-sidebar light-sidebar transprent-bg">
@else
    <nav class="dash-sidebar light-sidebar">
@endif
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="#" class="b-brand">
                <img src="{{  asset('logo-dark.png') }}" alt="NITTs" class="logo logo-lg">
            </a>

        </div>
        <div  align="center">
            <h6 class="text-primary">({{ Ucfirst(Auth::user()->designation ?? '') }})</h6>
            <h6 class="text-primary">({{ Ucfirst(Auth::user()->department->name ?? '') }})</h6>
             @if(Auth::user()->location==='Headquarters')
                <h6 class="text-primary">{{ Ucfirst(Auth::user()->location ?? '')}}</h6>
            @elseif (Auth::user()->location==='Liaison Office')
                <h6 class="text-primary">{{ Ucfirst(Auth::user()->location_type ?? '') }} Liaison Office</h6>
            @endif
        </div>


        <div class="navbar-content">
            @if(\Auth::user()->type =='DG')
                <ul class="dash-navbar">
                    <li class="dash-item dash-hasmenu ">
                        <a href="{{ route('dg.dashboard') }}" class="dash-link {{ (Request::segment(1) == 'business')?'active':'' }}"
                        ><span class="dash-micon"><i class="ti ti-home"></i></span
                            ><span class="dash-mtext">{{__('Dashboard')}}</span
                            ></a>
                    </li>

                    <li class="dash-item dash-hasmenu ">
                        <a href="{{ route('budget.pending') }}" class="dash-link {{ (Request::segment(1) == 'business')?'active':'' }}"
                        ><span class="dash-micon"><i class="ti ti-cash"></i></span
                            ><span class="dash-mtext">{{__('Budgets')}}</span
                            ></a>
                    </li>

                    <li class="dash-item dash-hasmenu ">
                        <a href="{{ route('dg.projects') }}" class="dash-link {{ (Request::segment(1) == 'business')?'active':'' }}"
                        ><span class="dash-micon"><i class="ti ti-settings"></i></span
                            ><span class="dash-mtext">{{__('Projects')}}</span
                            ></a>
                    </li>
                    {{-- @can('manage contract') --}}
                        <li class="dash-item dash-hasmenu ">
                            <a href="{{ route('dg.contracts') }}" class="dash-link {{ (Request::segment(1) == 'business')?'active':'' }}"
                            ><span class="dash-micon"><i class="ti ti-file"></i></span
                                ><span class="dash-mtext">{{__('Contracts')}}</span
                                ></a>
                        </li>
                    {{-- @endcan --}}

                    <li class="dash-item dash-hasmenu  ">
                        <a href="#!" class="dash-link {{ (Request::segment(1) == 'business')?'active':'' }}"
                        ><span class="dash-micon"><i class="ti ti-cash"></i></span
                            ><span class="dash-mtext">{{__('DTA Management')}}</span
                            ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                            ></a>
                        <ul class="dash-submenu">
                            <li class="dash-item {{ (Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : '' }} ">
                                <a class="dash-link" href="{{ route('dta.index') }}">{{__('DTA')}}</a>
                            </li>
                            <li class="dash-item {{ (Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : '' }}">
                                <a class="dash-link" href="{{ route('reports.dta') }}">{{__('DTA Report')}}</a>
                            </li>
                            @can('dg approve')
                                <li class="dash-item {{ request()->is('dtaApproval.dg') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('dtaApproval.dg') }}">{{__('DG Approval')}}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>

                    <li class="dash-item dash-hasmenu ">
                        <a href="#!" class="dash-link {{ (Request::segment(1) == 'business')?'active':'' }}"
                        ><span class="dash-micon"><i class="ti ti-cash"></i></span
                            ><span class="dash-mtext">{{__('Payment Requisition')}}</span
                            ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                            ></a>
                        <ul class="dash-submenu">
                            @can('final account view')
                                <li class="dash-item {{ request()->is('manage.requisitions') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('manage.requisitions') }}">{{__('Manage Requisitions')}}</a>
                                </li>
                            @endcan
                            @can('approve as dg')
                                <li class="dash-item {{ request()->is('dg.requisitions') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('dg.requisitions') }}">{{__('DG Approval')}}</a>
                                </li>
                            @endcan

                        </ul>
                    </li>

                    <li class="dash-item dash-hasmenu ">
                        <a href="{{ route('memos.index') }}" class="dash-link {{ (Request::segment(1) == 'business')?'active':'' }}"
                        ><span class="dash-micon"><i class="ti ti-files"></i></span
                            ><span class="dash-mtext">{{__('Memo')}}</span
                            ></a>
                    </li>
                    <li class="dash-item dash-hasmenu ">
                        <a href="{{ route('dg.ergps') }}" class="dash-link {{ (Request::segment(1) == 'business')?'active':'' }}"
                        ><span class="dash-micon"><i class="ti ti-cash"></i></span
                            ><span class="dash-mtext">{{__('ERGP')}}</span
                            ></a>
                    </li>



                </ul>
            @else

            {{-- @if(\Auth::user()->type == 'client') --}}
                <ul class="dash-navbar">
                    @if( Gate::check('show hrm dashboard') || Gate::check('show project dashboard') || Gate::check('show account dashboard') || Gate::check('show crm dashboard'))
                        <li class="dash-item dash-hasmenu
                             {{ ( Request::segment(1) == null ||Request::segment(1) == 'account-dashboard' || Request::segment(1) == 'income report'
                                || Request::segment(1) == 'report'  || Request::segment(1) == 'reports-monthly-cashflow' || Request::segment(1) == 'reports-quarterly-cashflow' || Request::segment(1) == 'reports-payroll' || Request::segment(1) == 'reports-leave' ||
                                 Request::segment(1) == 'reports-monthly-attendance'|| Request::segment(1) == 'reports-lead' || Request::segment(1) == 'reports-deal'
                                 || Request::segment(1) == 'pos-dashboard'|| Request::segment(1) == 'reports-warehouse' || Request::segment(1) == 'reports-daily-purchase'
                                || Request::segment(1) == 'reports-monthly-purchase' || Request::segment(1) == 'reports-daily-pos' ||Request::segment(1) == 'reports-monthly-pos' ||Request::segment(1) == 'reports-pos-vs-purchase') ?'active dash-trigger':''}}">
                            <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-home"></i></span><span class="dash-mtext">{{__('Overview')}}</span>
                                <span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                            <ul class="dash-submenu">
                                <!-- <li class="dash-item {{ ( Request::segment(1) == null || Request::segment(1) == 'dashboard') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('dashboard')}}">{{__(' Dashboard')}}</a>
                                </li> -->
                                <li class="dash-item {{ ( Request::segment(1) == null || Request::segment(1) == 'dashboard') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('business-dashboard')}}">{{__(' Advance Planning')}}</a>
                                </li>
                                <li class="dash-item {{ ( Request::segment(1) == null || Request::segment(1) == 'dashboard') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('business-dashboard')}}">{{__(' Business Intelligence')}}</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(\Auth::user()->show_crm() == 1)
                        @if( Gate::check('manage lead') || Gate::check('manage deal') || Gate::check('manage form builder') || Gate::check('manage contract'))
                            <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'holiday-calender' || Request::segment(1) == 'reports-monthly-attendance' ||
                                Request::segment(1) == 'reports-leave' || Request::segment(1) == 'reports-payroll' || Request::segment(1) == 'leavetype' || Request::segment(1) == 'leave' ||
                                Request::segment(1) == 'attendanceemployee' || Request::segment(1) == 'document-upload' || Request::segment(1) == 'document' || Request::segment(1) == 'performanceType'  ||
                                    Request::segment(1) == 'branch' || Request::segment(1) == 'department' || Request::segment(1) == 'designation' || Request::segment(1) == 'employee'
                                    || Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender'
                                    || Request::segment(1) == 'award' || Request::segment(1) == 'transfer' || Request::segment(1) == 'resignation' || Request::segment(1) == 'training' || Request::segment(1) == 'travel' ||
                                    Request::segment(1) == 'promotion' || Request::segment(1) == 'complaint' || Request::segment(1) == 'warning'
                                     || Request::segment(1) == 'termination' || Request::segment(1) == 'announcement' || Request::segment(1) == 'job' || Request::segment(1) == 'job-application' ||
                                      Request::segment(1) == 'candidates-job-applications' || Request::segment(1) == 'job-onboard' || Request::segment(1) == 'custom-question'
                                       || Request::segment(1) == 'interview-schedule' || Request::segment(1) == 'career' || Request::segment(1) == 'holiday' || Request::segment(1) == 'setsalary' ||
                                       Request::segment(1) == 'payslip' || Request::segment(1) == 'paysliptype' || Request::segment(1) == 'company-policy' || Request::segment(1) == 'job-stage'
                                       || Request::segment(1) == 'job-category' || Request::segment(1) == 'terminationtype' || Request::segment(1) == 'awardtype' || Request::segment(1) == 'trainingtype' ||
                                       Request::segment(1) == 'goaltype' || Request::segment(1) == 'paysliptype' || Request::segment(1) == 'allowanceoption' || Request::segment(1) == 'competencies' || Request::segment(1) == 'loanoption'
                                       || Request::segment(1) == 'deductionoption')?'active dash-trigger':''}}">
                                <a href="#!" class="dash-link"
                                ><span class="dash-micon"><i class="ti ti-layers-difference"></i></span
                                    ><span class="dash-mtext">{{__('HRM System')}}</span
                                    ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                    ></a>
                                <ul class="dash-submenu {{ (Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'deals' || Request::segment(1) == 'pipelines')?'show':''}}">
                                    @can('show hrm dashboard')
                                    <li class="dash-item {{ (\Request::route()->getName()=='hrm.dashboard') ? ' active' : '' }}">
                                        <a class="dash-link" href="{{route('hrm.dashboard')}}">{{__(' Overview')}}</a>
                                    </li>
                                    @endcan
                                    @can('manage payment')
                                    <li class="dash-item {{ request()->is('reports-payroll') ? 'active' : '' }}">
                                        <a class="dash-link" href="{{ route('report.payroll') }}">{{__('Payroll')}}</a>
                                    </li>
                                    @endcan
                                    @can('manage payment')
                                    <li class="dash-item {{ request()->is('employees-files') ? 'active' : '' }}">
                                        <a class="dash-link" href="{{ route('employees.files') }}">{{__('Employee Files')}}</a>
                                    </li>
                                    @endcan
                                    @can('manage report')
                                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'reports-monthly-attendance' || Request::segment(1) == 'reports-leave' || Request::segment(1) == 'reports-payroll') ? 'active dash-trigger' : ''}}" href="#hr-report" data-toggle="collapse" role="button" aria-expanded="{{(Request::segment(1) == 'reports-monthly-attendance' || Request::segment(1) == 'reports-leave' || Request::segment(1) == 'reports-payroll') ? 'true' : 'false'}}">
                                            <a class="dash-link" href="#">{{__('Reports/Analytics')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                <li class="dash-item {{ request()->is('reports-lead') ? 'active' : '' }}">
                                                    <a class="dash-link" href="{{ route('report.lead') }}">{{__('Lead')}}</a>
                                                </li>
                                                <li class="dash-item {{ request()->is('reports-deal') ? 'active' : '' }}">
                                                    <a class="dash-link" href="{{ route('report.deal') }}">{{__('Deal')}}</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endcan
                                    @if( Gate::check('manage indicator') || Gate::check('manage appraisal') || Gate::check('manage goal tracking'))
                                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking') ? 'active dash-trigger' : ''}}" href="#navbar-performance" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking') ? 'true' : 'false'}}">
                                            <a class="dash-link" href="#">{{__('Performance Management')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu {{ (Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking') ? 'show' : 'collapse'}}">
                                                @can('manage indicator')
                                                    <li class="dash-item {{ (request()->is('indicator*') ? 'active' : '')}}">
                                                        <a class="dash-link" href="{{route('indicator.index')}}">{{__('Indicator')}}</a>
                                                    </li>
                                                @endcan
                                                @can('manage appraisal')
                                                    <li class="dash-item {{ (request()->is('appraisal*') ? 'active' : '')}}">
                                                        <a class="dash-link" href="{{route('appraisal.index')}}">{{__('Appraisal')}}</a>
                                                    </li>
                                                @endcan
                                                @can('manage goal tracking')
                                                    <li class="dash-item  {{ (request()->is('goaltracking*') ? 'active' : '')}}">
                                                        <a class="dash-link" href="{{route('goaltracking.index')}}">{{__('Goal Tracking')}}</a>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </li>
                                    @endif
                                    @if (\Auth::user()->type == 'super admin' || \Auth::user()->type == 'HR')
                                    <li class="dash-item {{ (Request::segment(1) == 'leavetype' || Request::segment(1) == 'document' || Request::segment(1) == 'performanceType' || Request::segment(1) == 'branch' || Request::segment(1) == 'department'
                                                              || Request::segment(1) == 'designation' || Request::segment(1) == 'job-stage'|| Request::segment(1) == 'performanceType'  || Request::segment(1) == 'job-category' || Request::segment(1) == 'terminationtype' ||
                                                               Request::segment(1) == 'awardtype' || Request::segment(1) == 'trainingtype' || Request::segment(1) == 'goaltype' || Request::segment(1) == 'paysliptype' ||
                                                               Request::segment(1) == 'allowanceoption' || Request::segment(1) == 'loanoption' || Request::segment(1) == 'deductionoption') ? 'active dash-trigger' : ''}}">
                                        <a class="dash-link" href="{{route('branch.index')}}">{{__('HRM System Setup')}}</a>
                                    </li>
                                    @endif
                                    <li class="dash-item  {{ (Request::segment(1) == 'employee' ? 'active dash-trigger' : '')}}   ">
                                        @if(\Auth::user()->type =='Employee')
                                            @php
                                                $employee=App\Models\Employee::where('user_id',\Auth::user()->id)->first();
                                            @endphp
                                            <a class="dash-link" href="{{route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))}}">{{__('Employee')}}</a>
                                        @else
                                            <a href="{{route('employee.index')}}" class="dash-link">
                                                {{ __('Employee Info Management') }}
                                            </a>
                                        @endif
                                    </li>
                                    @if( Gate::check('manage training') || Gate::check('manage trainer'))
                                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'trainer' || Request::segment(1) == 'training') ? 'active dash-trigger' : ''}}" href="#navbar-training" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'trainer' || Request::segment(1) == 'training') ? 'true' : 'false'}}">
                                        <a class="dash-link" href="#">{{__('Training Setup')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            @can('manage training')
                                                <li class="dash-item {{ (request()->is('training*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('training.index')}}">{{__('Training List')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage trainer')
                                                <li class="dash-item {{ (request()->is('trainer*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('trainer.index')}}">{{__('Trainer')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage meeting')
                                                <li class="dash-item {{ (request()->is('meeting*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('meeting.index')}}">{{__('Meeting')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage announcement')
                                                <li class="dash-item {{ (request()->is('announcement*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('announcement.index')}}">{{__('Announcement')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage event')
                                                <li class="dash-item {{ (request()->is('event*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('event.index')}}">{{__('Event Setup')}}</a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                    @endif
                                    @if( Gate::check('manage job') || Gate::check('create job') || Gate::check('manage job application') || Gate::check('manage custom question') || Gate::check('show interview schedule') || Gate::check('show career') )
                                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'job' || Request::segment(1) == 'job-application' || Request::segment(1) == 'candidates-job-applications' || Request::segment(1) == 'job-onboard' || Request::segment(1) == 'custom-question' || Request::segment(1) == 'interview-schedule' || Request::segment(1) == 'career') ? 'active dash-trigger' : ''}}    ">
                                        <a class="dash-link" href="#">{{__('Recruitments & Onboarding')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            @can('manage job')
                                                <li class="dash-item {{ (Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show'   ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('job.index')}}">{{__('Jobs')}}</a>
                                                </li>
                                            @endcan
                                            @can('create job')
                                                <li class="dash-item {{ ( Request::route()->getName() == 'job.create' ? 'active' : '')}} ">
                                                    <a class="dash-link" href="{{route('job.create')}}">{{__('Job Posting')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage job application')
                                                <li class="dash-item {{ (request()->is('job-application*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('job-application.index')}}">{{__('Job Application')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage job application')
                                                <li class="dash-item {{ (request()->is('job-onboard*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('job.on.board')}}">{{__('Employee Onboarding')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage custom question')
                                            <!----    <li class="dash-item  {{ (request()->is('custom-question*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('custom-question.index')}}">{{__('Custom Question')}}</a>
                                                </li> ---->
                                            @endcan
                                            @can('show interview schedule')
                                                <li class="dash-item {{ (request()->is('interview-schedule*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('interview-schedule.index')}}">{{__('Interview Schedule')}}</a>
                                                </li>
                                            @endcan



                                        {{---    @can('manage job')
                                                <li class="dash-item {{ (Request::route()->getName() == 'jobber.index' || Request::route()->getName() == 'jobber.create' || Request::route()->getName() == 'jobber.edit' || Request::route()->getName() == 'jobber.show'   ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('jobber.index')}}">{{__('Contracts')}}</a>
                                                </li>
                                            @endcan
                                            @can('create job')
                                                <li class="dash-item {{ ( Request::route()->getName() == 'jobber.create' ? 'active' : '')}} ">
                                                    <a class="dash-link" href="{{route('jobber.create')}}">{{__('Contracts Posting')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage job application')
                                                <li class="dash-item {{ (request()->is('jobber-application*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('jobber-application.index')}}">{{__('Contracts Application')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage job application')
                                                <li class="dash-item {{ (request()->is('jobber-onboard*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('job.on.board')}}">{{__('Contract Onboarding')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage custom question')
                                            <!----    <li class="dash-item  {{ (request()->is('custom-question*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('custom-question.index')}}">{{__('Custom Question')}}</a>
                                                </li> ---->
                                            @endcan
                                            @can('show interview schedule')
                                                <li class="dash-item {{ (request()->is('interview-schedule*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('interview-schedule.index')}}">{{__('Contract Meeting Schedule')}}</a>
                                                </li>
                                            @endcan
                                            -----}}








                                            {{-- @can('show career')
                                                <li class="dash-item {{ (request()->is('career*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('career',[\Auth::user()->creatorId(),$lang])}}">{{__('Career')}}</a></li>
                                            @endcan --}}
                                        </ul>
                                    </li>
                                    @endif
                                    @if( Gate::check('manage award') || Gate::check('manage transfer') || Gate::check('manage resignation') || Gate::check('manage travel') || Gate::check('manage promotion') || Gate::check('manage complaint') || Gate::check('manage warning') || Gate::check('manage termination') || Gate::check('manage announcement') || Gate::check('manage holiday') )
                                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'holiday-calender' || Request::segment(1) == 'holiday' || Request::segment(1) == 'policies' || Request::segment(1) == 'award' || Request::segment(1) == 'transfer' || Request::segment(1) == 'resignation' || Request::segment(1) == 'travel' || Request::segment(1) == 'promotion' || Request::segment(1) == 'complaint' || Request::segment(1) == 'warning' || Request::segment(1) == 'termination' || Request::segment(1) == 'announcement' || Request::segment(1) == 'competencies') ? 'active dash-trigger' : ''}}">
                                        <a class="dash-link" href="#">{{__('HR/Employee Benefits')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            @can('manage award')
                                                <li class="dash-item {{ (request()->is('award*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('award.index')}}">{{__('Award')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage transfer')
                                                <li class="dash-item  {{ (request()->is('transfer*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('transfer.index')}}">{{__('Transfer')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage resignation')
                                                <li class="dash-item {{ (request()->is('resignation*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('resignation.index')}}">{{__('Resignation')}}</a>
                                                </li>
                                            @endcan

                                            @can('manage promotion')
                                                <li class="dash-item {{ (request()->is('promotion*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('promotion.index')}}">{{__('Promotion')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage termination')
                                                <li class="dash-item {{ (request()->is('termination*') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('termination.index')}}">{{__('Termination')}}</a>
                                                </li>
                                            @endcan
                                            @can('manage holiday')
                                                <li class="dash-item {{ (request()->is('holiday*') || request()->is('holiday-calender') ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('holiday.index')}}">{{__('Holidays')}}</a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                    @endif
                                    @can('manage assets')
                                        <li class="dash-item {{ (request()->is('account-assets*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{route('account-assets.index')}}">{{__('Employees Asset Setup ')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage company policy')
                                        <li class="dash-item {{ (request()->is('company-policy*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{route('company-policy.index')}}">{{__('Company policy')}}</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                    @endif

                    <li class="dash-item dash-hasmenu ">
                        <a href="#!" class="dash-link {{ (Request::segment(1) == 'business')?'active':'' }}"
                        ><span class="dash-micon"><i class="ti ti-cash"></i></span
                            ><span class="dash-mtext">{{__('Payment Requisition')}}</span
                            ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                            ></a>
                        <ul class="dash-submenu">
                            <li class="dash-item {{ request()->is('requisition.raise') ? 'active' : '' }}">
                                <a class="dash-link" href="{{ route('requisition.raise') }}">{{__('My Requisitions')}}</a>
                            </li>
                            @can('final account view')
                                <li class="dash-item {{ request()->is('manage.requisitions') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('manage.requisitions') }}">{{__('Manage Requisitions')}}</a>
                                </li>
                            @endcan
                            @can('approve as hod')
                                <li class="dash-item {{ request()->is('hod.requisitions') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('hod.requisitions') }}">{{__('HoD Approval')}}</a>
                                </li>
                            @endcan
                            @can('approve as liaison head')
                                <li class="dash-item {{ request()->is('liaison.requisitions') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('liaison.requisitions') }}">{{__('LiaisonHead Approval')}}</a>
                                </li>
                            @endcan
                            @can('approve as special duty')
                                <li class="dash-item {{ request()->is('sd.requisitions') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('sd.requisitions') }}">{{__('SD Head Approval')}}</a>
                                </li>
                            @endcan
                            @can('approve as dg')
                                <li class="dash-item {{ request()->is('dg.requisitions') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('dg.requisitions') }}">{{__('DG Approval')}}</a>
                                </li>
                            @endcan
                            @can('approve as bursar')
                                <li class="dash-item {{ request()->is('bursar.requisitions') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('bursar.requisitions') }}">{{__('Bursar Approval')}}</a>
                                </li>
                            @endcan
                            @can('approve as pv')
                                <li class="dash-item {{ request()->is('pv.requisitions') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('pv.requisitions') }}">{{__('PV Approval')}}</a>
                                </li>
                            @endcan
                            @can('approve as audit')
                                <li class="dash-item {{ request()->is('audit.requisitions') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('audit.requisitions') }}">{{__('Audit Approval')}}</a>
                                </li>
                            @endcan
                            @can('approve as cash office')
                                <li class="dash-item {{ request()->is('cash-office.requisitions') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('cash-office.requisitions') }}">{{__('Cash Office Approval')}}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>

                    @if( Gate::check('set budget') || Gate::check('manage budget') || Gate::check('view budget') || Gate::check('manage ergp') || Gate::check('view ergp'))
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'budgets' || Request::segment(1) == 'ergp' || Request::segment(1) == 'ergp') ? 'active dash-trigger' : ''}}" href="#navbar-performance" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'budgets' || Request::segment(1) == 'ergp') ? 'true' : 'false'}}">
                            <a class="dash-link" href="#"><span class="dash-micon"><i class="ti ti-cash"></i></span
                                >{{__('Budget')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                            <ul class="dash-submenu {{ (Request::segment(1) == 'budgets' || Request::segment(1) == 'ergp' || Request::segment(1) == 'ergp') ? 'show' : 'collapse'}}">
                                @can('set budget')
                                    <li class="dash-item {{ (request()->is('indicator*') ? 'active' : '')}}">
                                        <a class="dash-link" href="{{route('department.budget')}}">{{__('Set Budget')}}</a>
                                    </li>
                                @endcan
                                @can('manage budget')
                                <li class="dash-item">
                                    <a class="dash-link" href="{{route('budget.category')}}">{{__('Manage Budgets')}}</a>
                                </li>
                                @endcan
                                @can('manage budget')
                                    <li class="dash-item">
                                        <a class="dash-link" href="{{route('budget.pending')}}">{{__('Pending Approval')}}</a>
                                    </li>
                                @endcan
                                @can('manage ergp')
                                    <li class="dash-item  {{ (request()->is('goaltracking*') ? 'active' : '')}}">
                                        <a class="dash-link" href="{{route('pp.ergp')}}">{{__('Manage ERGP')}}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @can('manage project')
                        <li class="dash-item dash-hasmenu {{ ( Request::segment(1) == 'project' || Request::segment(1) == 'bugs-report' || Request::segment(1) == 'bugstatus' || Request::segment(1) == 'project-task-stages' || Request::segment(1) == 'calendar' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' || Request::segment(1) == 'project' || Request::segment(1) == 'projects' || Request::segment(1) == 'project_report')
                            ? 'active dash-trigger' : ''}}">
                            <a href="#!" class="dash-link"
                            ><span class="dash-micon"><i class="ti ti-layers-difference"></i></span
                                ><span class="dash-mtext">{{__('e-Procurement')}}</span
                                ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                ></a>
                                <ul class="dash-submenu">
                                    @can('manage project')
                                        <li class="dash-item  {{Request::segment(1) == 'project' || Request::route()->getName() == 'projects.list' || Request::route()->getName() == 'projects.list' ||Request::route()->getName() == 'projects.index' || Request::route()->getName() == 'projects.show' || request()->is('projects/*') ? 'active' : ''}}">
                                            <a class="dash-link" href="{{route('created-projects')}}">{{__('Projects')}}</a>
                                        </li>
                                        <li class="dash-item  {{Request::segment(1) == 'project' || Request::route()->getName() == 'projects.list' || Request::route()->getName() == 'projects.list' ||Request::route()->getName() == 'projects.index' || Request::route()->getName() == 'projects.show' || request()->is('projects/*') ? 'active' : ''}}">
                                            <a class="dash-link" href="{{route('pp.ergp')}}">{{__('ERGP')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage client')
                                        {{-- <li class="dash-item {{ (Request::route()->getName() == 'clients.index' || Request::segment(1) == 'clients' || Request::route()->getName() == 'clients.edit') ? ' active' : '' }}">
                                            <a class="dash-link" href="{{ route('clients.index') }}">{{__('Contractor')}}</a>
                                        </li> --}}
                                        <li class="dash-item {{ (Request::route()->getName() == 'clients.index' || Request::segment(1) == 'clients' || Request::route()->getName() == 'clients.edit') ? ' active' : '' }}">
                                            <a class="dash-link" href="{{ route('project.contractors') }}">{{__('Contractors')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage contract')
                                        <li class="dash-item  {{ (Request::segment(1) == 'contract')?'active':''}}">
                                            <a class="dash-link" href="{{route('project.contracts')}}">{{__('Contracts')}}</a>
                                        </li>
                                    @endcan
                                    <!-- @can('manage project task')
                                        <li class="dash-item {{ (request()->is('taskboard*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{ route('taskBoard.view', 'list') }}">{{__('Tasks')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage timesheet')
                                        <li class="dash-item {{ (request()->is('timesheet-list*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{route('timesheet.list')}}">{{__('Timesheet')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage project task')
                                        <li class="dash-item {{ (request()->is('calendar*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{ route('task.calendar',['all']) }}">{{__('Task Calendar')}}</a>
                                        </li>
                                    @endcan -->
                                    @if(\Auth::user()->type!='super admin')
                                        <li class="dash-item  {{ (Request::segment(1) == 'time-tracker')?'active open':''}}">
                                            <a class="dash-link" href="{{ route('time.tracker') }}">{{__('Tracker')}}</a>
                                        </li>
                                    @endif
                                    @if (\Auth::user()->type == 'super admin')
                                        <li class="dash-item  {{(Request::route()->getName() == 'project_report.index' || Request::route()->getName() == 'project_report.show') ? 'active' : ''}}">
                                            <a class="dash-link" href="{{route('project_report.index') }}">{{__('Project Report')}}</a>
                                        </li>
                                    @endif
                                    <!-- @if(Gate::check('manage project task stage') || Gate::check('manage bug status'))
                                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'bugstatus' || Request::segment(1) == 'project-task-stages') ? 'active dash-trigger' : ''}}">
                                            <a class="dash-link" href="#">{{__('Project System Setup')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                @can('manage project task stage')
                                                    <li class="dash-item  {{ (Request::route()->getName() == 'project-task-stages.index') ? 'active' : '' }}">
                                                        <a class="dash-link" href="{{route('project-task-stages.index')}}">{{__('Project Task Stages')}}</a>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </li>
                                    @endif -->
                                </ul>
                        </li>
                    @endcan

                    @if(\Auth::user()->type=='super admin' && ( Gate::check('manage user') || Gate::check('manage role') || Gate::check('manage client')))
                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'users' || Request::segment(1) == 'roles'
                            || Request::segment(1) == 'clients'  || Request::segment(1) == 'userlogs')?' active dash-trigger':''}}">
                            <a href="#!" class="dash-link {{ (Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'clients')?' active dash-trigger':''}}"
                            ><span class="dash-micon"><i class="ti ti-users"></i></span
                                ><span class="dash-mtext">{{__('User Management')}}</span
                                ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                ></a>
                            <ul class="dash-submenu">
                                @can('manage user')
                                    <li class="dash-item {{ (Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit' || Request::route()->getName() == 'user.userlog') ? ' active' : '' }}">
                                        <a class="dash-link" href="{{ route('get-all-users') }}">{{__('User')}}</a>
                                    </li>
                                @endcan
                                @can('create department')
                                    <li class="dash-item {{ (Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit' || Request::route()->getName() == 'user.userlog') ? ' active' : '' }}">
                                        <a class="dash-link" href="{{ route('get-all-departments') }}">{{__('Departments')}}</a>
                                    </li>
                                @endcan
                                @can('manage department')
                                    <li class="dash-item {{ (Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit' || Request::route()->getName() == 'user.userlog') ? ' active' : '' }}">
                                        <a class="dash-link" href="{{ route('get-all-units') }}">{{__('Units')}}</a>
                                    </li>
                                @endcan
                                @can('manage department')
                                    <li class="dash-item {{ (Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit' || Request::route()->getName() == 'user.userlog') ? ' active' : '' }}">
                                        <a class="dash-link" href="{{ route('get-all-designations') }}">{{__('Designations')}}</a>
                                    </li>
                                @endcan

                                {{-- @can('manage role')
                                    <li class="dash-item {{ (Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : '' }} ">
                                        <a class="dash-link" href="{{route('roles.index')}}">{{__('Role')}}</a>
                                    </li>
                                @endcan
                                @can('manage user')
                                    <li class="dash-item {{ (Request::route()->getName() == 'users.index' || Request::segment(1) == 'users' || Request::route()->getName() == 'users.edit') ? ' active' : '' }}">
                                        <a class="dash-link" href="{{ route('user.userlog') }}">{{__('Audit Logs')}}</a>
                                    </li>
                                @endcan --}}
                            </ul>
                        </li>
                    @endif

                    @if(\Auth::user()->show_crm() == 1)
                        @if( Gate::check('manage lead') || Gate::check('manage deal') || Gate::check('manage form builder') || Gate::check('manage contract'))
                            <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'deals' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'contract') ?' active dash-trigger':''}}">
                                <a href="#!" class="dash-link"
                                ><span class="dash-micon"><i class="ti ti-layers-difference"></i></span
                                    ><span class="dash-mtext">{{__('CRM System')}}</span
                                    ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                    ></a>
                                <ul class="dash-submenu {{ (Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'deals' || Request::segment(1) == 'pipelines')?'show':''}}">

                                    <li class="dash-item {{ (Request::segment(1) == 'chats')?'active':'' }}">
                                        <a class="dash-link" href="{{route('chats')}}">{{__('Talk To')}}</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endif

                    @can('show bursary menu')
                            {{-- @if(\Auth::user()->show_account() == 1) --}}
                                {{-- @if( Gate::check('manage customer') || Gate::check('manage vender') || Gate::check('manage customer') || Gate::check('manage vender') ||
                                    Gate::check('manage proposal') ||  Gate::check('manage bank account') ||  Gate::check('manage bank transfer') ||  Gate::check('manage invoice')
                                    ||  Gate::check('manage revenue') ||  Gate::check('manage credit note') ||  Gate::check('manage bill')  ||  Gate::check('manage payment') ||
                                    Gate::check('manage debit note') || Gate::check('manage chart of account') ||  Gate::check('manage journal entry') ||   Gate::check('balance sheet report')
                                    || Gate::check('ledger report') ||  Gate::check('trial balance report')  ) --}}

                            <li class="dash-item dash-hasmenu {{ (Request::route()->getName() == 'print-setting' || Request::segment(1) == 'customer' || Request::segment(1) == 'vender' || Request::segment(1) == 'proposal' || Request::segment(1) == 'bank-account' || Request::segment(1) == 'bank-transfer' || Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note' || Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' ||
                                    Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type' || (Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance' || Request::segment(1) == 'goal' || Request::segment(1) == 'budget'|| Request::segment(1) ==
                                    'chart-of-account' || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance' || Request::segment(1) == 'bill' || Request::segment(1) == 'expense' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note')?' active dash-trigger':''}}">
                                <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-box"></i></span><span class="dash-mtext">{{__('Bursary')}}</span><span class="dash-arrow">
                                        <i data-feather="chevron-right"></i></span>
                                </a>
                                <ul class="dash-submenu">
                                    @can('show account overview')
                                        <li class="dash-item {{ ( Request::segment(1) == null || Request::segment(1) == 'account-dashboard') ? ' active' : '' }}">
                                            <a class="dash-link" href="{{route('account-dashboard')}}">{{__(' Overview')}}</a>
                                        </li>
                                    @endcan
                                    @can('show reports')
                                        {{-- @if( Gate::check('income report') || Gate::check('expense report') || Gate::check('income vs expense report') ||
                                            Gate::check('tax report')  || Gate::check('loss & profit report') || Gate::check('invoice report') ||
                                            Gate::check('bill report') || Gate::check('stock report') || Gate::check('invoice report') ||
                                            Gate::check('manage transaction')||  Gate::check('statement report')) --}}
                                        <li class="dash-item dash-hasmenu
                                            {{(Request::segment(1) == 'report'  || Request::segment(1) == 'reports-monthly-cashflow' || Request::segment(1) == 'reports-quarterly-cashflow')? 'active dash-trigger ' :''}}">

                                            <a class="dash-link" href="#">{{__('Reports')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                @can('statement report')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'report.account.statement') ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{route('report.account.statement')}}">{{__('Account Statement')}}</a>
                                                    </li>
                                                @endcan
                                                @can('invoice report')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'report.invoice.summary' ) ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{route('report.invoice.summary')}}">{{__('Invoice Summary')}}</a>
                                                    </li>
                                                @endcan
                                                @can('bill report')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'report.bill.summary' ) ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{route('report.bill.summary')}}">{{__('Bill Summary')}}</a>
                                                    </li>
                                                @endcan

                                                    @can('stock report')
                                                        <li class="dash-item {{ (Request::route()->getName() == 'report.product.stock.report' ) ? ' active' : '' }}">
                                                            <a href="{{route('report.product.stock.report')}}" class="dash-link">{{ __('Product Stock') }}</a>
                                                        </li>
                                                    @endcan
                                                @can('loss & profit report')
                                                        <li class="dash-item {{ request()->is('reports-monthly-cashflow') || request()->is('reports-quarterly-cashflow') ? 'active' : '' }}">
                                                            <a class="dash-link" href="{{route('report.monthly.cashflow')}}">{{__('Cash Flow')}}</a>
                                                        </li>
                                                @endcan
                                                @can('manage transaction')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'transaction.index' || Request::route()->getName() == 'transfer.create' || Request::route()->getName() == 'transaction.edit') ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{ route('transaction.index') }}">{{__('Transaction')}}</a>
                                                    </li>
                                                @endcan
                                                @can('income report')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'report.income.summary' ) ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{route('report.income.summary')}}">{{__('Income Summary')}}</a>
                                                    </li>
                                                @endcan
                                                    @can('expense report')
                                                        <li class="dash-item {{ (Request::route()->getName() == 'report.expense.summary' ) ? ' active' : '' }}">
                                                            <a class="dash-link" href="{{route('report.expense.summary')}}">{{__('Expense Summary')}}</a>
                                                        </li>
                                                    @endcan
                                                    @can('income vs expense report')
                                                        <li class="dash-item {{ (Request::route()->getName() == 'report.income.vs.expense.summary' ) ? ' active' : '' }}">
                                                            <a class="dash-link" href="{{route('report.income.vs.expense.summary')}}">{{__('Income VS Expense')}}</a>
                                                        </li>
                                                    @endcan
                                                @can('tax report')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'report.tax.summary' ) ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{route('report.tax.summary')}}">{{__('Tax Summary')}}</a>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </li>
                                        {{-- @endif --}}
                                    @endcan
                                    @can('show banking')
                                        {{-- @if( Gate::check('manage bank account') ||  Gate::check('manage bank transfer')) --}}
                                        <li class="dash-item dash-hasmenu {{(Request::segment(1) == 'bank-account' || Request::segment(1) == 'bank-transfer')? 'active dash-trigger' :''}}">
                                            <a class="dash-link" href="#">{{__('Banking')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                <li class="dash-item {{ (Request::route()->getName() == 'bank-account.index' || Request::route()->getName() == 'bank-account.create' || Request::route()->getName() == 'bank-account.edit') ? ' active' : '' }}">
                                                    <a class="dash-link" href="{{ route('bank-account.index') }}">{{__('Account')}}</a>
                                                </li>
                                                <li class="dash-item {{ (Request::route()->getName() == 'bank-transfer.index' || Request::route()->getName() == 'bank-transfer.create' || Request::route()->getName() == 'bank-transfer.edit') ? ' active' : '' }}">
                                                    <a class="dash-link" href="{{route('bank-transfer.index')}}">{{__('Transfer')}}</a>
                                                </li>
                                            </ul>
                                        </li>
                                        {{-- @endif --}}
                                    @endcan
                                    @can('show voucher')
                                        {{-- @if( Gate::check('manage invoice') ||  Gate::check('manage revenue') ||  Gate::check('manage credit note')) --}}
                                        <li class="dash-item dash-hasmenu {{(Request::segment(1) == 'customer' || Request::segment(1) == 'proposal'|| Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note')? 'active dash-trigger' :''}}">
                                            <a class="dash-link" href="#">{{__('Voucher')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                @if(Gate::check('manage customer'))
                                                    <li class="dash-item {{ (Request::segment(1) == 'customer')?'active':''}}">
                                                        <a class="dash-link" href="{{route('customer.index')}}">{{__('Customer')}}</a>
                                                    </li>
                                                @endif
                                                    @if(Gate::check('manage proposal'))
                                                        <li class="dash-item {{ (Request::segment(1) == 'proposal')?'active':''}}">
                                                            <a class="dash-link" href="{{ route('proposal.index') }}">{{__('Estimate')}}</a>
                                                        </li>
                                                    @endif
                                                <li class="dash-item {{ (Request::route()->getName() == 'invoice.index' || Request::route()->getName() == 'invoice.create' || Request::route()->getName() == 'invoice.edit' || Request::route()->getName() == 'invoice.show') ? ' active' : '' }}">
                                                    <a class="dash-link" href="{{ route('invoice.index') }}">{{__('Invoice/Voucher')}}</a>
                                                </li>
                                                <li class="dash-item {{ (Request::route()->getName() == 'revenue.index' || Request::route()->getName() == 'revenue.create' || Request::route()->getName() == 'revenue.edit') ? ' active' : '' }}">
                                                    <a class="dash-link" href="{{route('revenue.index')}}">{{__('Revenue')}}</a>
                                                </li>
                                                <li class="dash-item {{ (Request::route()->getName() == 'credit.note' ) ? ' active' : '' }}">
                                                    <a class="dash-link" href="{{route('credit.note')}}">{{__('Credit Note')}}</a>
                                                </li>
                                            </ul>
                                        </li>
                                        {{-- @endif --}}
                                    @endcan
                                    @can('show purchases')
                                        {{-- @if( Gate::check('manage bill')  ||  Gate::check('manage payment') ||  Gate::check('manage debit note')) --}}
                                        <li class="dash-item dash-hasmenu {{(Request::segment(1) == 'bill'  || Request::segment(1) == 'vender' ||  Request::segment(1) == 'expense' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note')? 'active dash-trigger' :''}}">
                                            <a class="dash-link" href="#">{{__('Purchases')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                @if(Gate::check('manage vender'))
                                                    <li class="dash-item {{ (Request::segment(1) == 'vender')?'active':''}}">
                                                        <a class="dash-link" href="{{ route('vender.index') }}">{{__('Suppiler')}}</a>
                                                    </li>
                                                @endif
                                                <li class="dash-item {{ (Request::route()->getName() == 'bill.index' || Request::route()->getName() == 'bill.create' || Request::route()->getName() == 'bill.edit' || Request::route()->getName() == 'bill.show') ? ' active' : '' }}">
                                                    <a class="dash-link" href="{{ route('bill.index') }}">{{__('Bill')}}</a>
                                                </li>
                                                    <li class="dash-item {{ (Request::route()->getName() == 'expense.index' || Request::route()->getName() == 'expense.create' || Request::route()->getName() == 'expense.edit' || Request::route()->getName() == 'expense.show') ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{ route('expense.index') }}">{{__('Expense')}}</a>
                                                    </li>
                                                <li class="dash-item {{ (Request::route()->getName() == 'payment.index' || Request::route()->getName() == 'payment.create' || Request::route()->getName() == 'payment.edit') ? ' active' : '' }}">
                                                    <a class="dash-link" href="{{route('payment.index')}}">{{__('Payment')}}</a>
                                                </li>
                                                <li class="dash-item  {{ (Request::route()->getName() == 'debit.note' ) ? ' active' : '' }}">
                                                    <a class="dash-link" href="{{route('debit.note')}}">{{__('Debit Note')}}</a>
                                                </li>
                                            </ul>
                                        </li>
                                        {{-- @endif --}}
                                    @endcan

                                    {{-- @if( Gate::check('manage chart of account') ||  Gate::check('manage journal entry') ||   Gate::check('balance sheet report') ||  Gate::check('ledger report') ||  Gate::check('trial balance report')) --}}
                                    @can('show double entry')
                                        <li class="dash-item dash-hasmenu {{(Request::segment(1) == 'chart-of-account' || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance')? 'active dash-trigger' :''}}">
                                            <a class="dash-link" href="#">{{__('Double Entry')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                @can('show chart of account')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'chart-of-account.index' || Request::route()->getName() == 'chart-of-account.show') ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{ route('chart-of-account.index') }}">{{__('Chart of Accounts')}}</a>
                                                    </li>
                                                @endcan
                                                @can('show journal')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'journal-entry.edit' || Request::route()->getName() == 'journal-entry.create' || Request::route()->getName() == 'journal-entry.index' || Request::route()->getName() == 'journal-entry.show') ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{ route('journal-entry.index') }}">{{__('Journal Account')}}</a>
                                                    </li>
                                                @endcan
                                                @can('show ledger')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'report.ledger' ) ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{route('report.ledger')}}">{{__('Ledger Summary')}}</a>
                                                    </li>
                                                @endcan
                                                @can('show balance sheet')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'report.balance.sheet' ) ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{route('report.balance.sheet')}}">{{__('Balance Sheet')}}</a>
                                                    </li>
                                                @endcan
                                                @can('show profit and loss')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'report.profit.loss' ) ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{route('report.profit.loss')}}">{{__('Profit & Loss')}}</a>
                                                    </li>
                                                @endcan
                                                @can('trial balance')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'trial.balance' ) ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{route('trial.balance')}}">{{__('Trial Balance')}}</a>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </li>
                                    @endcan
                                        {{-- @endif --}}
                                    @can('show budget planner')
                                        <li class="dash-item {{ (Request::segment(1) == 'budget')?'active':''}}">
                                            <a class="dash-link" href="{{ route('budget.index') }}">{{__('Budget Planner')}}</a>
                                        </li>
                                    @endcan
                                    @can('show financial goal')
                                        <li class="dash-item {{ (Request::segment(1) == 'goal')?'active':''}}">
                                            <a class="dash-link" href="{{ route('goal.index') }}">{{__('Financial Goal')}}</a>
                                        </li>
                                    @endcan
                                    @can('show accounting setup')
                                        <li class="dash-item {{(Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')? 'active dash-trigger' :''}}">
                                            <a class="dash-link" href="{{ route('taxes.index') }}">{{__('Accounting Setup')}}</a>
                                        </li>
                                    @endcan
                                    @can('show print setup')
                                        <li class="dash-item {{ (Request::route()->getName() == 'print-setting') ? ' active' : '' }}">
                                            <a class="dash-link" href="{{ route('print.setting') }}">{{__('Print Settings')}}</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        {{-- @endif --}}
                        {{-- @endif --}}
                    @endcan
                    @if(\Auth::user()->show_project() == 1)
                        @if( Gate::check('manage project'))
                            <li class="dash-item dash-hasmenu {{Request::segment(1) == 'physical-planning/projects' || request()->is('physical-planning/projects/*') ? 'active' : ''}}">
                                <a href="#!" class="dash-link"
                                ><span class="dash-micon"><i class="ti ti-list"></i></span
                                    ><span class="dash-mtext">{{__('PM/PP')}}</span
                                    ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                    ></a>
                                    <ul class="dash-submenu">
                                        @can('manage project')
                                            <li class="dash-item  {{Request::segment(1) == 'physical-planning/projects' || request()->is('physical-planning/projects/*') ? 'active' : ''}}">
                                                <a class="dash-link" href="{{ route('pp.projects')}}">{{__('Projects')}}</a>
                                            </li>
                                            <li class="dash-item  {{Request::segment(1) == 'physical-planning/projects' || request()->is('physical-planning/projects/*') ? 'active' : ''}}">
                                                <a class="dash-link" href="{{ route('pp.ergp')}}">{{__('ERGP')}}</a>
                                            </li>
                                            <li class="dash-item {{ (Request::route()->getName() == 'clients.index' || Request::segment(1) == 'clients' || Request::route()->getName() == 'clients.edit') ? ' active' : '' }}">
                                                <a class="dash-link" href="{{ route('project.contractors') }}">{{__('Contractors')}}</a>
                                            </li>
                                            @can('manage contract')
                                                <li class="dash-item  {{ (Request::segment(1) == 'contract')?'active':''}}">
                                                    <a class="dash-link" href="{{route('project.contracts')}}">{{__('Contracts')}}</a>
                                                </li>
                                            @endcan
                                        @endcan


                                    </ul>
                            </li>
                        @endif
                    @endif

                    {{-- @if(\Auth::user()->show_project() == 1)
                        @if( Gate::check('manage project'))
                            <li class="dash-item dash-hasmenu ">
                                <a href="#!" class="dash-link"
                                ><span class="dash-micon"><i class="ti ti-share"></i></span
                                    ><span class="dash-mtext">{{__('PM/PP')}}</span
                                    ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                    ></a>
                                <ul class="dash-submenu">
                                    @can('manage project')
                                        <li class="dash-item  {{Request::segment(1) == 'project' || Request::route()->getName() == 'projects.list' || Request::route()->getName() == 'projects.list' ||Request::route()->getName() == 'projects.index' || Request::route()->getName() == 'projects.show' || request()->is('projects/*') ? 'active' : ''}}">
                                            <a class="dash-link" href="{{route('projects.index')}}">{{__('Projects')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage client')
                                        <li class="dash-item {{ (Request::route()->getName() == 'clients.index' || Request::segment(1) == 'clients' || Request::route()->getName() == 'clients.edit') ? ' active' : '' }}">
                                            <a class="dash-link" href="{{ route('clients.index') }}">{{__('Contractor')}}</a>
                                        </li>
                                    @endcan
                                    @if(\Auth::user()->type=='super admin')
                                        <li class="dash-item  {{ (Request::segment(1) == 'contract')?'active':''}}">
                                            <a class="dash-link" href="{{route('contract.index')}}">{{__('Contract')}}</a>
                                        </li>
                                    @endif
                                    <!-- @can('manage project task')
                                        <li class="dash-item {{ (request()->is('taskboard*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{ route('taskBoard.view', 'list') }}">{{__('Tasks')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage timesheet')
                                        <li class="dash-item {{ (request()->is('timesheet-list*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{route('timesheet.list')}}">{{__('Timesheet')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage project task')
                                        <li class="dash-item {{ (request()->is('calendar*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{ route('task.calendar',['all']) }}">{{__('Task Calendar')}}</a>
                                        </li>
                                    @endcan -->
                                    @if(\Auth::user()->type!='super admin')
                                        <li class="dash-item  {{ (Request::segment(1) == 'time-tracker')?'active open':''}}">
                                            <a class="dash-link" href="{{ route('time.tracker') }}">{{__('Tracker')}}</a>
                                        </li>
                                    @endif
                                    @if (\Auth::user()->type == 'super admin')
                                        <li class="dash-item  {{(Request::route()->getName() == 'project_report.index' || Request::route()->getName() == 'project_report.show') ? 'active' : ''}}">
                                            <a class="dash-link" href="{{route('project_report.index') }}">{{__('Project Report')}}</a>
                                        </li>
                                    @endif
                                    <!-- @if(Gate::check('manage project task stage') || Gate::check('manage bug status'))
                                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'bugstatus' || Request::segment(1) == 'project-task-stages') ? 'active dash-trigger' : ''}}">
                                            <a class="dash-link" href="#">{{__('Project System Setup')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                @can('manage project task stage')
                                                    <li class="dash-item  {{ (Request::route()->getName() == 'project-task-stages.index') ? 'active' : '' }}">
                                                        <a class="dash-link" href="{{route('project-task-stages.index')}}">{{__('Project Task Stages')}}</a>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </li>
                                    @endif -->
                                </ul>
                            </li>
                        @endif
                    @endif --}}
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'memos' || Request::segment(1) == 'files'
                            || Request::segment(1) == 'folders'  || Request::segment(1) == 'archived')?' active dash-trigger':''}}">
                        <a href="#!" class="dash-link active dash-trigger"
                        ><span class="dash-micon"><i class="ti ti-files"></i></span
                            ><span class="dash-mtext">{{__('Document Mgt')}}</span
                            ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                            ></a>
                            <ul class="dash-submenu">
                                <li class="dash-item">
                                    <a class="dash-link" href="{{ route('memos.index') }}">{{__('Memo/Letters')}}</a>
                                </li>
                                <li class="dash-item dash-hasmenu  {{ (Request::segment(1) == 'leave' || Request::segment(1) == 'attendanceemployee') ? 'active dash-trigger' :''}}">
                                    <a class="dash-link" href="#">{{__('Files/Documents')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">
                                        @canany(['view department folders', 'view unit folders'])
                                            <li class="dash-item">
                                                <a class="dash-link" href="{{ route('folders.index') }}">{{__('Document Folders')}}</a>
                                            </li>
                                        @endcanany

                                        @canany(['view department documents', 'view unit documents'])
                                            <li class="dash-item">
                                                <a class="dash-link" href="{{ route('file.index') }}">{{__('Documents')}}</a>
                                            </li>
                                            <li class="dash-item ">
                                                <a class="dash-link" href={{ route('sharedfiles.index') }}>{{__('Shared')}}</a>
                                            </li>
                                            <li class="dash-item ">
                                                <a class="dash-link" href="{{ route('files.archived') }}">{{__('Archived')}}</a>
                                            </li>
                                        @endcanany
                                    </ul>
                                </li>
                                @can('manage document')
                                    <li class="dash-item {{ (request()->is('document-upload*') ? 'active' : '')}}">
                                        <a class="dash-link" href="{{route('document-upload.index')}}">{{__('Document Setup')}}</a>
                                    </li>
                                @endcan
                            </ul>
                    </li>
                    @if( Gate::check('manage product & service') || Gate::check('manage product & service'))
                        <li class="dash-item dash-hasmenu">
                            <a href="#!" class="dash-link ">
                                <span class="dash-micon"><i class="ti ti-shopping-cart"></i></span><span class="dash-mtext">{{__('Inventory Mgt')}}</span><span class="dash-arrow">
                                        <i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="dash-submenu">
                                @if(Gate::check('manage stock') || Gate::check('view stock') || Gate::check('manage stock'))
                                    <li class="dash-item {{ (Request::segment(1) == 'productservice')?'active':''}}">
                                        <a href="{{ route('store-records') }}" class="dash-link">{{__('Assets/Store')}}
                                        </a>
                                    </li>
                                @endif
                                @can('manage warehouse')
                                 <!---   <li class="dash-item {{ (Request::route()->getName() == 'goodsReceived.list' || Request::route()->getName() == 'warehouse.show') ? ' active' : '' }}">
                                        <a class="dash-link" href="{{ route('goodsReceived.list') }}">{{__('Goods Recieved Notes')}}</a>
                                    </li>   --->
                                @endcan
                            @can('manage pos')
                          <!---      <li class="dash-item {{ (Request::route()->getName() == 'pos.index' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{  ('pos.index') }}">{{__(' Add Assets')}}</a>
                                </li>   --->

                             <!---   <li class="dash-item {{ (Request::route()->getName() == 'pos.report' || Request::route()->getName() == 'pos.show') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('pos.report') }}">{{__('Stock/Inventory')}}</a>
                                </li> ---->
                            @endcan
                                @can('manage warehouse')
                                    <li class="dash-item {{ (Request::route()->getName() == 'warehouse-transfer.index' || Request::route()->getName() == 'warehouse-transfer.show') ? ' active' : '' }}">
                                        <a class="dash-link" href="{{ route('warehouse-transfer.index') }}">{{__('Transfer')}}</a>
                                    </li>
                                @endcan
                            @can('create barcode')
                                <li class="dash-item {{ (Request::route()->getName() == 'pos.barcode'  || Request::route()->getName() == 'pos.print') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('pos.barcode') }}">{{__('Print Barcode')}}</a>
                                </li>
                            @endcan
                            @can('manage pos')
                                <li class="dash-item {{ (Request::route()->getName() == 'pos-print-setting') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('pos.print.setting') }}">{{__('Print Settings')}}</a>
                                </li>
                            @endcan
                            </ul>
                        </li>
                        @can('manage budgets')
                            <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'chats')?'active':''}}">
                                <a href="{{ route('hrm.budget') }}" class="dash-link">
                                    <span class="dash-micon"><i class="ti ti-cast"></i></span><span class="dash-mtext">{{__('Budgets')}}</span>
                                </a>
                            </li>
                        @endcan
                    @endif

                    @if(\Auth::user()->type == 'liason office head' || \Auth::user()->type == 'unit head')
                        @can('create budget plan')
                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'chats')?'active':''}}">
                            <a href="{{ route('budget.create')}}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-list"></i></span><span class="dash-mtext">{{__('Set Budget')}}</span>
                            </a>
                        </li>
                        @endcan

                        @can('view budget plan')
                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'chats')?'active':''}}">
                            <a href="{{ route('budget.index')}}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-list"></i></span><span class="dash-mtext">{{__('View Budget')}}</span>
                            </a>
                        </li>
                        @endcan
                    @endif
                    <ul class="dash-navbar">
                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'users' || Request::segment(1) == 'roles'
                            || Request::segment(1) == 'clients'  || Request::segment(1) == 'userlogs')?' active dash-trigger':''}}">
                            <a href="#!" class="dash-link {{ (Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'clients')?' active dash-trigger':''}}"
                            ><span class="dash-micon"><i class="ti ti-repeat"></i></span
                                ><span class="dash-mtext">{{__('Internal Process')}}</span
                                ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                ></a>
                            <ul class="dash-submenu">
                                @if( Gate::check('manage leave') || Gate::check('manage attendance') || Gate::check('approve leave'))
                                    <li class="dash-item dash-hasmenu  {{ (Request::segment(1) == 'leave' || Request::segment(1) == 'attendanceemployee') ? 'active dash-trigger' :''}}">
                                        <a class="dash-link" href="#">{{__('Leave Management')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            @can('manage leave')
                                                <li class="dash-item {{ (Request::route()->getName() == 'leave.index') ?'active' :''}}">
                                                    <a class="dash-link" href="{{route('leave.index')}}">{{__('Manage Leave')}}</a>
                                                </li>
                                            @endcan
                                            @can('approve leave')
                                                <li class="dash-item {{ (Request::route()->getName() == 'leave.index') ?'active' :''}}">
                                                    <a class="dash-link" href="{{route('approvals.index')}}">{{__('Pending Leaves')}}</a>
                                                </li>
                                            @endcan
                                            <li class="dash-item {{ (Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit' || Request::route()->getName() == 'user.userlog') ? ' active' : '' }}">
                                                <a class="dash-link" href="{{ route('hrm.leave') }}">{{__('Leave')}}</a>
                                            </li>
                                            @if(\Auth::user()->type == 'super admin' || \Auth::user()->type == 'liason office head' || \Auth::user()->type == 'hod' || \Auth::user()->type == 'client')
                                                @can('view leave report')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{ route('report.leave') }}">{{__('Leave Report')}}</a>
                                                    </li>
                                                @endcan
                                            @endif
                                        </ul>
                                    </li>
                                @else
                                <li class="dash-item {{ (Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit' || Request::route()->getName() == 'user.userlog') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('hrm.leave') }}">{{__('Leave')}}</a>
                                </li>
                                @endif
                                @can('manage attendance')
                                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'attendanceemployee') ? 'active dash-trigger' : ''}}" href="#navbar-attendance" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'attendanceemployee') ? 'true' : 'false'}}">
                                        <a class="dash-link" href="#">{{__('Attendance')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            @if (\Auth::user()->cannot('manage report') && \Auth::user()->cannot('manage attendance report'))
                                                <li class="dash-item {{ (Request::route()->getName() == 'attendanceemployee.index' ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{route('attendanceemployee.index')}}">{{__('Mark Attendance')}}</a>
                                                </li>
                                            @endif
                                                {{-- <li class="dash-item {{ (Request::route()->getName() == 'attendanceemployee.bulkattendance' ? 'active' : '')}}">
                                                    <a class="dash-link" href="{{ route('attendanceemployee.bulkattendance') }}">{{__('Bulk Attendance')}}</a>
                                                </li> --}}
                                            @can('create attendance')
                                                <li class="dash-item {{ request()->is('reports-monthly-attendance') ? 'active' : '' }}">
                                                    <a class="dash-link" href="{{ route('report.monthly.attendance') }}">{{ __('Monthly Attendance') }}</a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcan
                                <li class="dash-item dash-hasmenu  ">
                                    <a class="dash-link" href="#">{{__('DTA Management')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">
                                        <li class="dash-item {{ (Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : '' }} ">
                                            <a class="dash-link" href="{{ route('dta.index') }}">{{__('DTA')}}</a>
                                        </li>
                                        @can('report view')
                                            <li class="dash-item {{ (Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : '' }}">
                                                <a class="dash-link" href="{{ route('reports.dta') }}">{{__('DTA Report')}}</a>
                                            </li>
                                        @endcan
                                        @can('unit head approve')
                                            <li class="dash-item {{ request()->is('dtaApproval.unit-head') ? 'active' : '' }}">
                                                <a class="dash-link" href="{{ route('dtaApproval.unit-head') }}">{{__('Unit Head Approval')}}</a>
                                            </li>
                                        @endcan
                                        @can('hod approve')
                                            <li class="dash-item {{ request()->is('dtaApproval.hod') ? 'active' : '' }}">
                                                <a class="dash-link" href="{{ route('dtaApproval.hod') }}">{{__('HOD Approval')}}</a>
                                            </li>
                                        @endcan

                                        @can('liaison approve')
                                            <li class="dash-item {{ request()->is('dtaApproval.liason') ? 'active' : '' }}">
                                                <a class="dash-link" href="{{ route('dtaApproval.liason') }}">{{__('Liason Head Approval')}}</a>
                                            </li>
                                        @endcan

                                        @can('special duty approve')
                                            <li class="dash-item {{ request()->is('dtaApproval.specialDuty') ? 'active' : '' }}">
                                                <a class="dash-link" href="{{ route('dtaApproval.specialDuty') }}">{{__('Special Duty Approval')}}</a>
                                            </li>
                                        @endcan

                                        @can('dg approve')
                                            <li class="dash-item {{ request()->is('dtaApproval.dg') ? 'active' : '' }}">
                                                <a class="dash-link" href="{{ route('dtaApproval.dg') }}">{{__('DG Approval')}}</a>
                                            </li>
                                        @endcan
                                        @can('bursar approve')
                                            <li class="dash-item {{ request()->is('dtaApproval.bursar') ? 'active' : '' }}">
                                                <a class="dash-link" href="{{ route('dtaApproval.bursar') }}">{{__('Bursar Approval')}}</a>
                                            </li>
                                        @endcan
                                        @can('pv approve')
                                            <li class="dash-item {{ request()->is('dtaApproval.pv') ? 'active' : '' }}">
                                                <a class="dash-link" href="{{ route('dtaApproval.pv') }}">{{__('PV Approval')}}</a>
                                            </li>
                                        @endcan
                                        @can('audit approve')
                                            <li class="dash-item {{ request()->is('dtaApproval.audit') ? 'active' : '' }}">
                                                <a class="dash-link" href="{{ route('dtaApproval.audit') }}">{{__('Audit Approval')}}</a>
                                            </li>
                                        @endcan
                                        @can('final account approve')
                                            <li class="dash-item {{ request()->is('dtaApproval.cash') ? 'active' : '' }}">
                                                <a class="dash-link" href="{{ route('dtaApproval.cash') }}">{{__('Cash Office Approval')}}</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                                <li class="dash-item dash-hasmenu  ">
                                    <a class="dash-link" href="#">{{__('Query Management')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">
                                        @can('raise query')
                                            <li class="dash-item {{ (Request::route()->getName() == 'clients.index' || Request::segment(1) == 'clients' || Request::route()->getName() == 'clients.edit') ? ' active' : '' }}">
                                                <a class="dash-link" href="{{ route('hrm.query') }}">{{__('Raise Query')}}</a>
                                            </li>
                                        @endcan

                                        <li class="dash-item {{ (Request::route()->getName() == 'clients.index' || Request::segment(1) == 'clients' || Request::route()->getName() == 'clients.edit') ? ' active' : '' }}">
                                            <a class="dash-link" href="{{ route('query.index') }}">{{__('Queries')}}</a>
                                        </li>

                                        @can('raise query')
                                            <li class="dash-item {{ (Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : '' }}">
                                                <a class="dash-link" href="{{ route('report.leave') }}">{{__('Query Report')}}</a>
                                            </li>
                                        @endcan
                                        {{-- @can('manage complaint')
                                            <li class="dash-item {{ (request()->is('complaint*') ? 'active' : '')}}">
                                                <a class="dash-link" href="{{route('complaint.index')}}">{{__('Complaints')}}</a>
                                            </li>
                                        @endcan
                                        @can('manage warning')
                                            <li class="dash-item {{ (request()->is('warning*') ? 'active' : '')}}">
                                                <a class="dash-link" href="{{route('warning.index')}}">{{__('Warning')}}</a>
                                            </li>
                                        @endcan --}}
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <li class="dash-item dash-hasmenu">
                        <a href="#!" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-shopping-cart"></i></span><span class="dash-mtext">{{__('Supply Chain')}}</span><span class="dash-arrow">
                                    <i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu">
                            @can('view item supply')
                                <li class="dash-item {{ (Request::route()->getName() == 'store.dashboard' || Request::route()->getName() == 'warehouse.show') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('supplies.projects')}}">{{__('Supply')}}</a>
                                </li>
                            @endcan

                            <li class="dash-item {{ (Request::route()->getName() == 'itemRequisition.index' || Request::route()->getName() == 'purchase.show') ? ' active' : '' }}">
                                <a class="dash-link" href="{{ route('itemRequisition.index') }}">{{__('Store Requisition Note')}}</a>
                            </li>

                            @can('hod approve SRN')
                                <li class="dash-item {{ (Request::route()->getName() == 'itemRequisition.hodApproval' || Request::route()->getName() == 'purchase.show') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('itemRequisition.hodApproval') }}">{{__('HoD SRN approval')}}</a>
                                </li>
                            @endcan
                            @can('liaison approve SRN')
                                <li class="dash-item {{ (Request::route()->getName() == 'itemRequisition.liaisonApproval' || Request::route()->getName() == 'purchase.show') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('itemRequisition.liaisonApproval') }}">{{__('Liaison SRN approval')}}</a>
                                </li>
                            @endcan
                            @can('bursar approve SRN')
                                <li class="dash-item {{ (Request::route()->getName() == 'itemRequisition.bursarApproval' || Request::route()->getName() == 'purchase.show') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('itemRequisition.bursarApproval') }}">{{__('Bursar SRN approval')}}</a>
                                </li>
                            @endcan
                            @can('store approve SRN')
                            <li class="dash-item {{ (Request::route()->getName() == 'itemRequisition.storeApproval' || Request::route()->getName() == 'purchase.show') ? ' active' : '' }}">
                                <a class="dash-link" href="{{ route('itemRequisition.storeApproval') }}">{{__('Store SRN Approval')}}</a>
                            </li>
                            @endcan

                            <li class="dash-item {{ (Request::route()->getName() == 'itemRequisition.acknowledgment' || Request::route()->getName() == 'purchase.show') ? ' active' : '' }}">
                                <a class="dash-link" href="{{ route('itemRequisition.acknowledgment') }}">{{__('Store Issue Voucher')}}</a>
                            </li>

                            @can('request purchase requisition')
                                <li class="dash-item {{ (Request::route()->getName() == 'req.list' || Request::route()->getName() == 'purchase.create' || Request::route()->getName() == 'purchase.edit' || Request::route()->getName() == 'purchase.show') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('purchase.requisition')}}">{{__('Purchase requisition')}}</a>
                                </li>
                            @endcan

                            <li class="dash-item {{ (Request::route()->getName() == 'goodsReceived.list' || Request::route()->getName() == 'warehouse.show') ? ' active' : '' }}">
                                <a class="dash-link" href="{{ route('goodsReceived.list') }}">{{__('Goods Recieved Notes')}}</a>
                            </li>

                            {{-- <li class="dash-item {{ (Request::route()->getName() == 'storeVoucher.list' || Request::route()->getName() == 'warehouse.show') ? ' active' : '' }}">
                                <a class="dash-link" href="{{ route('storeVoucher.list') }}">{{__('Store Issue Voucher')}}</a>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'procurement')?'active':''}}">
                        <a href="" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-pulse"></i></span><span class="dash-mtext">{{__('Risk Mgt')}}</span>
                        </a>
                    </li>
                    <li class="dash-item dash-hasmenu ">
                        <a href="#!" class="dash-link {{ (Request::segment(1) == 'business')?'active':'' }}"
                        ><span class="dash-micon"><i class="ti ti-home"></i></span
                            ><span class="dash-mtext">{{__('Business Intelligence')}}</span
                            ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                            ></a>
                        <ul class="dash-submenu">
                            <li class="dash-item {{ request()->is('business-dashboard') ? 'active' : '' }}">
                                <a class="dash-link" href="{{ route('business-dashboard') }}">{{__('Analytics')}}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'deals' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'contract') ?' active dash-trigger':''}}">
                        <a href="#!" class="dash-link"
                        ><span class="dash-micon"><i class="ti ti-layers-difference"></i></span
                            ><span class="dash-mtext">{{__('MRM System')}}</span
                            ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                            ></a>
                        <ul class="dash-submenu {{ (Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'deals' || Request::segment(1) == 'pipelines')?'show':''}}">
                            <li class="dash-item {{ (\Request::route()->getName()=='crm.dashboard') ? ' active' : '' }}">
                                <a class="dash-link" href="{{route('crm.dashboard')}}">{{__(' Overview')}}</a>
                            </li>
                            <li class="dash-item dash-hasmenu {{ ( Request::segment(1) == 'reports-lead' || Request::segment(1) == 'reports-deal') ? 'active dash-trigger' : ''}}"
                                href="#crm-report" data-toggle="collapse" role="button"
                                aria-expanded="{{( Request::segment(1) == 'reports-lead' || Request::segment(1) == 'reports-deal') ? 'true' : 'false'}}">
                                <a class="dash-link" href="#">{{__('Reports')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                <ul class="dash-submenu">
                                    <li class="dash-item {{ request()->is('reports-lead') ? 'active' : '' }}">
                                        <a class="dash-link" href="{{ route('report.lead') }}">{{__('Lead')}}</a>
                                    </li>
                                    <li class="dash-item {{ request()->is('reports-deal') ? 'active' : '' }}">
                                        <a class="dash-link" href="{{ route('report.deal') }}">{{__('Deal')}}</a>
                                    </li>
                                </ul>
                            </li>
                            @can('manage lead')
                                <li class="dash-item {{ (Request::route()->getName() == 'leads.list' || Request::route()->getName() == 'leads.index' || Request::route()->getName() == 'leads.show') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('leads.index') }}">{{__('Leads')}}</a>
                                </li>
                            @endcan
                            @can('manage deal')
                                <li class="dash-item {{ (Request::route()->getName() == 'deals.list' || Request::route()->getName() == 'deals.index' || Request::route()->getName() == 'deals.show') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('deals.index')}}">{{__('Deals')}}</a>
                                </li>
                            @endcan
                            @if(Gate::check('manage lead stage') || Gate::check('manage pipeline') ||Gate::check('manage source') ||Gate::check('manage label') || Gate::check('manage stage'))
                                <li class="dash-item  {{(Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')? 'active dash-trigger' :''}}">
                                    <a class="dash-link" href="{{ route('pipelines.index') }}   ">{{__('MRM System Setup')}}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'support')?'active':''}}">
                        <a href="{{route('support.index')}}" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-headphones"></i></span><span class="dash-mtext">{{__('Servicom')}}</span>
                        </a>
                    </li>
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'zoom-meeting' || Request::segment(1) == 'zoom-meeting-calender')?'active':''}}">
                        <a href="{{route('zoom-meeting.index')}}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-user-check"></i></span><span class="dash-mtext">{{__('Zoom Meeting')}}</span>
                        </a>
                    </li>
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'chats')?'active':''}}">
                        <a href="{{ url('chats') }}" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-message-circle"></i></span><span class="dash-mtext">{{__('Messenger')}}</span>
                        </a>
                    </li>
                </ul>
            {{-- @endif --}}
            {{-- @endif --}}
            @endif
        </div>
    </div>
</nav>
