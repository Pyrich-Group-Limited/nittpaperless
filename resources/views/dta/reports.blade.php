@extends('layouts.admin')
@section('page-title')
    {{__('Manage DTA Report')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('DTA Report')}}</li>
@endsection
@push('script-page')

    <script type="text/javascript" src="{{ asset('js/jszip.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pdfmake.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.buttons.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/buttons.html5.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script>
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A4'}
            };
            html2pdf().set(opt).from(element).save();

        }

        $(document).ready(function () {
            var filename = $('#filename').val();
            $('#report-dataTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'pdf',
                        title: filename
                    },
                    {
                        extend: 'excel',
                        title: filename
                    }, {
                        extend: 'csv',
                        title: filename
                    }
                ]
            });
        });
    </script>
    <script>
        $('input[name="type"]:radio').on('change', function (e) {
            var type = $(this).val();
            if (type == 'monthly') {
                $('.month').addClass('d-block');
                $('.month').removeClass('d-none');
                $('.year').addClass('d-none');
                $('.year').removeClass('d-block');
            } else {
                $('.year').addClass('d-block');
                $('.year').removeClass('d-none');
                $('.month').addClass('d-none');
                $('.month').removeClass('d-block');
            }
        });

        $('input[name="type"]:radio:checked').trigger('change');

    </script>
