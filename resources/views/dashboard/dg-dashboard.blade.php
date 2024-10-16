@extends('layouts.admin')
@section('page-title')
    {{ 'Dashboard' . ' - ' . ' ' . Ucfirst(Auth::user()->type) }}
@endsection

@push('theme-script')
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
@endpush
@push('script-page')
    <script>
        (function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    name: '{{ __('Purchase') }}',
                    data: {!! json_encode($purchasesArray['value']) !!}
                    // data:  [70,270,80,245,115,260,135,280,70,215]

                },
                    {
                        name: '{{ __('POS') }}',
                        data: {!! json_encode($posesArray['value']) !!}

                        // data:  [100,300,100,260,140,290,150,300,100,250]

                    },
                ],
                xaxis: {
                    categories: {!! json_encode($purchasesArray['label']) !!},
                    title: {
                        text: '{{ __('Days') }}'
                    }
                },
                colors: ['#ff3a6e', '#0C7885'],

                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                },
                markers: {
                    size: 4,
                    colors: ['#ffa21d', '#FF3A6E'],
                    opacity: 0.9,
                    strokeWidth: 2,
                    hover: {
                        size: 7,
                    }
                },
                yaxis: {
                    title: {
                        text: '{{ __('Amount') }}'
                    },
                }
            };
            var chart = new ApexCharts(document.querySelector("#traffic-chart"), options);
            chart.render();
        })();

    </script>
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><b>Welcome </b>{{ Ucfirst(Auth::user()->name) }}
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <a href="{{ route('dta.index') }}">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center mb-3 mt-3">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-users"></i>
                                </div>
                                <div class="ms-3 mb-3 mt-3">
                                    <h6 class="ml-4">{{ __('DTA') }}</h6>
                                </div>
                            </div>
                            <h3 class="ms-4">{{ $dta->count() }}</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <a href="{{ route('hrm.leave') }}">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center mb-3 mt-3">
                                <div class="theme-avtar bg-warning">
                                    <i class="ti ti-shopping-cart"></i>
                                </div>
                                <div class="ms-3 mb-3 mt-3">
                                    <h6 class="ml-4">{{ __('Leave') }}</h6>
                                </div>
                            </div>
                            <h3 class="ms-4">{{ $leave->count() }}</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <a href="#">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center mb-3 mt-3">
                                <div class="theme-avtar bg-info">
                                    <i class="ti ti-trophy"></i>
                                </div>
                                <div class="ms-3 mb-3 mt-3">
                                    <h6 class="ml-4">{{ __('Budget') }}</h6>
                                </div>
                            </div>
                            <h3 class="ms-4">6</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row ">
                        <div class="col-6">
                            <h5>{{ __('Expense Report') }}</h5>
                        </div>
                        <div class="col-6 text-end">
                            <h6>{{ __('Last 10 Days') }}</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="traffic-chart"></div>
                </div>
            </div>
        </div>

    </div>
@endsection
