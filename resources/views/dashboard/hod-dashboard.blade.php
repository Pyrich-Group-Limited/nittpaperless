@extends('layouts.admin')
@section('page-title')
    {{ 'Dashboard' . ' - ' . ' ' . Ucfirst(Auth::user()->type) }}
    {{-- <i class="ti ti-user"></i> ({{ Ucfirst(Auth::user()->designation) }})<br>
        <i class="ti ti-location"></i> {{ Ucfirst(Auth::user()->location)}} --}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    {{-- <li class="breadcrumb-item"><b>Welcome </b>{{ Ucfirst(Auth::user()->name). " (" .Auth::user()->department->name. ")" }}</li> --}}
    <li class="breadcrumb-item"><b>Welcome </b>{{ Ucfirst(Auth::user()->name) }} | {{ Auth::user()->department->name }} | {{ Auth::user()->unit->name ?? ''}}</li>
@endsection
@section('content')
        @if ($projectsWithoutComments->isEmpty())
            {{-- <p class="">No projects pending your comment.</p> --}}
        @else
            <div class="row">
                <h4 class="text-danger">Projects awaiting your comment.</h4>
                @foreach ($projectsWithoutComments as $project)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body bg-warning">
                                <h5 class="card-title">{{ $project->project_name }}</h5>
                                {{-- <p class="card-text">{{ Str::limit($project->description, 100) }}</p> --}}
                                <a href="{{ route('project.shared', $project->id) }}" class="btn btn-primary btn-sm">
                                    View Project
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <a href="{{ route('requisition.raise') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="theme-avtar bg-primary">
                                                        <i class="ti ti-cast"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        {{-- <small class="text-muted">{{__('Total')}}</small> --}}
                                                        <h6 class="m-0">{{__('Payment Requisition')}}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <a href="{{ route('itemRequisition.index') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="theme-avtar bg-primary">
                                                        <i class="ti ti-cast"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="m-0">{{__('Store Requisition Note')}}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <a href="{{ route('hrm.query') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="theme-avtar bg-primary">
                                                        <i class="ti ti-cast"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="m-0">{{__('Query/Complaints')}}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
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
        <div class="col-xxl-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <a href="{{ route('approvals.index') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="theme-avtar bg-primary">
                                                        <i class="ti ti-cast"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        {{-- <small class="text-muted">{{__('Total')}}</small> --}}
                                                        <h6 class="m-0">{{__('Leave Requests')}}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <a href="{{ route('memos.index') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="theme-avtar bg-primary">
                                                        <i class="ti ti-cast"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="m-0">{{__('Memos')}}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="row"> --}}
        {{-- <div class="col-sm-6">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Mark Attandance') }}</h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <p class="text-muted pb-0-5">
                            {{ __('My Office Time: ' . $officeTime['startTime'] . ' to ' . $officeTime['endTime']) }}</p>
                        <center>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::open(['url' => 'attendanceemployee/attendance', 'method' => 'post']) }}
                                    @if (empty($employeeAttendance) || $employeeAttendance->clock_out != '00:00:00')
                                        <button type="submit" value="0" name="in" id="clock_in"
                                            class="btn btn-success ">{{ __('CLOCK IN') }}</button>
                                    @else
                                        <button type="submit" value="0" name="in" id="clock_in"
                                            class="btn btn-success disabled" disabled>{{ __('CLOCK IN') }}</button>
                                    @endif
                                    {{ Form::close() }}
                                </div>
                                <div class="col-md-6 ">
                                    @if (!empty($employeeAttendance) && $employeeAttendance->clock_out == '00:00:00')
                                        {{ Form::model($employeeAttendance, ['route' => ['attendanceemployee.update', $employeeAttendance->id], 'method' => 'PUT']) }}
                                        <button type="submit" value="1" name="out" id="clock_out"
                                            class="btn btn-danger">{{ __('CLOCK OUT') }}</button>
                                    @else
                                        <button type="submit" value="1" name="out" id="clock_out"
                                            class="btn btn-danger disabled" disabled>{{ __('CLOCK OUT') }}</button>
                                    @endif
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </center>

                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-sm-6"> --}}
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Training</h5>
                        <div class="row  mt-4">
                            <div class="col-md-6 col-sm-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-users"></i>
                                    </div>
                                    <div class="ms-2">
                                        <p class="text-muted text-sm mb-0">Total Training</p>
                                        <h4 class="mb-0 text-success">{{ $onGoingTraining +   $doneTraining}}</h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 my-3 my-sm-0">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="theme-avtar bg-success">
                                        <i class="ti ti-user-check"></i>
                                    </div>
                                    <div class="ms-2">
                                        <p class="text-muted text-sm mb-0">Active Training</p>
                                        <h4 class="mb-0 text-danger">{{$onGoingTraining}}</h4>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5>Jobs</h5>
                            <div class="col-md-6 col-sm-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-award"></i>
                                    </div>
                                    <div class="ms-2">
                                        <p class="text-muted text-sm mb-0">Total Jobs</p>
                                        <h4 class="mb-0 text-primary">{{$activeJob + $inActiveJOb}}</h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <a href="{{ route('jobsAvailable.index') }}">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="theme-avtar bg-success">
                                            <i class="ti ti-award"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0">Active Jobs</p>
                                            <h4 class="mb-0 text-danger">{{$activeJob}}</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        {{-- </div> --}}
    {{-- </div> --}}

    <div class="row">
        <div class="col-lg-6">
            <div class="card list_card">
                <div class="card-header">
                    <h4>{{ __('Announcement List') }}</h4>
                </div>
                <div class="card-body dash-card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Start Date') }}</th>
                                    <th>{{ __('End Date') }}</th>
                                    <th>{{ __('description') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($announcements as $announcement)
                                    <tr>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ \Auth::user()->dateFormat($announcement->start_date) }}</td>
                                        <td>{{ \Auth::user()->dateFormat($announcement->end_date) }}</td>
                                        <td>{{ $announcement->description }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="text-center">
                                                <h6>{{ __('There is no Announcement List') }}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card list_card">
                <div class="card-header">
                    <h4>{{ __('Meeting List') }}</h4>
                </div>
                <div class="card-body dash-card-body">
                    @if (count($meetings) > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead>
                                    <tr>
                                        <th>{{ __('Meeting title') }}</th>
                                        <th>{{ __('Meeting Date') }}</th>
                                        <th>{{ __('Meeting Time') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($meetings as $meeting)
                                        <tr>
                                            <td>{{ $meeting->title }}</td>
                                            <td>{{ \Auth::user()->dateFormat($meeting->date) }}</td>
                                            <td>{{ \Auth::user()->timeFormat($meeting->time) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-2">
                            {{ __('No meeting scheduled yet.') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
