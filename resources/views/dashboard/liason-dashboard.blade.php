@extends('layouts.admin')
@section('page-title')
    {{__('Dashboard')}}
@endsection

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
                // markers: {
                //     size: 4,
                //     colors: ['#ffa21d', '#FF3A6E'],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // },
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
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><b>Welcome </b>{{ Ucfirst(Auth::user()->name). "(" .Auth::user()->department->name. ")" }}</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xxl-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center justify-content-between">
                                                <div class="col-auto mb-3 mb-sm-0">
                                                    <a href="#">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-primary">
                                                                <i class="ti ti-cast"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                {{-- <small class="text-muted">{{__('Total')}}</small> --}}
                                                                <h6 class="m-0">{{__('Set Budget')}}</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                {{-- <div class="col-auto text-end">
                                                    <h3 class="m-0">0</h3>
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
                                                    <a href="#">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-primary">
                                                                <i class="ti ti-cast"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                <h6 class="m-0">{{__('Leave Request')}}</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                {{-- <div class="col-auto text-end">
                                                    <h3 class="m-0">0</h3>
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
                                                    <a href="#">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-primary">
                                                                <i class="ti ti-cast"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                <h6 class="m-0">{{__('DTA')}}</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                {{-- <div class="col-auto text-end">
                                                    <h3 class="m-0">0</h3>
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
                                                    <a href="#">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar bg-primary">
                                                                <i class="ti ti-cast"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                <h6 class="m-0">{{__('Query')}}</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                {{-- <div class="col-auto text-end">
                                                    <h3 class="m-0">0</h3>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1 mb-0">{{__('Latest Income')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>{{__('Date')}}</th>
                                                <th>{{__('Customer')}}</th>
                                                <th>{{__('Amount Due')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="text-center">
                                                            <h6>{{__('there is no latest income')}}</h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row ">
                        <div class="col-6">
                            <h5>{{ __('Purchase Report') }}</h5>
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
