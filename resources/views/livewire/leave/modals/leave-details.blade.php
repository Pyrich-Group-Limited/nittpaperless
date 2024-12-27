<div id="viewBudget">
    <div class="modal" id="leaveDetailsModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyLeave">Leave Details
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        @if($selLeave)
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
                                                    <td>{{ $selLeave->user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Department</th>
                                                    <td>{{ $selLeave->user->department->name  }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Type of Leave</th>
                                                    <td>{{ $selLeave->leaveType->title }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Start Date</th>
                                                    <td>{{ $selLeave->start_date }}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="row">End Date</th>
                                                    <td>{{ $selLeave->end_date }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Leave Duration</th>
                                                    <td>{{ $selLeave->total_leave_days. " Days" }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Relieving Staff</th>
                                                    <td>{{ $selLeave->relieveStaff->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Leave Status</th>
                                                    <td>
                                                        <span class="badge @if($selLeave->status=='Pending') bg-warning
                                                            @elseif ($selLeave->status=='Approved') bg-primary
                                                            @elseif ($selLeave->status=='Rejected') bg-danger
                                                            @endif p-2 px-3 rounded">{{ $selLeave->status }}
                                                        </span>
                                                    </td>
                                                </tr>

                                                @if($selLeave->supporting_document==null)
                                                    <tr>
                                                        <th>Supporting Document</th>
                                                        <td class="text-warning">No supporting document uploaded for this Leave.</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <th>Supporting Document</th>
                                                        <td class="text-end">
                                                            <a href="{{ asset('assets/documents/documents') }}/{{$selLeave->supporting_document}}" target="_blank" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>
                                                            <a href="#" wire:click="downloadFile('{{ $selLeave->supporting_document }}')" class="btn btn-primary btn-sm"><i class="ti ti-download"></i></a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        @else
                            <label align="center" class="mb-4" style="color: red">Loading...</label>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="approveLeave"><x-g-loader /></div>
                        <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        {{-- @can('approve leave')
                            <input type="button" wire:click="approveLeave({{ $selLeave->leave_id }})" value="{{__('Approve')}}" class="btn  btn-primary">
                        @endcan --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeLeaveModal").click();
    })
</script>
<x-toast-notification />
