@extends('layouts.admin')
@section('page-title')
    {{__('Dashboard')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Liason office head')}}</li>
@endsection


@section('content')
<div class="col-sm-12">
    <div class="row">
        <div class="col-xxl-6">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-hand-finger"></i>
                                        </div>
                                        <div class="ms-3">
                                            {{-- <small class="text-muted">{{ __('Total') }}</small> --}}
                                            <h6 class="m-0">{{ __('Set Budget') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-auto text-end">
                                    <h4 class="m-0">0</h4>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-warning">
                                            <i class="ti ti-chart-pie"></i>
                                        </div>
                                        <div class="ms-3">
                                            {{-- <small class="text-muted">{{ __('Total') }}</small> --}}
                                            <h6 class="m-0">{{ __('Leave Requests') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-auto text-end">
                                    <h4 class="m-0">0</h4>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-report-money"></i>
                                        </div>
                                        <div class="ms-3">
                                            {{-- <small class="text-muted">{{ __('Total') }}</small> --}}
                                            <h6 class="m-0">{{ __('DTA') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-auto text-end">
                                    <h4 class="m-0">0</h4> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-chart-bar"></i>
                                        </div>
                                        <div class="ms-3">
                                            {{-- <small class="text-muted">{{ __('Total') }}</small> --}}
                                            <h6 class="m-0">{{ __(' Query') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-auto text-end">
                                    <h4 class="m-0">0</h4>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-chart-bar"></i>
                                        </div>
                                        <div class="ms-3">
                                            {{-- <small class="text-muted">{{ __('Total') }}</small> --}}
                                            <h6 class="m-0">{{ __(' Memo') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-auto text-end">
                                    <h4 class="m-0">0</h4>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ __('Calendar') }}</h5>
                        </div>
                        <div class="card-body">
                            <div id='calendar' class='calendar'></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
