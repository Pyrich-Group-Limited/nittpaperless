<div id="viewBudget">
    <div class="modal" id="viewDtaIformationModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title"> DTA REQUEST INFORMATION </h5>
                    </div>
                    <div class="modal-body">
                        @if ($selDta)
                            <div class="row">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>{{__('Staff Name')}}</th>
                                                <td>{{ $selDta->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('DTA Destination')}}</th>
                                                <td>{{ $selDta->destination }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('Number of Days')}}</th>
                                                <td>{{ round(strtotime($selDta->arrival_date) - strtotime($selDta->travel_date) ) / 86400}} Days</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('Travel Date')}}</th>
                                                <td>{{ date('d-M-Y', strtotime($selDta->travel_date)) }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('Arrival Date')}}</th>
                                                <td>{{ date('d-M-Y', strtotime($selDta->arrival_date)) }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('Estimated Expenses')}}</th>
                                                <td>₦ {{ number_format($selDta->estimated_expense,2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('Approval Status')}}</th>
                                                <td>
                                                    @if ($selDta->status == 'pending')
                                                    <span class="badge bg-warning p-2 px-3 rounded">Pending</span>
                                                    @elseif ($selDta->status == 'approved')
                                                    <span class="badge bg-success p-2 px-3 rounded">Approved</span>
                                                    @elseif ($selDta->status == 'rejected')
                                                    <span class="badge bg-danger p-2 px-3 rounded">Rejected</span>
                                                    @else
                                                    <span class="badge bg-info p-2 px-3 rounded">
                                                        {{ $selDta->status }}
                                                    </span>
                                                    @endif

                                                </td>
                                            </tr>

                                            <tr>
                                                <th>{{__('Date of Request')}}</th>
                                                <td>{{ $selDta->created_at->format('d-M-Y') }}</td>
                                            </tr>

                                            <tr >
                                                <th>{{__('DTA Purpose')}}</th>
                                                <td style="overflow-wrap: break-word; word-break: break-word; white-space: normal;">
                                                    {{ $selDta->purpose }}
                                                </td>
                                            </tr>

                                            {{-- @if($selDta->supporting_document==null)
                                                    <tr>
                                                        <th>Supporting Document</th>
                                                        <td class="text-warning">No supporting document uploaded for this requisition.</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <th>Supporting Document</th>
                                                        <td class="text-end">
                                                            <a href="{{ asset('assets/documents/documents') }}/{{$selDta->supporting_document}}" target="_blank" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>
                                                            <a href="#" wire:click="downloadFile('{{ $selDta->supporting_document }}')" class="btn btn-primary btn-sm"><i class="ti ti-download"></i></a>
                                                        </td>
                                                    </tr>
                                            @endif --}}

                                        </table>
                                    </div>
                            </div>
                                @if ($selDta->status=='rejected')
                                    <div class="form-group">
                                        <label class="form-label" for="exampleFormControlTextarea1">{{__('Rejection Comment')}}</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" readonly>{{ $selDta->comment }}</textarea>
                                    </div>
                                @endif
                                @if ($selDta->status=='bursar_approved')
                                    @can('pv approve')
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

                                @if ($selDta->status=='audit_approved')
                                    @can('final account approve')
                                        <div class="form-group">
                                            {{ Form::label('paymentEvidence', __('Upload Payment Evidence'), ['class' => 'form-label']) }}
                                            <input type="file" id="paymentEvidence" wire:model.defer="paymentEvidence"
                                                class="form-control" placeholder="Payment Evidence" />
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
                                <div wire:loading wire:target="specialDutyHeadApproveDta"><x-g-loader /></div>
                                <div wire:loading wire:target="unitHeadApproveDta"><x-g-loader /></div>
                                <div wire:loading wire:target="hodApproveDta"><x-g-loader /></div>
                                <div wire:loading wire:target="liasonHeadApproveDta"><x-g-loader /></div>
                                <div wire:loading wire:target="dgApproveDta"><x-g-loader /></div>
                                <div wire:loading wire:target="bursarApproveDta"><x-g-loader /></div>
                                <div wire:loading wire:target="pvApproveDta"><x-g-loader /></div>
                                <div wire:loading wire:target="auditApproveDta"><x-g-loader /></div>
                                <div wire:loading wire:target="cashOfficeApproveDta"><x-g-loader /></div>


                                <input type="button" id="closeRequisitionDetails" value="{{ __('Close') }}"
                                    class="btn  btn-light btn-sm" data-bs-dismiss="modal">
                                    @can('unit head approve')
                                        @if ($selDta->status=='pending')
                                            <input type="button" wire:click="unitHeadApproveDta({{ $selDta->id }})" value="{{ __('Approve as Unit Head') }}" class="btn  btn-primary btn-sm">
                                        @endif
                                    @endcan

                                    @can('hod approve')
                                        @if ($selDta->status=='unit_head_approved')
                                            <input type="button" wire:click="hodApproveDta({{ $selDta->id }})" value="{{ __('Approve as HoD') }}" class="btn  btn-primary btn-sm">
                                        @endif
                                    @endcan

                                    @can('liaison approve')
                                        @if ($selDta->status=='liaison_head_approval')
                                            <input type="button" wire:click="liasonHeadApproveDta({{ $selDta->id }})" value="{{ __('Approve as Liason Head') }}" class="btn  btn-primary btn-sm">
                                        @endif
                                    @endcan

                                    @can('special duty approve')
                                        @if ($selDta->status=='liaison_head_approved')
                                            <input type="button" wire:click="specialDutyHeadApproveDta({{ $selDta->id }})" value="{{ __('Approve as Special Duty') }}" class="btn  btn-primary btn-sm">
                                        @endif
                                    @endcan

                                    @can('dg approve')
                                        @if ($selDta->status=='hod_approved' || $selDta->status=='special_duty_approved')
                                            <input type="button"  wire:click="dgApproveDta('{{ $selDta->id }}')" value="{{ __('Approve as DG') }}" class="btn  btn-primary btn-sm ">
                                        @endif
                                    @endcan

                                    @can('bursar approve')
                                        @if ($selDta->status=='dg_approved')
                                            <input type="button" wire:click="bursarApproveDta('{{ $selDta->id }}')" value="{{ __('Approve as Bursar') }}" class="btn  btn-primary btn-sm ">
                                        @endif
                                    @endcan
                                    @can('pv approve')
                                        @if ($selDta->status=='bursar_approved')
                                            <input type="button" wire:click="pvApproveDta('{{ $selDta->id }}')" value="{{ __('Approve as PV') }}" class="btn  btn-primary btn-sm ">
                                        @endif
                                    @endcan
                                    @can('audit approve')
                                        @if ($selDta->status=='pv_approved')
                                            <input type="button" wire:click="auditApproveDta('{{ $selDta->id }}')" value="{{ __('Approve as Audit') }}" class="btn  btn-primary btn-sm ">
                                        @endif
                                    @endcan
                                    @can('final account approve')
                                        @if ($selDta->status=='audit_approved')
                                            <input type="button" wire:click="cashOfficeApproveDta('{{ $selDta->id }}')" value="{{ __('Pay') }}" class="btn  btn-primary btn-md ">
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

    <div class="modal" id="secretCodeModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title"> Verify Secret Code to Append Signature </h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="secretCode">{{ __('Enter Secret Code') }}</label>
                                <input wire:model="secretCode" type="password" class="form-control @error('secretCode') is-invalid @enderror">
                                @error('secretCode') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="verifyAndApprove"><x-g-loader /></div>
                        <input type="button" id="closeVerifyModal" value="{{ __('Cancel') }}" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="verifyAndApprove" value="{{ __('Approve') }}"
                            class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            window.addEventListener('showSecretCodeModal', function () {
                $('#viewDtaIformationModal').modal('hide'); // Close the first modal
                $('#secretCodeModal').modal('show'); // Show the second modal
            });
        });
    </script>

    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeRequisitionDetails").click();
        })
    </script>
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeVerifyModal").click();
        })
    </script>
    <x-toast-notification />
