
    <div class="modal-body">
        {{Form::open(array('route'=>'leave.apply','method'=>'post'))}}
        @csrf
        <div class="modal-body">
            <div class="row">

                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">

                            <tbody>
                                <style>
                                    th{
                                        width: 200px !important;
                                    }
                                </style>
                                <tr>
                                    <th scope="row">Emloyee Name</th>
                                    <td>#{{ $leave->user->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Department</th>
                                    <td>{{ $leave->user->department->name  }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Type of Leave</th>
                                    <td>{{ $leave->leaveType->title }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Start Date</th>
                                    <td>{{ $leave->start_date }}</td>
                                </tr>
                                
                                <tr>
                                    <th scope="row">End Date</th>
                                    <td>{{ $leave->end_date }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Leave Duration</th>
                                    <td>{{ $leave->total_leave_days. " Days" }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Relieving Staff</th>
                                    <td>{{ $leave->relieveStaff->name }}</td>
                                </tr>
                                <tr>
                                    <th>Leave Status</th>
                                    <td>
                                        <span class="badge @if($leave->status=='Pending') bg-warning
                                            @elseif ($leave->status=='Approved') bg-primary
                                            @elseif ($leave->status=='reject') bg-danger
                                            @endif p-2 px-3 rounded">{{ $leave->status }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>

        <div class="modal-footer">
            <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
        </div>

        {{Form::close()}}

        {{-- @can('approve leave')
            <form method="POST" action="{{ route('approvals.update', $leave->id) }}">
                @csrf
                <select name="status" class="form-control">
                    <option value="approved">Approve</option>
                    <option value="rejected">Reject</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm mt-2" >Update Approval</button>
            </form>
            
        @endcan --}}
        {{-- <div class="modal-footer">
                <input type="submit" value="{{__('Approve')}}" class="btn  btn-primary">
            </div> --}}
    </div>
