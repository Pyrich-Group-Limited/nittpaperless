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
        <li class="breadcrumb-item"><a href="{{route('projects.index')}}">{{__('Contractor')}}</a></li>
        <li class="breadcrumb-item">Dashboard</li>
    @endsection

    @can('recommend payment')
        <div class="row">
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title" id="applyLeave">Payment for Recommendation Contract #{{ $contract->id }} </h5>
                        <p><strong>Remaining Balance:</strong> ₦ {{ number_format($contract->value - $contract->amount_paid_to_date,2) }}</p>
                    </div>
                    @if (($contract->value - $contract->amount_paid_to_date )!=0)
                        <div class="card-body pt-0">
                                <div>
                                    <label for="percentage"><b>Percentage</b></label>
                                    <input type="number" class="form-control" wire:model="recommendedPercentage" wire:change="calculateAmountFromPercentage" min="0" max="100" step="0.01" required>
                                </div>
                        
                                <div>
                                    <label for="amount"><b>Amount (₦)</b></label>
                                    <input type="number" wire:model="recommendedAmount" min="0" max="{{ $contract->value - $contract->amount_paid_to_date }}" step="0.01" class="form-control" required>
                                </div>

                                <div class="form-check mt-3">
                                    <input type="checkbox" wire:model="includeVAT" id="includeVAT" class="form-check-input">
                                    <label for="includeVAT" class="form-check-label"><b>Apply VAT ?</b></label>
                                </div>

                                @if($includeVAT)
                                    <div class="mt-2">
                                        <label for="vatRate"><b>VAT Rate (%)</b></label>
                                        <input type="number" wire:model="vatRate" disabled wire:change="calculateVAT" min="0" max="100" step="0.01" class="form-control">
                                    </div>
                                    <div class="mt-2">
                                        <label><b>VAT Amount (₦)</b></label>
                                        <input type="number" wire:model="vatAmount" disabled class="form-control" readonly>
                                    </div>
                                @endif

                                <div class="mt-2">
                                    <label><b>Total Amount (₦)</b></label>
                                    <input type="number" wire:model="totalAmount" disabled class="form-control" readonly>
                                </div>
                        
                                <div>
                                    <label for="remarks"><b>Remarks</b></label>
                                    <textarea wire:model="remarks" class="form-control"></textarea>
                                </div>
            
                                <div class="modal-footer mt-3">
                                    <div wire:loading wire:target="recommendPayment"><x-g-loader /></div>
                                    <input type="button"  wire:click="recommendPayment" value="{{ __('Recommend Payment') }}" class="btn  btn-primary">
                                </div>
                        </div>
                    @else
                        <h4 class="text-success" align="center">Contract fully paid.</h4>
                    @endif
                </div>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header"><h4>Payment Request History</h4></div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Percentage</th>
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
                                            <td>{{ ($recommendation->recommended_percentage) }}</td>
                                            <td>₦{{ number_format($recommendation->recommended_amount,2) }}</td>
                                            <td>{{ ($recommendation->remarks) }}</td>
                                            <td>{{ ($recommendation->status) }}</td>
                                            <td>{{ ($recommendation->created_at) }}</td>
                                            <td>
                                                @if($recommendation->status == 'voucher_raised' || $recommendation->status == 'audited' || $recommendation->status == 'paid')
                                                    @can('print voucher')    
                                                        <button class="btn btn-success btn-sm" type="submit" target="popup" 
                                                        onclick="window.open('{{ route('contracts.voucher', $recommendation->id) }}','popup', 'width=994, height=1123')">
                                                        <i class="fa fa-print"></i> Print Voucher
                                                        </button>
                                                    @endcan
                                                @endif

                                                @if (Auth::user()->type=='DG' && $recommendation->status == 'recommended')
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