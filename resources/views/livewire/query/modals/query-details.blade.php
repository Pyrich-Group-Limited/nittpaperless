<div>
    <div class="modal" id="queryDetailsModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Query Details</h5>
                    
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        @if($selQuery)
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
                                                    <th scope="row">Raiser Name</th>
                                                    <td>{{ $selQuery->raiser->name ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Query For: </th>
                                                    <td>{{ $selQuery->staff->name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Query Subject</th>
                                                    <td>{{ $selQuery->subject  }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Query Details</th>
                                                    <td>{!! $selQuery->query_details !!}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Date</th>
                                                    <td>{{ $selQuery->created_at->format('Y-m-d H:i:s') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Query Status</th>
                                                    <td>
                                                        <span class="badge @if($selQuery->status=='Pending') bg-warning
                                                            @elseif ($selQuery->status=='Answered') bg-primary
                                                            @elseif ($selQuery->status=='Rejected') bg-danger
                                                            @else bg-warning
                                                            @endif p-2 px-3 rounded">{{ $selQuery->status }}
                                                        </span>
                                                    </td>
                                                </tr>

                                                @if($selQuery->attachment==null)
                                                    <tr>
                                                        <th>Document</th>
                                                        <td class="text-warning">No document uploaded for this Query.</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <th>Document</th>
                                                        <td class="text-end">
                                                            <a href="{{ asset('assets/documents/documents') }}/{{$selQuery->attachment}}" target="_blank" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>
                                                            <a href="#" wire:click="downloadFile('{{ $selQuery->attachment }}')" class="btn btn-primary btn-sm"><i class="ti ti-download"></i></a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                       
                        </div>
                        <div class="modal-footer">
                            <div wire:loading wire:target="setActionId"><x-g-loader /></div>

                            <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light"
                                data-bs-dismiss="modal">

                            @if ($selQuery->status === 'Pending' && auth()->user()->can('assign query'))
                                <input type="button" data-bs-dismiss="modal" wire:click="setActionId('{{ $selQuery->id }}')" value="{{__('Issue Query')}}" class="btn  btn-primary confirm-approve">
                            @endif
                        </div>
                @else
                    <label align="center" class="mb-4" style="color: red">Loading...</label>
                @endif
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
