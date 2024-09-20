<div class="col-xxl-6">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <a href="{{ route('hrm.budget') }}">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-cast"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="m-0">{{ __('Departmental Budget') }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- <div class="col-auto text-end">
                                <h5 class="m-0">{{ $arrCount['deal'] }}</h5>
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
                            <a href="{{ route('hrm.query') }}">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-list"></i>
                                    </div>
                                    <div class="ms-3">
                                        {{-- <small class="text-muted">{{__('Total')}}</small> --}}
                                        <h6 class="m-0">{{ __('Query') }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- <div class="col-auto text-end">
                                                <h5 class="m-0">{{ $arrCount['task'] }}</h5>
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
                            <a href="{{ route('hrm.leave') }}">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-list"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="m-0">{{ __('Leave') }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- <div class="col-auto text-end">
                                <h5 class="m-0">{{ $arrCount['task'] }}</h5>
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
                           <a href="{{ route('hrm.dta') }}">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-list"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="m-0">{{ __('DTA') }}</h6>
                                </div>
                            </div>
                           </a>
                        </div>
                        {{-- <div class="col-auto text-end">
                                <h5 class="m-0">{{ $arrCount['task'] }}</h5>
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
                            <a href="{{ route('hrm.memo') }}">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-list"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="m-0">{{ __('Memo') }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- <div class="col-auto text-end">
                                <h5 class="m-0">{{ $arrCount['task'] }}</h5>
                            </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
