@section('page-title')
    Payment Approval
@endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
        <li class="breadcrumb-item"><a href="{{route('projects.index')}}">{{__('Contractor')}}</a></li>
        <li class="breadcrumb-item">Dashboard</li>
    @endsection

    <div class="row">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="applyLeave">Payment for Approval Contract #{{ $paymentRequest->contract->id }} </h5>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <label for="remarks"><b>Remarks</b></label>
                        <textarea wire:model="remarks" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer mt-3">
                        <div wire:loading wire:target="approve"><x-g-loader /></div>
                        <div wire:loading wire:target="reject"><x-g-loader /></div>
                        <input type="button"  wire:click="approve" value="{{ __('Approve') }}" class="btn  btn-primary">
                        <input type="button"  wire:click="reject" value="{{ __('Reject') }}" class="btn  btn-danger">
                    </div>
                </div>
            </div>
        </div>
        <x-toast-notification />
    </div>