@endpush
@section('action-btn')
    <div class="float-end">
        <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()"data-bs-toggle="tooltip" title="{{__('Download')}}" data-original-title="{{__('Download')}}">
            <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
        </a>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2" id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['route' => 'reports.dta', 'method' => 'get', 'id' => 'report_dta']) }}
                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">

                                    <!-- Type Selection -->
                                    <div class="col-3 mt-2">
                                        <label class="form-label">{{ __('Type') }}</label> <br>

                                        <div class="form-check form-check-inline form-group">
                                            <input type="radio" id="monthly" value="monthly" name="type" class="form-check-input"
                                                {{ request('type', 'monthly') == 'monthly' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="monthly">{{ __('Monthly') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline form-group">
                                            <input type="radio" id="yearly" value="yearly" name="type" class="form-check-input"
                                                {{ request('type') == 'yearly' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="yearly">{{ __('Yearly') }}</label>
                                        </div>
                                    </div>

                                    <!-- Month Selection (Visible if Monthly is selected) -->
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 month">
                                        <div class="btn-box">
                                            {{ Form::label('month', __('Month'), ['class' => 'form-label']) }}
                                            {{ Form::month('month', request('month') ?? date('Y-m'), ['class' => 'month-btn form-control']) }}
                                        </div>
                                    </div>

                                    <!-- Year Selection (Visible if Yearly is selected) -->
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 year d-none">
                                        <div class="btn-box">
                                            {{ Form::label('year', __('Year'), ['class' => 'form-label']) }}
                                            <select class="form-control select" id="year" name="year">
                                                @for ($filterYear['starting_year']; $filterYear['starting_year'] <= $filterYear['ending_year']; $filterYear['starting_year']++)
                                                    <option value="{{ $filterYear['starting_year'] }}"
                                                        {{ request('year', date('Y')) == $filterYear['starting_year'] ? 'selected' : '' }}>
                                                        {{ $filterYear['starting_year'] }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Department Selection -->
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            {{ Form::label('department', __('Department'), ['class' => 'form-label']) }}

                                            @if(Auth::user()->type === 'super admin')
                                                {{ Form::select('department', $departments, request('department'), ['class' => 'form-control select']) }}
                                            @else
                                                {{ Form::select('department', $departments, Auth::user()->department_id, ['class' => 'form-control select', 'readonly' => true]) }}
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Search & Reset Buttons -->
                            <div class="col-auto mt-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('report_dta').submit(); return false;"
                                        data-bs-toggle="tooltip" title="{{ __('Apply') }}">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>

                                        <a href="{{ route('reports.dta') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                        title="{{ __('Reset') }}">
                                            <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="printableArea" class="">
        <div class="row">
            {{-- <div class="col">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-report"></i>
                                </div>
                                <div class="ms-3">
                                    <input type="hidden"
                                           value="{{ $filterYear['branch'] . ' ' . __('Branch') . ' ' . $filterYear['dateYearRange'] . ' ' . $filterYear['type'] . ' ' . __('DTA Report of') . ' ' . $filterYear['department'] . ' ' . 'Department' }}"
                                           id="filename">
                                    <h5 class="mb-0">{{ __('Report') }}</h5>
                                    <div>
                                        <p class="text-muted text-sm mb-0">
                                            {{ $filterYear['type'] . ' ' . __('DTA Summary') }}</p>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- @if ($filterYear['branch'] != 'All')
                <div class="col">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-sitemap"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ __('Branch') }}</h5>
                                        <p class="text-muted text-sm mb-0">
                                            {{ $filterYear['branch'] }} </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif --}}
            @if ($filterYear['department'] != 'All')
                <div class="col">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-template"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ __('Department') }}</h5>
                                        <p class="text-muted text-sm mb-0">{{ $filterYear['department'] }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-calendar"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0">{{ __('Duration') }}</h5>
                                    <p class="text-muted text-sm mb-0">{{ $filterYear['dateYearRange'] }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-circle-check"></i>
                                </div>

                                <div class="ms-3">
                                    <h5 class="mb-0">{{ __('Approved DTA') }} </h5>
                                    <p class="text-muted text-sm mb-0">{{ $filter['totalApproved'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-circle-x"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0">{{ __('Rejected DTA') }}</h5>
                                    <p class="text-muted text-sm mb-0">
                                        {{ $filter['totalReject'] }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-circle-minus"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0">{{ __('Pending DTA') }}</h5>
                                    <p class="text-muted text-sm mb-0">{{ $filter['totalPending'] }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive py-4">
                            <table class="table mb-0" id="report-dataTable">
                                <thead>
                                <tr>
                                    <th>{{__('Employee ID')}}</th>
                                    <th>{{__('Employee')}}</th>
                                    <th>{{__('Approved DTA')}}</th>
                                    <th>{{__('Rejected DTA')}}</th>
                                    <th>{{__('Pending DTA')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dtas as $dta)
                                    <tr>
                                        {{--                                    <td class="">{{ \Auth::user()->employeeIdFormat($dta['employee_id']) }}</td>--}}
                                        <td><a href="#" class="btn btn-sm btn-primary">{{ \Auth::user()->employeeIdFormat($dta['employee_id']) }}</a></td>

                                        <td>{{$dta['employee']}}</td>
                                        <td>
                                            <div class="m-view-btn badge bg-info p-2 px-3 rounded">{{$dta['approved']}}
                                                <a href="#" class="text-white" data-size="lg" data-url="{{ route('report.employee.dta',[$dta['id'],'Approved',isset($_GET['type']) ?$_GET['type']:'no',isset($_GET['month'])?$_GET['month']:date('Y-m'),isset($_GET['year'])?$_GET['year']:date('Y')]) }}" data-ajax-popup="true" data-title="{{__('Approved DTA Detail')}}" data-bs-toggle="tooltip" title="{{__('View')}}" data-original-title="{{__('View')}}">{{__('View')}}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="m-view-btn badge bg-danger p-2 px-3 rounded">{{$dta['rejected']}}
                                                <a href="#" class="text-white" data-size="lg" data-url="{{ route('report.employee.dta',[$dta['id'],'Rejected',isset($_GET['type']) ?$_GET['type']:'no',isset($_GET['month'])?$_GET['month']:date('Y-m'),isset($_GET['year'])?$_GET['year']:date('Y')]) }}" class="table-action table-action-delete" data-ajax-popup="true" data-title="{{__('Rejected DTA Detail')}}" data-bs-toggle="tooltip" title="{{__('View')}}" data-original-title="{{__('View')}}">{{__('View')}}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="m-view-btn badge bg-warning p-2 px-3 rounded">{{$dta['pending']}}
                                                <a href="#" class="text-white" data-size="lg" data-url="{{ route('report.employee.dta',[$dta['id'],'Pending',isset($_GET['type']) ?$_GET['type']:'no',isset($_GET['month'])?$_GET['month']:date('Y-m'),isset($_GET['year'])?$_GET['year']:date('Y')]) }}" class="table-action table-action-delete" data-ajax-popup="true" data-title="{{__('Pending DTA Detail')}}" data-bs-toggle="tooltip" title="{{__('View')}}" data-original-title="{{__('View')}}">{{__('View')}}</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

