<div id="viewBudget">
    <div class="modal" id="viewRequisitionDetailsModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title"> REQUISITION DETAILS </h5>
                    </div>
                    <div class="modal-body">
                        @if ($selRequisition)
                            <div class="row">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>{{__('Staff Name')}}</th>
                                                <td>{{ $selRequisition->staff->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('Requisition Type')}}</th>
                                                <td>{{ $selRequisition->requisition_type }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('Requisition Purpose')}}</th>
                                                <td>{{ $selRequisition->purpose }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('Amount')}}</th>
                                                <td>₦ {{ number_format($selRequisition->amount,2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('Approval Status')}}</th>
                                                <td>{{ $selRequisition->status }}</td>
                                            </tr>
                                            <tr >
                                                <th style="word-break: break-word !important;">{{__('Description')}}</th>
                                                <td style="word-break: break-word !important;">
                                                    {{ $selRequisition->description }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{__('Date of Request')}}</th>
                                                <td>{{ $selRequisition->created_at->format('d-M-Y') }}</td>
                                            </tr>

                                            @if($selRequisition->supporting_document==null)
                                                    <tr>
                                                        <th>Supporting Document</th>
                                                        <td class="text-warning">No supporting document uploaded for this requisition.</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <th>Supporting Document</th>
                                                        <td class="text-end">
                                                            <a href="{{ asset('assets/documents/documents') }}/{{$selRequisition->supporting_document}}" target="_blank" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>
                                                            <a href="#" wire:click="downloadFile('{{ $selRequisition->supporting_document }}')" class="btn btn-primary btn-sm"><i class="ti ti-download"></i></a>
                                                        </td>
                                                    </tr>
                                            @endif

                                        </table>
                                    </div>
                            </div>
                                @if ($selRequisition->status=='rejected')
                                    <div class="form-group">
                                        <label class="form-label" for="exampleFormControlTextarea1">{{__('Rejection Comment')}}</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" readonly>{{ $selRequisition->comment }}</textarea>
                                    </div>
                                @endif
                            <div class="modal-footer">
                                <div wire:loading wire:target="hodApproveRequisition"><x-g-loader /></div>
                                <div wire:loading wire:target="approveRequisition"><x-g-loader /></div>
                                <div wire:loading wire:target="dgApproveRequisition"><x-g-loader /></div>
                                <div wire:loading wire:target="bursarApproveRequisition"><x-g-loader /></div>
                                <div wire:loading wire:target="pvApproveRequisition"><x-g-loader /></div>
                                <div wire:loading wire:target="cashOfficeApproveRequisition"><x-g-loader /></div>

                                <input type="button" id="closeRequisitionDetails" value="{{ __('Close') }}"
                                    class="btn  btn-light btn-sm" data-bs-dismiss="modal">
                                @if(auth()->user()->type=="hod")
                                    @can('approve as hod')
                                        <input type="button" wire:click="hodApproveRequisition({{ $selRequisition->id }})" value="{{ __('Approve as HoD') }}" class="btn  btn-primary btn-sm">
                                    @endcan
                                @endif
                                    @if(auth()->user()->type!="hod")
                                        @can('approve as dg')
                                            <input type="button"  wire:click="dgApproveRequisition('{{ $selRequisition->id }}')" value="{{ __('Approve as DG') }}" class="btn  btn-primary btn-sm ">
                                        @endcan 
                                        @can('approve as bursar')
                                            <input type="button"  wire:click="bursarApproveRequisition('{{ $selRequisition->id }}')" value="{{ __('Approve as Bursar') }}" class="btn  btn-primary btn-sm ">
                                        @endcan 
                                        @can('approve as pv')
                                            <input type="button"  wire:click="pvApproveRequisition('{{ $selRequisition->id }}')" value="{{ __('Approve as PV') }}" class="btn  btn-primary btn-sm ">
                                        @endcan 
                                        @can('approve as audit')
                                            <input type="button"  wire:click="auditApproveRequisition('{{ $selRequisition->id }}')" value="{{ __('Approve as Audit') }}" class="btn  btn-primary btn-sm ">
                                        @endcan 
                                        @can('approve as cash office')
                                            <input type="button"  wire:click="cashOfficeApproveRequisition('{{ $selRequisition->id }}')" value="{{ __('Approve as Cash Office') }}" class="btn  btn-primary btn-sm ">
                                        @endcan      
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
            document.getElementById("closeRequisitionDetails").click();
        })
    </script>
    <x-toast-notification />
