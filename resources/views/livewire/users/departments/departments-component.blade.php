@php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{__('Manage Departments')}}
@endsection
@push('script-page')

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Departments')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        @can('create user')
        <!-- {{-- data-url="{{ route('users.create') }}" --}} -->
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newDepartment" id="toggleOldUser"  data-bs-toggle="tooltip" title="{{__('Create')}}"  class="btn btn-sm btn-primary">
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
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Department Name') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($departments)>0)
                                    @foreach ($departments as $department)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucfirst($department->category) }}</td>
                                            <td>{{ $department->name }}</td>
                                            <td>
                                                <div class="card-header-right">
                                                    <div class="btn-group card-option">
                                                        <button type="button" class="btn dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            @can('delete user')
                                                                <a href="#!" wire:click="setActionId('{{ $department->id}}')"  class="dropdown-item confirm-delete">
                                                                    <i class="ti ti-archive"></i>
                                                                    <span> {{__('Delete')}} </span>
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
                    <div class="paginate">{{ $departments->links('pagination::bootstrap-5') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- <x-toast-notification /> --}}
    @include('livewire.users.departments.modals.new-department-modal')
    {{-- @livewire('users.new-user-component') --}}
</div>
