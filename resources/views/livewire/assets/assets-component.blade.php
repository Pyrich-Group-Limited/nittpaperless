<div>
    @php
   $profile=\App\Models\Utility::get_file('uploads/avatar');
   @endphp
@section('page-title')
    {{__('Assets')}}
@endsection

@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Assets')}}</li>
@endsection
@section('action-btn')
    @can('create stock')
    <div class="float-end">
        <!-- {{-- data-url="{{ route('users.create') }}" --}} -->
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newAsset" id="toggleOldUser"  data-bs-toggle="tooltip" title="{{__('Add Asset')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
    </div>
    @endcan
@endsection

{{-- @section('content') --}}
    <div class="col-xl-12 mt-5">
            <div class="row">
                <div class="col-md-9">
                    <x-search-bar wire:model.live="searchTerm" placeholder="Search by Asset Description or Select a search criterial to search assets" />
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mt-2">
                    <select style="padding: 14px" wire:model.live="searchBy" class="form-control">
                        <option value="">--Select Filter--</option>
                        <option value="asset_type">Asset Type</option>
                        <option value="asset_identification_code">Asset Code</option>
                        <option value="model_number">Model Number</option>
                        <option value="location">Location</option>
                        <option value="year_of_manufacture">Year</option>
                    </select>
                </div>
            </div>
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{__('#')}}</th>
                            <th>{{__('Description')}}</th>
                            <th>{{__('Location')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Serial Number')}}</th>
                            <th>{{__('Model')}}</th>
                            <th>{{__('Initial Value')}}</th>
                            <th>{{__('Status')}}</th>
                            <th class="text-end">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($assets) > 0)
                            @foreach ($assets as $key => $asset)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $asset->asset_description }}</td>
                                    <td>{{ $asset->location }}</td>
                                    <td>{{ $asset->number_of_units }}</td>
                                    <td>{{ $asset->serial_number }}</td>
                                    <td>{{ $asset->model_number }}</td>
                                    <td>₦{{ number_format($asset->initial_cost,2) }}</td>
                                                                        <td class="">
                                        <span class="badge @if($asset->appreciation>0) bg-success
                                            @elseif($asset->depreciation>0) bg-danger
                                            @else ($project->status=='in_progress') bg-info
                                            @endif p-2 px-3 rounded">@if($asset->appreciation>0) Appreciated @elseif($asset->depreciation>0) Depreciated @else Stable @endif</span>


                                    </td>
                                    <td class="text-end">
                                        <span>
                                            @can('view stock')
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#viewAssetModal"  wire:click="setSelectedAsset({{ $asset }})" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="" data-ajax-popup="false" data-size="lg" data-bs-toggle="tooltip" title="{{__('Show Details')}}" data-title="{{__('Show Details')}}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                            @endcan
                                            @can('edit stock')
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editAssetModal"  wire:click="setSelectedAsset({{ $asset }})" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="" data-ajax-popup="false" data-size="lg" data-bs-toggle="tooltip" title="{{__('Edit Asset')}}" data-title="{{__('Edit Asset')}}">
                                                    <i class="ti ti-edit text-white"></i>
                                                </a>
                                            </div>
                                            @endcan
                                            @can('manage stock')
                                            <div class="action-btn bg-danger ms-2">
                                                <a href="#" wire:click="setActionId('{{ $asset->id }}')" class="mx-3 btn btn-sm d-inline-flex align-items-center confirm-delete" data-url="" data-ajax-popup="false" data-size="lg" data-bs-toggle="tooltip" title="{{__('Delete Asset')}}" data-title="{{__('Delete Asset')}}">
                                                    <i class="ti ti-trash text-white"></i>
                                                </a>
                                            </div>
                                            @endcan
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th scope="col" colspan="8"><h6 class="text-center">{{__('No Assets.')}}</h6></th>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


{{-- @endsection --}}

<x-toast-notification />
@include('livewire.assets.modals.new-asset-modal')
@include('livewire.assets.modals.edit-asset-modal')
@include('livewire.assets.modals.view-asset-modal')
</div>
