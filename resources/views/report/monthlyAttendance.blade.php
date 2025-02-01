@extends('layouts.admin')
@section('page-title')
    {{__('Manage Monthly Attendance')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Monthly Attendance')}}</li>
@endsection
@push('script-page')
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
                jsPDF: {unit: 'in', format: 'A2'}
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#department').on('change', function() {
            var departmentId = $(this).val();

            $.ajax({
                url: "{{ route('getEmployeesByDepartment') }}",
                type: "GET",
                data: { department_id: departmentId },
                success: function(response) {
                    $('#employee_id').empty();
                    $('#employee_id').append('<option value="0">All Employees</option>');

                    $.each(response.employees, function(id, name) {
                        $('#employee_id').append('<option value="' + id + '">' + name + '</option>');
                    });
                }
            });
        });
    });
    </script>

    {{-- <script>

        $(document).ready(function () {
            var b_id = $('#branch_id').val();
            // getDepartment(b_id);
        });
        $(document).on('change', 'select[name=branch_id]', function () {

            var branch_id = $(this).val();
            getDepartment(branch_id);
        });

        function getDepartment(bid) {

            $.ajax({
                url: '{{route('report.attendance.getdepartment')}}',
                type: 'POST',
                data: {
                    "branch_id": bid,
                    "_token": "{{ csrf_token() }}",
                },

                success: function (data) {
                    //console.log(data);
                    $('#department_id').empty();
                    $("#department_div").html('');
                    $('#department_div').append('<label for="department" class="form-label">{{__('Department')}}</label><select class="form-control" id="department_id" name="department_id[]"  ></select>');
                    $('#department_id').append('<option value="">{{__('Select Department')}}</option>');
                    $('#department_id').append('<option value="0"> {{__('All Department')}} </option>');
                    $.each(data, function (key, value) {
                        //console.log(key, value);
                        $('#department_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    // var multipleCancelButton = new Choices('#department_id', {
                    //     removeItemButton: true,
                    // });


                }

            });
        }

        $(document).on('change', '#department_id', function () {
            var department_id = $(this).val();
            getEmployee(department_id);
        });

        function getEmployee(did) {
            $.ajax({
                url: '{{route('report.attendance.getemployee')}}',
                type: 'POST',
                data: {
                    "department_id": did, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    console.log(data);
                    $('#employee_id').empty();
                    $("#employee_div").html('');
                    // $('#employee_div').append('<select class="form-control" id="employee_id" name="employee_id[]"  multiple></select>');
                    $('#employee_div').append('<label for="employee" class="form-label">{{__('Employee')}}</label><select class="form-control" id="employee_id" name="employee_id[]"  multiple></select>');
                    $('#employee_id').append('<option value="">{{__('Select Employee')}}</option>');
                    $('#employee_id').append('<option value="0"> {{__('All Employee')}} </option>');

                    $.each(data, function (key, value) {
                        $('#employee_id').append('<option value="' + key + '">' + value + '</option>');
                    });

                    var multipleCancelButton = new Choices('#employee_id', {
                        removeItemButton: true,
                    });
                }
            });
        }
    </script> --}}
@endpush



@section('action-btn')
    <div class="float-end">
        <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()" data-bs-toggle="tooltip" title="{{ __('Download') }}"
           data-original-title="{{ __('Download') }}">
            <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
        </a>

        {{--        <a href="{{route('report.attendance',[isset($_GET['month'])?$_GET['month']:date('Y-m'),isset($_GET['branch'])?$_GET['branch']:0,isset($_GET['department'])?$_GET['department']:0])}}" class="btn btn-sm btn-primary" onclick="saveAsPDF()"data-bs-toggle="tooltip" title="{{__('Download')}}" data-original-title="{{__('Download')}}">--}}
        {{--            <span class="btn-inner--icon"><i class="ti ti-download"></i></span>--}}
        {{--        </a>--}}

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class=" mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(array('route' => array('report.monthly.attendance'),'method'=>'get','id'=>'report_monthly_attendance')) }}
                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                        <div class="btn-box">
                                            <label for="department">{{ __('Month') }}</label>
                                            {{Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'month-btn form-control'))}}
                                        </div>
                                        </div>
                                    </div>
                                    @if(Auth::user()->type === 'super admin')
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 btn-box">
                                            <div class="form-group">
                                                <label for="department">{{ __('Select Department') }}</label>
                                                <select name="department" id="department" class="form-control">
                                                    <option value="">{{ __('All Departments') }}</option>
                                                    @foreach($departments as $department)
                                                        <option value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }}>
                                                            {{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 btn-box">
                                        <div class="form-group">
                                            <label for="employee_id">{{ __('Select Employee') }}</label>
                                            <select name="employee_id[]" id="employee_id" class="form-control select2" multiple>
                                                <option value="0">{{ __('All Employees') }}</option>
                                                @foreach($employees as $id => $name)
                                                    <option value="{{ $id }}" {{ in_array($id, (array) request('employee_id', [])) ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto mt-1">
                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('report_monthly_attendance').submit(); return false;" data-bs-toggle="tooltip" title="{{__('Apply')}}" data-original-title="{{__('apply')}}">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                        <a href="{{route('report.monthly.attendance')}}" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="{{ __('Reset') }}" data-original-title="{{__('Reset')}}">
                                            <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <div id="printableArea">
        <div class="row">
            <div class="col">
                <input type="hidden" value="{{ $data['curMonth'].' '.__('Attendance Report of').' '. $data['department'].' '.'Department'}}" id="filename">
                <div class="card p-4 mb-4">
                    <h6 class="mb-0">{{__('Report')}} :</h6>
                    <h7 class="text-sm mb-0">{{__('Attendance Summary')}}</h7>
                </div>
            </div>
            {{-- @if($data['branch']!='All')
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h6 class=" mb-0">{{__('Branch')}} :</h6>
                        <h7 class="text-sm mb-0">{{$data['branch']}}</h7>
                    </div>
                </div>
            @endif --}}
            @if($data['department']!='All')
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h6 class=" mb-0">{{__('Department')}} :</h6>
                        <h7 class="text-sm mb-0">{{$data['department']}}</h7>
                    </div>
                </div>
            @endif
            <div class="col">
                <div class="card p-4 mb-4">
                    <h6 class=" mb-0">{{__('Duration')}} :</h6>
                    <h7 class="text-sm mb-0">{{$data['curMonth']}}</h7>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-3 col-md-6 col-lg-3">
                <div class="card p-4 mb-4 ">
                    <div class="float-left">
                        <h6 class=" mb-0">{{__('Attendance')}}</h6>
                        <h7 class="text-sm text-sm mb-0 float-start">{{__('Total present')}}: {{$data['totalPresent']}}</h7>
                        <h7 class="text-sm mb-0 float-end">{{__('Total leave')}} : {{$data['totalLeave']}}</h7>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-3">
                <div class="card p-4 mb-4">
                    <h6 class=" mb-0">{{__('Overtime')}}</h6>
                    <h7 class="text-sm mb-0">{{__('Total overtime in hours')}} : {{number_format($data['totalOvertime'],2)}}</h7>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-3">
                <div class="card p-4 mb-4">
                    <h6 class=" mb-0">{{__('Early leave')}}</h6>
                    <h7 class="text-sm mb-0">{{__('Total early leave in hours')}} : {{number_format($data['totalEarlyLeave'],2)}}</h7>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-3">
                <div class="card p-4 mb-4">
                    <h6 class=" mb-0">{{__('Employee late')}}</h6>
                    <h7 class="text-sm mb-0">{{__('Total late in hours')}} : {{number_format($data['totalLate'],2)}}</h7>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive py-4 attendance-table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="active">{{__('Name')}}</th>
                                    @foreach($dates as $date)
                                        <th>{{$date}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($employeesAttendance as $attendance)

                                    <tr>
                                        <td>{{$attendance['name']}}</td>
                                        @foreach($attendance['status'] as $status)
                                            <td>
                                                @if($status=='P')
                                                    {{--                                                    <i class="custom-badge badge-success ap">{{__('P')}}</i>--}}
                                                    <i class="badge bg-success p-2 rounded">{{__('P')}}</i>
                                                @elseif($status=='A')
                                                    <i class="badge bg-danger p-2 rounded">{{__('A')}}</i>
                                                @endif
                                            </td>
                                        @endforeach
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
{{-- <script>
    $(document).ready(function () {
        var userType = '{{ Auth::user()->type }}';
        var departmentId = '{{ Auth::user()->department_id }}';

        // Load departments on page load
        getDepartments(userType, departmentId);

        // Load employees if a department is already selected
        if (departmentId) {
            getEmployees(departmentId);
        }
    });

    function getDepartments(userType, departmentId) {
        $.ajax({
            url: '{{ route('report.attendance.getdepartments') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "user_type": userType,
                "department_id": departmentId
            },
            success: function (data) {
                $('#department_id').empty();
                $('#department_id').append('<option value="">{{__('Select Department')}}</option>');

                if (userType === 'super admin') {
                    $('#department_id').append('<option value="0">{{__('All Departments')}}</option>');
                }

                $.each(data, function (key, value) {
                    $('#department_id').append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });
    }

    $(document).on('change', '#department_id', function () {
        var department_id = $(this).val();
        getEmployees(department_id);
    });

    function getEmployees(departmentId) {
        $.ajax({
            url: '{{ route('report.attendance.getemployees') }}',
            type: 'POST',
            data: {
                "department_id": departmentId,
                "_token": "{{ csrf_token() }}"
            },
            success: function (data) {
                $('#employee_id').empty();
                $('#employee_id').append('<option value="">{{__('Select Employee')}}</option>');

                if (departmentId === "0") {
                    $('#employee_id').append('<option value="0"> {{__('All Employees')}} </option>');
                }

                $.each(data, function (key, value) {
                    $('#employee_id').append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });
    }
</script> --}}
