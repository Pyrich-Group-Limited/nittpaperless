@extends('layouts.admin')
@section('page-title')
    {{__('Leave')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Leave')}}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        <a href="#" class="btn btn-primary" id="applyLeaveButton" data-bs-toggle="modal" data-bs-target="#applyLeave"   data-size="lg " data-bs-toggle="tooltip">
            <i class="ti ti-plus text-white"></i>Apply for Leave
        </a>
    </div>
@endsection


@section('content')
        {{-- @include('hrm.includes.dash-nav') --}}
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style" >
                    <div class="table-responsive">
                        {{-- <div class="table-head col-xl-12 mt-2" style="text-align: right;">
                            <a href="#" class="btn btn-primary" id="applyLeaveButton" data-bs-toggle="modal" data-bs-target="#applyLeave"   data-size="lg " data-bs-toggle="tooltip"><i class="ti ti-plus text-white"></i>Apply for Leave</a>
                        </div> --}}
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('Employee Name')}}</th>
                                <th>{{__('Employee Department')}}</th>
                                <th>{{__('Type of Leave')}}</th>
                                <th>{{__(' Date Applied')}}</th>
                                <th>{{__('Number of Days')}}</th>
                                <th>{{__('Resumption Date')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($leaves as $leave)
                                <tr class="font-style">
                                    <td>{{ $leave->user->name }}</td>
                                    <td>{{ $leave->user->department->name }}</td>
                                    <td>{{ $leave->leaveType->title}}</td>
                                    <td>{{  $leave->applied_on }}</td>
                                    <td>{{ $leave->total_leave_days }}</td>
                                    <td>{{ $leave->end_date }}</td>
                                    <td>
                                        <span class="badge @if($leave->status=='Pending') bg-warning
                                            @elseif ($leave->status=='Approved') bg-primary
                                            @elseif ($leave->status=='reject') bg-danger
                                            @endif p-2 px-3 rounded">{{ $leave->status }}
                                        </span>
                                    </td>
                                    <td class="Action">
                                    @can('manage leave')
                                        <div class="action-btn bg-success ms-2">
                                            <a href="#" class="mx-3 btn btn-sm align-items-center" data-url=""
                                                data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Approve')}}" data-title="{{__('Approve')}}">
                                                <i class="ti ti-check text-white"></i>
                                            </a>
                                        </div>
                                        <div class="action-btn bg-info ms-2">
                                            <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Return')}}"  data-title="{{__('Return')}}">
                                                <i class="ti ti-share text-white"></i>
                                            </a>
                                        </div>
                                        <div class="action-btn bg-danger ms-2">
                                            <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Reject')}}"  data-title="{{__('Reject')}}">
                                                <i class="ti ti-plus text-white"></i>
                                            </a>
                                        </div>
                                        @else
                                        <div class="action-btn bg-danger ms-2">
                                            <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="{{ route('view-leave-application',$leave->id)}}" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="{{__('View')}}"  data-title="{{__('Leave Applicaiton Details')}}">
                                                <i class="ti ti-eye text-white"></i>
                                            </a>
                                        </div>
                                        @endcan
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
    @include('hrm.modals.apply-leave')
    @if($errors->any() || Session::has('error'))
    <script>
         $(document).ready(function() {
            // $('#applyLeaveButton').modal('show');
            document.getElementById("applyLeaveButton").click();
         });
    </script>
    @endif
@endsection

