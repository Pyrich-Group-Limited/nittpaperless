<div>
{{-- @extends('layouts.admin') --}}
    @php
    //  $profile=asset(Storage::url('uploads/avatar/'));
    $profile=\App\Models\Utility::get_file('uploads/avatar');
    @endphp
    @section('page-title')
        {{__('Manage Contractors')}}
    @endsection
    @push('script-page')
    @endpush
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
        <li class="breadcrumb-item">{{__('Contractors')}}</li>
    @endsection
    @section('action-btn')
        <div class="float-end">
            {{-- <a href="#" data-size="md" data-url="{{ route('clients.create') }}" data-ajax-popup="true"  data-bs-toggle="tooltip" title="{{__('Create')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a> --}}
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newContractor" id="toggleOldProject"  data-bs-toggle="tooltip" title="{{__('Create New Contractor')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    @endsection
{{-- @section('content') --}}
    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                @foreach($contractors as $contractor)
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header border-0 pb-0">

                                <div class="card-header-right">
                                    <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end">
{{--                                            <a href="{{ route('clients.show',$contractor->id) }}"  class="dropdown-item" data-bs-original-title="{{__('View')}}">--}}
{{--                                                <i class="ti ti-eye"></i>--}}
{{--                                                <span>{{__('Show')}}</span>--}}
{{--                                            </a>--}}

                                            {{-- @can('edit contractor') --}}
                                                <a href="#!" data-size="md" data-url="{{ route('clients.edit',$contractor->id) }}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Edit User')}}">
                                                    <i class="ti ti-pencil"></i>
                                                    <span>{{__('Edit')}}</span>
                                                </a>
                                            {{-- @endcan --}}

                                            {{-- @can('delete contractor') --}}
                                                <a href="#" wire:click="setActionId('{{$contractor->id}}')"  class="dropdown-item confirm-delete">
                                                    <i class="ti ti-archive"></i>
                                                    <span> {{__('Delete')}} </span>
                                                </a>
                                            {{-- @endcan --}}

                                            <a href="#!" data-url="{{route('clients.reset',\Crypt::encrypt($contractor->id))}}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Reset Password')}}">
                                                <i class="ti ti-adjustments"></i>
                                                <span>  {{__('Reset Password')}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body full-card">
                                <div class="img-fluid rounded-circle card-avatar">
                                    <img src="{{(!empty($contractor->avatar))? asset(Storage::url("uploads/avatar/".$contractor->avatar)): asset("uploads/user.png") }}" alt="kal" class="img-user wid-80 rounded-circle">
                                </div>
                                <h4 class=" mt-2">{{ $contractor->name }}</h4>
                                <p></p>
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="d-grid">
                                            {{ $contractor->email }}
                                        </div>
                                    </div>
                                </div>
                                <div class="align-items-center h6 mt-2" data-bs-toggle="tooltip" title="{{__('Last Login')}}">
                                    {{ (!empty($contractor->last_login_at)) ? $contractor->last_login_at : '' }}
                                </div>
                            </div>
                            <div class="card-footer p-3">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="mb-0"> @if($contractor->clientDeals)
                                                {{$contractor->clientDeals->count()}}
                                            @endif</h6>
                                        <p class="text-muted text-sm mb-0">{{__('Deals')}}</p>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-0">@if($contractor->clientProjects)
                                                {{ $contractor->clientProjects->count() }}
                                            @endif</h6>
                                        <p class="text-muted text-sm mb-0">{{__('Projects')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
{{-- @endsection --}}
@include('livewire.projects.modals.create-contractor-modal')
</div>
