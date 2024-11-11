@section('page-title')
   Contractor Payment
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

    <div class="row">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="applyLeave">Payment for Contract #{{ $contract->id }} </h5>
                </div>
                <div class="card-body pt-0">
                    {{-- <form wire:submit.prevent="makePayment"> --}}
                        <div>
                            <label for="percentage"><b>Percentage</b></label>
                            <input type="number" class="form-control" wire:model="percentage" wire:change="calculateAmountFromPercentage" min="0" max="100" step="0.01" required>
                        </div>
                
                        <div>
                            <label for="amount"><b>Amount</b></label>
                            <input type="number" wire:model="amount" min="0" max="{{ $contract->total_contract_sum - $contract->amount_paid_to_date }}" step="0.01" class="form-control" required>
                        </div>
                
                        <div>
                            <label for="remarks"><b>Remarks</b></label>
                            <textarea wire:model="remarks" class="form-control"></textarea>
                        </div>
    
                        <div class="modal-footer mt-3">
                            <div wire:loading wire:target="makePayment"><x-g-loader /></div>
                            <input type="button"  wire:click="makePayment" value="{{ __('Make Payment') }}" class="btn  btn-primary">
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-5">
            <div class="card">
                <div class="card-header"><h4>Payment History</h4></div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount Paid</th>
                                    <th>Remaining Balance</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentHistory as $payment)
                                    <tr>
                                        <td>{{ $payment->payment_date }}</td>
                                        <td>₦{{ number_format($payment->amount_paid,2) }}</td>
                                        <td>₦{{ number_format($payment->remaining_balance,2) }}</td>
                                        <td>{{ $payment->remarks }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
             </div>
        </div>
        <x-toast-notification />
    </div>