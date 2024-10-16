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
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'contractor/dashboard')?'active':''}}">
                        <a href="{{route('contractor.advert')}}" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-notification"></i></span><span class="dash-mtext">{{__('Advert')}}</span>
                        </a>
                    </li>
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'contractor/document')?'active':''}}">
                        <a href="{{route('contractor.document')}}" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-folder"></i></span><span class="dash-mtext">{{__('Documents')}}</span>
                        </a>
                    </li>
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'contractor/applications')?'active':''}}">
                        <a href="{{route('contractor.applications')}}" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-edit"></i></span><span class="dash-mtext">{{__('My Applications')}}</span>
                        </a>
                    </li>
                </ul>
        </div>
    </div>
</nav>
