@section('page-title')
    Payment Recommendation
@endsection
    @push('script-page')
        </script>

        <script>
            function copyToClipboard(element) {

                var copyText = element.id;
                navigator.clipboard.writeText(copyText);
                show_toastr('success', 'Url copied to clipboard', 'success');
            }
        </script>
    @endpush
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
        <li class="breadcrumb-item"><a href="{{route('project.contracts')}}">{{__('Contracts')}}</a></li>
        <li class="breadcrumb-item">Dashboard</li>
    @endsection

    {{-- @can('recommend payment') --}}
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title" id="applyLeave">Payment for Recommendation Contract {{\Auth::user()->contractNumberFormat($contract->id)}}</h5>
                        <p><strong>Remaining Balance:</strong> ₦ {{ number_format($contract->value - $contract->amount_paid_to_date,2) }}</p>
                    </div>
                    @if (($contract->value - $contract->amount_paid_to_date )!=0)
                        <div class="card-body pt-0">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('name', __('Project Name'), ['class' => 'form-label']) }}
                                    <input type="text" id="project_name" value="{{ $contract->projects->project_name }}"
                                        disabled class="form-control" placeholder="Project Name" />
                                    @error('project_name')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            @foreach ($contract->projects->boqs as $key => $input)
                                <div class="row mb-2">
                                    <div class="@can('recommend payment') col-md-3 @else col-md-6 @endcan">
                                        @if($loop->first)
                                            <label for="" class="text-primary"><b>Item</b></label>
                                        @endif
                                        <input type="text"
                                            @error('inputs.' . $key . '.item') style="border-color: red" @enderror
                                            id="input_{{ $key }}_item"
                                            id="input_{{ $key }}_item"
                                            wire:model.defer="inputs.{{ $key }}.item"
                                            class="form-control" readonly />
                                    </div>
                                    <div class="col-md-2">
                                        @if($loop->first)
                                            <label for="" class="text-primary"><b>Unit Price</b></label>
                                        @endif
                                        <input type="text"
                                            @error('inputs.' . $key . '.unit_price') style="border-color: red" @enderror
                                            id="input_{{ $key }}_unit_price"
                                            id="input_{{ $key }}_unit_price"
                                            wire:model="inputs.{{ $key }}.unit_price"
                                            class="form-control" readonly />
                                    </div>
                                    <div class="col-md-1">
                                        @if($loop->first)
                                            <label for="" class="text-primary"><b>Quantity</b></label>
                                        @endif
                                        <input type="text"
                                            @error('inputs.' . $key . '.quantity') style="border-color: red" @enderror
                                            id="input_{{ $key }}_quantity"
                                            id="input_{{ $key }}_quantity"
                                            wire:model="inputs.{{ $key }}.quantity"
                                            class="form-control" readonly />
                                    </div>

                                    <div class="col-md-2">
                                        @if($loop->first)
                                            <label for="" class="text-primary"><b>Remaining Balance</b></label>
                                        @endif
                                        <input type="text" wire:model="inputs.{{ $key }}.remaining_balance" class="form-control" readonly>
                                    </div>

                                    @can('recommend payment')
                                        <div class="col-md-2">
                                            @if($loop->first)
                                                <label for="" class="text-primary"><b>Amount</b></label>
                                            @endif
                                            <input type="text" value="{{ number_format($inputs[$key]['recommended_amount'],2 ?? '') }}" class="form-control" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            @if($loop->first)
                                                <label for="" class="text-primary"><b>Percentage to pay</b></label>
                                            @endif
                                            <input type="number" wire:model.defer="inputs.{{ $key }}.percentage"
                                            wire:change="updatePayment({{ $key }})" class="form-control" min="0" max="100">
                                        </div>
                                    @endcan
                                </div>
                            @endforeach
                            @can('recommend payment')
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mt-2">
                                            <label for="vatRate"><b>VAT Rate (%)</b></label>
                                            <input type="number" wire:model="vatRate" wire:change="calculateVAT" min="0" max="100" step="0.01" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mt-2">
                                            <label><b>VAT Amount (₦)</b></label>
                                            <input type="number" disabled wire:model="vatAmount" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>

                        @can('recommend payment')
                            <div class="row m-2">
                                <div class="col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center justify-content-between">
                                                <div class="col-auto mb-3 mb-sm-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="theme-avtar bg-primary">
                                                            <i class="ti ti-report-money"></i>
                                                        </div>
                                                        <div class="ms-3">
                                                            <small class="text-muted">{{ __('Sub Total') }}</small>
                                                            <h6 class="m-0">{{ __('SUB TOTAL') }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto text-end">
                                                    <h4 class="m-0">₦ {{ number_format($cumulativeTotal,2)  }}</h4>
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
                                                    <div class="d-flex align-items-center">
                                                        <div class="theme-avtar bg-success">
                                                            <i class="ti ti-report-money"></i>
                                                        </div>
                                                        <div class="ms-3">
                                                            <small class="text-muted">{{ __('GRAND TOTAL') }}</small>
                                                            <h6 class="m-0">{{ __('GRAND TOTAL') }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto text-end">
                                                    <h4 class="m-0">{{ number_format($totalWithVAT,2) }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer m-3">
                                <div wire:loading wire:target="saveRecommendations"><x-g-loader /></div>
                                <input type="button" wire:click="saveRecommendations" value="{{ __('Recommend Payment') }}" class="btn  btn-primary">
                            </div>
                        @endcan
                    @else
                        <h4 class="text-success" align="center">Contract fully paid.</h4>
                    @endif
                </div>
            </div>
        </div>
    {{-- @endcan --}}

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header"><h4>Payment Recommendation History</h4></div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Contract</th>
                                    <th>Amount</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recommendations as $recommendation)
                                    @if ($recommendation)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ($recommendation->contract->projects->project_name) }}</td>
                                            <td>₦{{ number_format($recommendation->recommended_amount,2) }}</td>
                                            <td>{{ ($recommendation->remarks) }}</td>
                                            <td>
                                                <span class="badge @if($recommendation->status=='Pending') bg-warning
                                                    @elseif ($recommendation->status=='paid') bg-success
                                                    @elseif ($recommendation->status=='Rejected') bg-danger
                                                    @else bg-warning
                                                    @endif p-2 px-3 rounded">
                                                    {{ ($recommendation->status) }}
                                                </span>
                                            </td>
                                            <td>{{ ($recommendation->created_at) }}</td>
                                            <td>
                                                @if($recommendation->status == 'voucher_raised' || $recommendation->status == 'audited' || $recommendation->status == 'paid')
                                                    <button class="btn btn-success btn-sm" type="submit" target="popup"
                                                    onclick="window.open('{{ route('contracts.voucher', $recommendation->id) }}','popup', 'width=994, height=1123')">
                                                    <i class="fa fa-print"> Print Voucher</i> 
                                                    </button>
                                                @endif

                                                @if (Auth::user()->type=='dg' && $recommendation->status == 'recommended')
                                                    @can('approve payment')
                                                        <a href="{{ route('payment-requests.approve', $recommendation->id) }}" class="btn btn-success btn-sm">
                                                            <i class="ti ti-check"></i> Approve Payment
                                                        </a>
                                                    @endcan
                                                @endif

                                            @if($recommendation->status == 'approved' && $recommendation->isCompleted == false && $contract->amount_paid_to_date != $contract->value)
                                                @can('bursar approval')
                                                <a href="{{ route('payment-requests.sign', $recommendation->id) }}" class="btn btn-success btn-sm">
                                                    <i class="ti ti-check"></i> Bursar Sign
                                                </a>
                                                @endcan
                                            @endif

                                            @if($recommendation->status == 'signed' && $recommendation->isCompleted == false && $contract->amount_paid_to_date != $contract->value)
                                                @can('raise contract voucher')
                                                    <a href="{{ route('payment-requests.voucher', $recommendation->id) }}" class="btn btn-success btn-sm">
                                                        <i class="ti ti-check"></i> Raise Voucher
                                                    </a>
                                                @endcan
                                            @endif

                                            @if($recommendation->status == 'voucher_raised' && $recommendation->isCompleted == false && $contract->amount_paid_to_date != $contract->value)
                                                @can('audit approval')
                                                    <a href="{{ route('payment-requests.audit', $recommendation->id) }}" class="btn btn-success btn-sm">
                                                            <i class="ti ti-check"></i> Audit Stamp
                                                        </a>
                                                @endcan
                                            @endif

                                            @if($recommendation->status == 'audited' && $recommendation->isCompleted == false && $contract->amount_paid_to_date != $contract->value)
                                                @can('make payment')
                                                    <a href="{{ route('payment-requests.finalize', $recommendation->id) }}" class="btn btn-success btn-sm">
                                                        <i class="ti ti-check"></i> Make Payment
                                                    </a>
                                                @endcan
                                            @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
             </div>
        </div>
        <x-toast-notification />
    </div>
