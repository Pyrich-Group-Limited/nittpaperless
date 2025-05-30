@section('page-title')
   Contractor Payment
@endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
        <li class="breadcrumb-item"><a href="#">{{__('Payment')}}</a></li>
        <li class="breadcrumb-item">Dashboard</li>
    @endsection

    <div class="row">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="applyLeave">Payment for Contract {{\Auth::user()->contractNumberFormat($paymentRequest->contract->id)}} </h5>
                </div>
                <div class="card-body pt-0">
                    {{-- <form wire:submit.prevent="makePayment"> --}}
                        {{-- <div>
                            <label for="percentage"><b>Percentage</b></label>
                            <input type="number" class="form-control" value="{{ $paymentRequest->recommended_percentage }}" wire:model="percentage" wire:change="calculateAmountFromPercentage" min="0" max="100" step="0.01" required>
                        </div> --}}

                        <div class="form-group">
                            <label for="amount"><b>Amount</b></label>
                            <input type="number" wire:model="amount" min="0" max="{{ $paymentRequest->contract->total_contract_sum - $paymentRequest->contract->amount_paid_to_date }}" step="0.01" class="form-control" required>
                        </div>

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

                        <div class="form-group">
                            <label for="remarks"><b>Remark (Optional)</b></label>
                            <textarea wire:model="remarks" class="form-control"></textarea>
                        </div>

                        <div class="modal-footer mt-3">
                            <div wire:loading wire:target="finalizePayment"><x-g-loader /></div>
                            <input type="button"  wire:click="finalizePayment" value="{{ __('Make Payment') }}" class="btn  btn-primary">
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-5">
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
        </div> --}}
        <x-toast-notification />
    </div>
