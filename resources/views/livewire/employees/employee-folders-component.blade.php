@php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{__('Employee Files')}}
@endsection
@push('script-page')

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"> <a href="{{ route('employees.files')}}">Employee Files</a></li>
    <li class="breadcrumb-item"> {{ $folder_type }} File</li>
@endsection
@section('action-btn')
@can('Manage Employee FIle')
    <div class="float-end">
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newFileFolder" data-bs-toggle="tooltip" title="{{__('Create new folder')}}" class="btn btn-sm btn-primary">
                <i class="ti ti-plus">Create Folder </i>
            </a>
    </div>
    @endcan
@endsection
<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <form action="{{ route('folders.index') }}" method="GET">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <input type="text" name="search" class="form-control" placeholder="Search folders by name" value="{{ request('search') }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="submit" class="btn btn-primary form-control">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                <h4>
                    <i class="ti ti-folder"></i>
                    {{ $folders->first()->owner->name }}
                </h4>
                {{-- <h2>My Folders</h2> --}}
                @if($folders->count() > 0)
                    @foreach($folders as $folder)
                    <div class="col-md-2 mb-4">
                        <div class="card text-center card-2">
                            @can('Manage Employee FIle')
                            <div class="card-header border-0 pb-0">
                                <div class="card-header-right">
                                    <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{ route('employees.selected',$folder->id) }}"  class="dropdown-item">
                                                <i class="ti ti-eye"></i>
                                                <span> {{__('View')}}</span>
                                            </a>
                                            <a href="#!" data-bs-target="#renameFolder" data-bs-toggle="modal" wire:click="renameFolderModal({{$folder}})" class="dropdown-item" data-bs-original-title="{{__('Rename File')}}">
                                                <i class="ti ti-pencil"></i>
                                                <span>{{__('Rename')}}</span>
                                            </a>
                                            <a href="#!" wire:click="setActionId('{{ $folder->id}}')"  class="dropdown-item confirm-delete">
                                                <i class="ti ti-archive"></i>
                                                <span> {{__('Delete')}} </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            <div class="card-body s">
                                <div class="img-fluid rounded-circle card-avatar">
                                    <a href="{{ route('employees.selected',$folder->id) }}">
                                    <span class="nk-file-icon-type">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                                            <g>
                                                <rect x="32" y="16" width="28" height="15" rx="2.5" ry="2.5" style="fill:#f29611" />
                                                <path d="M59.7778,61H12.2222A6.4215,6.4215,0,0,1,6,54.3962V17.6038A6.4215,6.4215,0,0,1,12.2222,11H30.6977a4.6714,4.6714,0,0,1,4.1128,2.5644L38,24H59.7778A5.91,5.91,0,0,1,66,30V54.3962A6.4215,6.4215,0,0,1,59.7778,61Z" style="fill:#ffb32c" />
                                                <path d="M8.015,59c2.169,2.3827,4.6976,2.0161,6.195,2H58.7806a6.2768,6.2768,0,0,0,5.2061-2Z" style="fill:#f2a222" />
                                            </g>
                                        </svg>
                                    </span>
                                    <h6 class=" mt-4 text-primary">{{ $folder->folder_name }}</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div align="center" id="norecord"><img style="margin-left:;"  width="100" src="https://img.freepik.com/free-vector/
                        no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                        alt="No results found" >
                        <p class="mt-2 text-danger">No folders created!</p>
                    </div>
                @endif
                {{ $folders->links() }}
            </div>
        </div>
    </div>
@include('livewire.employees.modals.new-file-folder-modal')
@include('livewire.employees.modals.rename-folder')

</div>
