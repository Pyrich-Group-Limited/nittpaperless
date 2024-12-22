<div>
    @section('page-title')
        {{ __('Requisitions Awaiting Acknowledgment') }}
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item">{{ __('Item Requsitions') }}</li>
    @endsection
    <div class="row mt-3">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Department') }}</th>
                                    <th>{{ __('Requester') }}</th>
                                    <th>{{ __('Items') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requisitions as $index => $requisition)
                                    <tr class="font-style">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $requisition->department->name }}</td>
                                        <td>{{ $requisition->staff->name }}</td>
                                        <td>{{ $requisition->items->count() }}</td>
                                        
                                        <td class="Action">
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" wire:click="selectRequisition({{ $requisition->id }})" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" id="toggleApplicantDetails" 
                                                    data-bs-target="#viewItemToAcknowledge" data-size="lg" data-bs-toggle="tooltip" title="{{__('View')}}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                            {{-- @can('print SIV')     --}}
                                                <button class="btn btn-success btn-sm" type="submit" target="popup" 
                                                onclick="window.open('{{ route('itemRequisition.voucher', $requisition->id) }}','popup', 'width=994, height=1123')">
                                                <i class="fa fa-print"></i> Print Voucher
                                                </button>
                                            {{-- @endcan --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('livewire.item-requisitions.modals.item-acknowledge')
    <x-toast-notification />
</div>


