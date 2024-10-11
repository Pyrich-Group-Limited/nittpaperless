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
        <div class="navbar-content">

                <ul class="dash-navbar">
                                      
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'contractor/dashboard')?'active':''}}">
                        <a href="{{route('contractor.dashboard')}}" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-home"></i></span><span class="dash-mtext">{{__('Dasboard')}}</span>
                        </a>
                    </li>
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'stages' || Request::segment(1) == 'contract') ?' active dash-trigger':''}}">
                        <a href="#!" class="dash-link"
                        ><span class="dash-micon"><i class="ti ti-layers-difference"></i></span
                            ><span class="dash-mtext">{{__('Contractors')}}</span
                            ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                            ></a>
                        <ul class="dash-submenu {{ (Request::segment(1) == 'deals' || Request::segment(1) == 'pipelines')?'show':''}}">
                            <li class="dash-item {{ (\Request::route()->getName()=='crm.dashboard') ? ' active' : '' }}">
                                <a class="dash-link" href="{{route('crm.dashboard')}}">{{__(' Overview')}}</a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
        </div>
    </div>
</nav>
