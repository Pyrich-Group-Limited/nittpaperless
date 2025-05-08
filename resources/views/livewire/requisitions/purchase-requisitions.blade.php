@php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{__('Purchase Requisition')}}
@endsection
@push('script-page')

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Requisition')}}</li>
@endsection
    <div class="d-flex justify-content-end gap-2">
        @can('request purchase requisition')
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newPurchaseRequisition" id="toggleOldUser"  data-bs-toggle="tooltip" title="{{__('Create')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>


<div>
    <div class="row">
        <div class="col-xl-12">
            <x-search-bar wire:model.live="searchTerm" placeholder="Search by staff name, department or units" />

            <div class="card mt-4">
                <div class="card-body table-border-style">
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('SN') }}</th>
                                    <th>{{ __('Comment') }}</th>
                                    <th>{{ __('Requested By') }}</th>
                                    <th>{{ __('Last Requisition') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Date Requested') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($requisitions)>0)
                                    @foreach ($requisitions as $requisition)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $requisition->comment }}</td>
                                            <td>{{ $requisition->user->name }}</td>
                                            <td>{{ $requisition->last_date->format('d M, Y') }}</td>
                                            <td>{{ $requisition->status }}</td>
                                            <td>{{ $requisition->created_at->format('d M, Y') }}</td>
                                            <td>
                                                <div class="card-header-right">
                                                    <div class="btn-group card-option">
                                                        <button type="button" class="btn dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            @can('manage purchase requisition')
                                                            <a href="#" wire:click="viewRequest({{ $requisition }})" data-bs-toggle="modal" data-bs-target="#viewRequisition" class="dropdown-item" data-bs-original-title="{{__('Edit Permission')}}">
                                                                <i class="ti ti-pencil"></i>
                                                                <span>{{__('View Permission')}}</span>
                                                            </a>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>

                                    @endforeach
                                @else
                                    <tr>
                                        <th scope="col" colspan="9">
                                            <h6 class="text-center">{{ __('No Record Found.') }}</h6>
                                        </th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="paginate">{{ $requisitions->links('pagination::bootstrap-5') }}</div>
                </div>
            </div>
        </div>
    </div>
@include('livewire.requisitions.modals.new-purchase-requisition')
@include('livewire.requisitions.modals.view-requisition-items')
</div>
