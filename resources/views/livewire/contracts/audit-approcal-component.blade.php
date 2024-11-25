@section('page-title')
    Auditor Payment Approval
@endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
        <li class="breadcrumb-item"><a href="#">{{__('Auditor')}}</a></li>
    @endsection

    <div class="row">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="applyLeave">Auditor Stamp Payment Recommendation for Contract {{\Auth::user()->contractNumberFormat($paymentRequest->contract->id)}} </h5>
                </div>
                <div class="card-body pt-0">
                    {{-- <div>
                        <label for="remarks"><b>Remarks</b></label>
                        <textarea wire:model="remarks" class="form-control"></textarea>
                    </div> --}}
                    <div class="modal-footer mt-3">
                        <div wire:loading wire:target="auditStamp"><x-g-loader /></div>
                        <input type="button" wire:click="auditStamp" value="{{ __('Audit Stamp') }}" class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
        <x-toast-notification />
    </div>