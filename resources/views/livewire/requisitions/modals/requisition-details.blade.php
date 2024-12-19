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
                                                <td>
                                                    @if ($selRequisition->status == 'pending')
                                                        <span
                                                            class="badge bg-warning p-2 px-3 rounded">Pending</span>
                                                    @elseif ($selRequisition->status == 'cash_office_approved')
                                                        <span
                                                            class="badge bg-success p-2 px-3 rounded">Approved</span>
                                                    @elseif ($selRequisition->status == 'rejected')
                                                        <span
                                                            class="badge bg-danger p-2 px-3 rounded">Rejected</span>
                                                    @else
                                                        <span class="badge bg-warning p-2 px-3 rounded">
                                                            {{ $selRequisition->status }}
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr >
                                                <th>{{__('Description')}}</th>
                                                <td style="overflow-wrap: break-word; word-break: break-word; white-space: normal;">
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
                                        
                                        {{-- @if ($approvals) --}}
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Approved By</th>
                                                        <th>Role</th>
                                                        <th>Signature</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($selRequisition->approvalRecords as $approval)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $approval->approver->name ?? 'N/A' }}</td>
                                                            <td>{{ $approval->role }}</td>
                                                            <td>
                                                                @if ($approval->approver && $approval->approver->signature)
                                                                    <img src="{{ asset('storage/' . $approval->approver->signature->signature_path) }}" alt="Signature" height="50">
                                                                @else
                                                                    <strike>{{ $approval->approver->name }}</strike>
                                                                @endif
                                                            </td>
                                                            <td>{{ $approval->created_at->format('d-M-Y') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        {{-- @endif --}}
                                    </div>
                            </div>
                                @if ($selRequisition->status=='rejected')
                                    <div class="form-group">
                                        <label class="form-label" for="exampleFormControlTextarea1">{{__('Rejection Comment')}}</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" readonly>{{ $selRequisition->comment }}</textarea>
                                    </div>
                                @endif
                                @if ($selRequisition->status=='bursar_approved')
                                    @can('approve as pv')
                                        <div class="form-group">
                                            <label class="form-label text-warning" >{{__('Account to be charged')}}</label>
                                            <select class="form-control" wire:model="chartAccount">
                                                <option value="">Select Account</option>
                                                @foreach ($accounts as $account)
                                                    <option value="{{ $account->id }}">{{ $account->name }} - ({{ $account->code }})</option>
                                                @endforeach
                                            </select>
                                            @error('chartAccount')
                                                <small class="invalid-type_of_leave" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    @endcan
                                @endif

                                @if ($selRequisition->status=='audit_approved')
                                    @can('approve as cash office')
                                        <div class="form-group">
                                            {{ Form::label('paymentEvidence', __('Upload Payment Evidence'), ['class' => 'form-label']) }}
                                            <input type="file" id="paymentEvidence" wire:model.defer="paymentEvidence"
                                                class="form-control" placeholder="Supporting Document" />
                                            <strong class="text-danger" wire:loading
                                                wire:target="paymentEvidence">Loading...</strong>
                                            @error('paymentEvidence')
                                                <small class="invalid-name" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    @endcan
                                @endif
                            <div class="modal-footer"> 
                                <div wire:loading wire:target="specialDutyApproveRequisition"><x-g-loader /></div>
                                <div wire:loading wire:target="hodApproveRequisition"><x-g-loader /></div>
                                <div wire:loading wire:target="liaisonHeadApproveRequisition"><x-g-loader /></div>
                                <div wire:loading wire:target="approveRequisition"><x-g-loader /></div>
                                <div wire:loading wire:target="dgApproveRequisition"><x-g-loader /></div>
                                <div wire:loading wire:target="bursarApproveRequisition"><x-g-loader /></div>
                                <div wire:loading wire:target="pvApproveRequisition"><x-g-loader /></div>
                                <div wire:loading wire:target="cashOfficeApproveRequisition"><x-g-loader /></div>

                                <input type="button" id="closeRequisitionDetails" value="{{ __('Close') }}"
                                    class="btn  btn-light btn-sm" data-bs-dismiss="modal">
                                    @can('approve as hod')
                                        @if ($selRequisition->status=='pending')
                                            <input type="button" wire:click="hodApproveRequisition({{ $selRequisition->id }})" value="{{ __('Approve as HoD') }}" class="btn  btn-primary btn-sm">
                                        @endif
                                    @endcan 

                                    @can('approve as liaison head')
                                        @if ($selRequisition->status=='liaison_head_approval')
                                            <input type="button" wire:click="liaisonHeadApproveRequisition('{{ $selRequisition->id }}')" value="{{ __('Approve as Liaison Head') }}" class="btn  btn-primary btn-sm ">
                                        @endif
                                    @endcan 

                                    @can('approve as special duty')
                                        @if ($selRequisition->status=='liaison_head_approved')
                                            <input type="button"  wire:click="specialDutyApproveRequisition('{{ $selRequisition->id }}')" value="{{ __('Approve as SD Head') }}" class="btn  btn-primary btn-sm ">
                                        @endif
                                    @endcan 

                                    @can('approve as dg')
                                        @if ($selRequisition->status=='hod_approved' || $selRequisition->status=='special_duty_head_approved')
                                            <input type="button"  wire:click="dgApproveRequisition('{{ $selRequisition->id }}')" value="{{ __('Approve as DG') }}" class="btn  btn-primary btn-sm ">
                                        @endif
                                    @endcan 

                                    @can('approve as bursar')
                                        @if ($selRequisition->status=='dg_approved')
                                            <input type="button"  wire:click="bursarApproveRequisition('{{ $selRequisition->id }}')" value="{{ __('Approve as Bursar') }}" class="btn  btn-primary btn-sm ">
                                        @endif
                                    @endcan 
                                    @can('approve as pv')
                                        @if ($selRequisition->status=='bursar_approved')
                                            <input type="button" wire:click="pvApproveRequisition('{{ $selRequisition->id }}')" value="{{ __('Approve as PV') }}" class="btn  btn-primary btn-sm ">
                                        @endif
                                    @endcan 
                                    @can('approve as audit')
                                        @if ($selRequisition->status=='pv_approved')
                                            <input type="button" wire:click="auditApproveRequisition('{{ $selRequisition->id }}')" value="{{ __('Approve as Audit') }}" class="btn  btn-primary btn-sm ">
                                        @endif
                                    @endcan 
                                    @can('approve as cash office')
                                        @if ($selRequisition->status=='audit_approved')
                                            <input type="button" wire:click="cashOfficeApproveRequisition('{{ $selRequisition->id }}')" value="{{ __('Pay') }}" class="btn  btn-primary btn-md ">
                                        @endif
                                    @endcan      
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
