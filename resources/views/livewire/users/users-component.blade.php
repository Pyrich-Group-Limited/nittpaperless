@php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{__('Manage User')}}
@endsection
@push('script-page')

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Client')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        @if (\Auth::user()->type == 'super admin' || \Auth::user()->type == 'HR')
            <a href="{{ route('user.userlog') }}" class="btn btn-primary btn-sm {{ Request::segment(1) == 'user' }}"
               data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('User Logs History') }}"><i class="ti ti-user-check"></i>
            </a>
            <a href="#" class="btn btn-primary btn-sm {{ Request::segment(1) == 'user' }}" id="uploadUser"
             data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#uploadUsers" title="{{ __('Upload users') }}"><i class="ti ti-upload"></i>
         </a>
        @endif
        @can('create user')
        <!-- {{-- data-url="{{ route('users.create') }}" --}} -->
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newUser" id="toggleOldUser"  data-bs-toggle="tooltip" title="{{__('Create')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>
@endsection

<div>
    <div class="row">
        <div class="col-xl-12">

            <div class="card mt-4">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('SN') }}</th>
                                    <th>{{ __('Staff Name') }}</th>
                                    <th>{{ __('Branch') }}</th>
                                    <th>{{ __('Department') }}</th>
                                    <th>{{ __('Unit') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($users)>0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->location_type }}</td>
                                            <td>@if($user->department){{ $user->department->name ? : '-' }} @else - @endif</td>
                                            <td>@if($user->unit){{ $user->unit->name ? : '-' }} @else - @endif</td>
                                            <td>{{ $user->type }}</td>
                                            <td>
                                                <div class="card-header-right">
                                                    <div class="btn-group card-option">
                                                        <button type="button" class="btn dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            @can('edit user')
                                                                <a href="" wire:click="selUser({{$user->id}})" data-bs-toggle="modal" data-bs-target="#editUser" class="dropdown-item" data-bs-original-title="{{__('Edit User')}}">
                                                                    <i class="ti ti-pencil"></i>
                                                                    <span>{{__('Edit')}}</span>
                                                                </a>
                                                            @endcan

                                                            @can('delete user')
                                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user['id']],'id'=>'delete-form-'.$user['id']]) !!}
                                                                <a href="#!"  class="dropdown-item bs-pass-para">
                                                                    <i class="ti ti-archive"></i>
                                                                    <span> @if($user->delete_status!=0){{__('Delete')}} @else {{__('Restore')}}@endif</span>
                                                                </a>

                                                                {!! Form::close() !!}
                                                            @endcan
                                                            <a href="#!" data-url="{{route('users.reset',\Crypt::encrypt($user->id))}}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Reset Password')}}">
                                                                <i class="ti ti-adjustments"></i>
                                                                <span>  {{__('Reset Password')}}</span>
                                                            </a>
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
                    <div class="paginate">{{ $users->links('pagination::bootstrap-5') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- <x-toast-notification /> --}}
    @include('user.upload-users')
    @include('livewire.users.modals.edit-user-modal')
    @include('livewire.users.modals.new-user-modal')
    {{-- @livewire('users.new-user-component') --}}
</div>
