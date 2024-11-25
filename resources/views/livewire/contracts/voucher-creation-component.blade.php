@section('page-title')
    Raise Payment Voucher
@endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
        <li class="breadcrumb-item"><a href="{{route('projects.index')}}">{{__('Contractor')}}</a></li>
    @endsection

    <div class="row">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="applyLeave">Reaise Payment Voucher for Contract {{\Auth::user()->contractNumberFormat($paymentRequest->contract->id)}} </h5>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <label for="chartAccount"><b>Account to Debit</b></label>
                        <select wire:model.defer="chartAccount" class="form-control">
                            <option value="">Select account to Debit</option>
                            @foreach ($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}  - ({{ $account->code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer mt-3">
                        <div wire:loading wire:target="createVoucher"><x-g-loader /></div>
                        <input type="button"  wire:click="createVoucher" value="{{ __('Raise Voucher') }}" class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
        <x-toast-notification />
    </div>