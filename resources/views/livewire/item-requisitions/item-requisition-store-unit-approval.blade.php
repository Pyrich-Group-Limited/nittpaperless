<div>
    @section('page-title')
        {{ __('Item Requsitions for Store Approval') }}
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item">{{ __('Item Requsitions') }}</li>
    @endsection

    <div class="mt-2">
        <a href="#" class="btn btn-sm btn-primary action-item" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ti ti-filter"></i>
        </a>
        <div class="dropdown-menu  dropdown-steady" id="project_sort" wire:change="setFilter($event.target.value)">
            <a class="dropdown-item {{ $filter === 'all' ? 'active' : '' }}" href="#" wire:click="setFilter('all')" data-val="created_at-desc">
                <i class="ti ti-sort-descending"></i>{{__('All')}}
            </a>
            <a class="dropdown-item {{ $filter === 'pending' ? 'active' : '' }}"  href="#" wire:click="setFilter('pending')" data-val="created_at-desc">
                <i class="ti ti-sort-descending"></i>{{__('Pending')}}
            </a>
            <a class="dropdown-item {{ $filter === 'approved' ? 'active' : '' }}"  href="#" wire:click="setFilter('approved')" data-val="created_at-asc">
                <i class="ti ti-sort-ascending"></i>{{__('Approved')}}
            </a>
            <a class="dropdown-item {{ $filter === 'rejected' ? 'active' : '' }}" href="#" wire:click="setFilter('rejected')" data-val="created_at-asc">
                <i class="ti ti-sort-ascending"></i>{{__('Rejected')}}
            </a>
        </div>
    </div>

    <div class="center" align="center">
        <div wire:loading wire:target="setFilter"><x-g-loader /></div>
    </div>

    <div class="row mt-1">
        <div class="col-md-12 mt-1">
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
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requisitions as $index => $requisition)
                                    <tr class="font-style">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $requisition->department->name }}</td>
                                        <td>{{ $requisition->staff->name }}</td>
                                        <td>
                                            @if ($requisition->status == 'store_approved')
                                                <span class="badge bg-success p-2 px-3 rounded">{{ $requisition->status }}</span>
                                            @else
                                                <span class="badge bg-warning p-2 px-3 rounded">{{ $requisition->status }}</span>
                                            @endif
                                        </td>

                                        <td>{{ $requisition->items->count() }}</td>
                                        
                                        <td class="Action">
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" wire:click="selectRequisition({{ $requisition->id }})" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" id="toggleApplicantDetails" 
                                                    data-bs-target="#storeApprovalView" data-size="lg" data-bs-toggle="tooltip" title="{{__('Item Requisition Details')}}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
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
    @include('livewire.item-requisitions.modals.store-approval-modal')
    <x-toast-notification />
</div>


