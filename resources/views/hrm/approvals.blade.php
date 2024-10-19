@extends('layouts.admin')
@section('page-title')
    {{__('Leave Pending Approvals')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Leave Pending Approvals')}}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style" >
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('Employee Name')}}</th>
                                <th>{{__('Employee Department')}}</th>
                                <th>{{__('Type of Leave')}}</th>
                                <th>{{__('Leave Date')}}</th>
                                <th>{{__('Number of Days')}}</th>
                                <th>{{__('Resumption Date')}}</th>
                                <th>{{__('Leave Status')}}</th>
                                <th>{{__('Approval Stage')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($approvals as $approval)
                                <tr class="font-style">
                                    <td>{{ $approval->leave->user->name }}</td>
                                    <td>{{ $approval->leave->user->department->name }}</td>
                                    <td>{{ $approval->leave->leaveType->title}}</td>
                                    <td>11-10-2024</td>
                                    <td>{{ $approval->leave->total_leave_days }}</td>
                                    <td>{{ $approval->leave->end_date }}</td>
                                    <td>
                                        <span class="badge @if($approval->leave->status=='Pending') bg-warning
                                            @elseif ($approval->leave->status=='Approved') bg-primary
                                            @elseif ($approval->leave->status=='reject') bg-danger
                                            @endif p-2 px-3 rounded">{{ $approval->leave->status }}
                                        </span>
                                        {{-- {{ $approval->leave->status  }} --}}
                                    </td>
                                    <td>{{ $approval->status  }} / {{ $approval->approval_stage }}</td>
                                    <td class="Action">
                                    @can('approve leave')

                                            {{-- <a href="#" class="mx-3 btn btn-sm align-items-center" data-url=""
                                                data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Approve')}}" data-title="{{__('Approve')}}">
                                                <i class="ti ti-check text-white"></i>
                                            </a> --}}
                                            {{-- <div class="action-btn bg-danger ms-2">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['approvals.update', [$approval->id]]]) !!}
                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}"><i class="ti ti-trash text-white"></i></a>
                                                {!! Form::close() !!}
                                            </div> --}}
                                            <form method="POST" action="{{ route('approvals.update', $approval->id) }}">
                                                @csrf
                                                <select name="status" class="">
                                                    <option value="approved">Approve</option>
                                                    <option value="rejected">Reject</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm" >Update Approval</button>
                                            </form>
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
    {{-- @include('hrm.modals.apply-leave') --}}
    @if($errors->any() || Session::has('error'))
    <script>
         $(document).ready(function() {
            // $('#applyLeaveButton').modal('show');
            document.getElementById("applyLeaveButton").click();
         });
    </script>
    @endif
@endsection

