<div>
@section('page-title')
    {{__('Leave for Approvals')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Leave Pending Approvals')}}</li>
@endsection

    <div class="row mt-2">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style" >
                    <div class="table-responsive">
                        <table class="table">
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
                                    @if ($pendingApprovals->isEmpty())
                                        <tr>
                                            <td scope="col" colspan="9">
                                                <h6 class="text-center">{{ __('No leave requests to approve.') }}</h6>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($pendingApprovals as $approval)
                                            <tr class="font-style">
                                                <td>{{ $approval->user->name }}</td>
                                                <td>{{ $approval->user->department->name }}</td>
                                                <td>{{ $approval->leaveType->title}}</td>
                                                <td>{{ $approval->start_date }}</td>
                                                <td>{{ $approval->total_leave_days }}</td>
                                                <td>{{ $approval->end_date }}</td>
                                                <td>
                                                    <span class="badge @if($approval->status=='Pending') bg-warning
                                                        @elseif ($approval->status=='Approved') bg-primary
                                                        @elseif ($approval->status=='reject') bg-danger
                                                        @endif p-2 px-3 rounded">{{ $approval->status }}
                                                    </span>
                                                    {{-- {{ $approval->leave->status  }} --}}
                                                </td>
                                                <td>{{ $approval->status  }}</td>
                                                <td class="Action">
                                                @can('approve leave')
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" wire:click="setLeave('{{ $approval->id }}')" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" id="toggleApplicantDetails" 
                                                            data-bs-target="#leaveDetailsModal" data-size="lg" data-bs-toggle="tooltip" title="{{__('Leave Applicaiton Details')}}">
                                                            <i class="ti ti-eye text-white"></i>
                                                        </a>
                                                    </div>
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="#" wire:click="approveLeave({{ $approval->id }})"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-bs-toggle="tooltip" title="{{ __('Approve Leave Request') }}">
                                                            <i class="ti ti-check text-white"></i>
                                                        </a>
                                                    </div>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <a href="#" wire:click="rejectLeave({{ $approval->id }})"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-bs-toggle="tooltip" title="{{ __('Reject Leave Request') }}">
                                                            <i class="text-white">X</i>
                                                        </a>
                                                    </div>
                                                @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h2>Approved Leaves</h2>
    <div class="row mt-2">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style" >
                    <div class="table-responsive">
                        <table class="table">
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
                                    @if ($approvedLeaves->isEmpty())
                                        <tr>
                                            <td scope="col" colspan="9">
                                                <h6 class="text-center">{{ __('No record') }}</h6>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($approvedLeaves as $approval)
                                            <tr class="font-style">
                                                <td>{{ $approval->user->name }}</td>
                                                <td>{{ $approval->user->department->name }}</td>
                                                <td>{{ $approval->leaveType->title}}</td>
                                                <td>{{ $approval->start_date }}</td>
                                                <td>{{ $approval->total_leave_days }}</td>
                                                <td>{{ $approval->end_date }}</td>
                                                <td>
                                                    <span class="badge @if($approval->status=='Pending') bg-warning
                                                        @elseif ($approval->status=='Approved') bg-primary
                                                        @elseif ($approval->status=='reject') bg-danger
                                                        @endif p-2 px-3 rounded">{{ $approval->status }}
                                                    </span>
                                                    {{-- {{ $approval->leave->status  }} --}}
                                                </td>
                                                <td>{{ $approval->status  }}</td>
                                                <td class="Action">
                                                @can('approve leave')
                                                    {{-- <div class="action-btn bg-info ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="{{ route('view-leave-application',$approval->leave->id)}}" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="{{__('View')}}"  data-title="{{__('Leave Applicaiton Details')}}">
                                                            <i class="ti ti-eye text-white"></i>
                                                        </a>
                                                    </div> --}}
                                                @endcan
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" wire:click="setLeave('{{ $approval->id }}')" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" id="toggleApplicantDetails" 
                                                            data-bs-target="#leaveDetailsModal" data-size="lg" data-bs-toggle="tooltip" title="{{__('Leave Applicaiton Details')}}">
                                                            <i class="ti ti-eye text-white"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.leave.modals.leave-details')
    <x-toast-notification />
</div>
