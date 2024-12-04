<div>
    @section('page-title')
        {{ __('Item Requsitions') }}
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Employee Name') }}</th>
                                    <th>{{ __(' Request Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itemRequisitions as $index => $itemRequisition)
                                    <tr class="font-style">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $itemRequisition->staff->name }}</td>
                                        <td>{{ $itemRequisition->created_at }}</td>
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
                                                <a href="#" wire:click="selectRequisition('{{ $itemRequisition->id }}')" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" id="toggleApplicantDetails" 
                                                    data-bs-target="#viewItemRequisitionDetails" data-size="lg" data-bs-toggle="tooltip" title="{{__('Item Requisition Details')}}">
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
    {{-- @include('livewire.item-requisitions.modals.create-item-requisition-modal') --}}
    {{-- @include('livewire.item-requisitions.modals.item-requisition-details') --}}
    @include('livewire.item-requisitions.modals.approval-modal')
    <x-toast-notification />
</div>


