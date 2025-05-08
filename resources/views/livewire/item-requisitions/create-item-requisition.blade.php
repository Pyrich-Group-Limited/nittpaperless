<div>
    @section('page-title')
        {{ __('Store Requsition Notes') }}
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item">{{ __('Store Requsition Notes') }}</li>
    @endsection
   
        <div class="d-flex justify-content-end gap-2">
            <a href="#" class="btn btn-primary" id="applyLeaveButton" data-bs-toggle="modal" data-bs-target="#newItemRequisition"
                data-size="lg " data-bs-toggle="tooltip">
                <i class="ti ti-plus text-white"></i>New SRN
            </a>
        </div>

    <div class="center">
        <div wire:loading wire:target="setFilter"><x-g-loader /></div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Employee Name') }}</th>
                                    <th>{{ __('Employee Department') }}</th>
                                    <th>{{ __('Request Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($itemRequisitions as $itemRequisition)
                                    <tr class="font-style">
                                        <td>{{ $itemRequisition->staff?->name ?? __('N/A') }}</td>
                                        <td>{{ $itemRequisition->department?->name ?? __('N/A') }}</td>
                                        <td>{{ $itemRequisition->created_at->format('d M, Y') }}</td>
                                        <td>
                                            <span
                                                class="badge @if ($itemRequisition->status == 'Pending') bg-warning
                                                    @elseif ($itemRequisition->status == 'Approved') bg-primary
                                                    @elseif ($itemRequisition->status == 'Rejected') bg-danger
                                                    @else bg-warning
                                                    p-2 px-3 rounded">{{ $itemRequisition->status }}
                                                    @endif
                                            </span>
                                        </td>
                                        
                                        <td class="Action">
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" wire:click="setRequisitionItem('{{ $itemRequisition->id }}')"
                                                   class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#viewItemRequisitionDetails"
                                                   data-bs-toggle="tooltip"
                                                   title="{{ __('Item Requisition Details') }}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">{{ __('No item requisitions found.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $itemRequisitions->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('livewire.item-requisitions.modals.create-item-requisition-modal')
    @include('livewire.item-requisitions.modals.item-requisition-details')
    <x-toast-notification />
</div>


