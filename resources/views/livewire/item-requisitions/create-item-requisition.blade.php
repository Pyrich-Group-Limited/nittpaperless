<div>
    @section('page-title')
        {{ __('Item Requsitions') }}
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item">{{ __('Item Requsitions') }}</li>
    @endsection

    {{-- @section('action-btn') --}}
    {{-- <div class="float">
            <a href="#" class="btn btn-sm btn-primary action-item" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti ti-filter"></i>
            </a>
            <div class="dropdown-menu  dropdown-steady" id="project_sort">
                <a class="dropdown-item {{ $filterStatus === 'all' ? 'active' : '' }}" wire:click="setFilter('all')" href="#" data-val="created_at-desc">
                    <i class="ti ti-list"></i>{{__('All')}}
                </a>
                <a class="dropdown-item {{ $filterStatus === 'pending' ? 'active' : '' }}" wire:model="setFilter('pending')" href="#" data-val="created_at-desc">
                    <i class="ti ti-list"></i>{{__('Pending')}}
                </a>
                <a class="dropdown-item {{ $filterStatus === 'pending_dg_approval' ? 'active' : '' }}" wire:click="setFilter('pending_dg_approval')" href="#" data-val="created_at-asc">
                    <i class="ti ti-list"></i>{{__('Pending DG Approval')}}
                </a>
                <a class="dropdown-item {{ $filterStatus === 'approved' ? 'active' : '' }}"  wire:click="setFilter('approved')" href="#" data-val="project_name-desc">
                    <i class="ti ti-list"></i>{{__('Approved')}}
                </a>
                <a class="dropdown-item {{ $filterStatus === 'rejected' ? 'active' : '' }}" wire:click="setFilter('rejected')" href="#" >
                    <i class="ti ti-list"></i>{{__('Rejected')}}
                </a>
            </div>
       
        </div> --}}
    {{-- @endsection --}}
    @section('action-btn')
        <div class="float-end">
            <a href="#" class="btn btn-primary" id="applyLeaveButton" data-bs-toggle="modal" data-bs-target="#newItemRequisition"
                data-size="lg " data-bs-toggle="tooltip">
                <i class="ti ti-plus text-white"></i>New Requisition
            </a>
        </div>
    @endsection

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
                                    <th>{{ __(' Request Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itemRequisitions as $itemRequisition)
                                    <tr class="font-style">
                                        <td>{{ $itemRequisition->staff->name }}</td>
                                        <td>{{ $itemRequisition->departments->name }}</td>
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
                                                <a href="#" wire:click="setLeave('{{ $itemRequisition->id }}')" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" id="toggleApplicantDetails" 
                                                    data-bs-target="#leaveDetailsModal" data-size="lg" data-bs-toggle="tooltip" title="{{__('Leave Applicaiton Details')}}">
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
    @include('livewire.item-requisitions.modals.create-item-requisition-modal')
    <x-toast-notification />
</div>


