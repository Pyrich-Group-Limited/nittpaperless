@extends('layouts.admin')
@php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{__('Documents')}}
@endsection
@push('script-page')

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Documents')}}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        {{------------ Start Filter ----------------}}
                {{-- <a href="#" class="btn btn-sm btn-primary action-item" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-filter"></i>
                </a> --}}
                {{-- <div class="dropdown-menu  dropdown-steady" id="project_sort">
                    <a class="dropdown-item {{ request('order') == 'desc' ? 'selected' : '' }}"
                    href="{{ route('file.index', ['sort' => 'newest']) }}" data-val="created_at-desc">
                        <i class="ti ti-sort-descending"></i>{{__('Newest')}}
                    </a>
                    <a class="dropdown-item" {{ request('order') == 'asc' ? 'selected' : '' }}
                    href="{{ route('file.index', ['sort' => 'oldest']) }}" data-val="created_at-asc">
                        <i class="ti ti-sort-ascending"></i>{{__('Oldest')}}
                    </a>
                </div> --}}

            {{------------ End Filter ----------------}}

            {{-- <a href="#" id="newFileButton" data-size="lg" data-url="{{ route('file.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create new file')}}" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>--}}
            <a href="#" class="btn btn-sm btn-primary" id="newFileButton" data-bs-toggle="modal" data-bs-target="#newfile"   data-size="lg " data-bs-toggle="tooltip"><i class="ti ti-plus text-white"></i>New</a>
    </div>
@endsection

@section('content')
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
                                        <form method="GET" action="{{ route('file.index') }}" class="mb-3">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="text" name="search" class="form-control" placeholder="Search file, folder..." value="{{ request('search') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="sortBy" class="form-select form-control">
                                                        <option value="file_name" {{ request('sortBy') == 'file_name' ? 'selected' : '' }}>Sort by Name</option>
                                                        <option value="created_at" {{ request('sortBy') == 'created_at' ? 'selected' : '' }}>Sort by Date</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="order" class="form-select form-control">
                                                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                                                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                        <button type="submit" class="btn btn-primary form-control">Search & Filter</button>
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
                {{-- @foreach($folders as $folder) --}}
                @foreach ($documents as $folderName => $docs)
                    <h4>
                        <i class="ti ti-folder"></i>
                        {{ $folderName ? : 'Documents without folder'  }}
                    </h4>

                    {{-- @if($folder->files->count() > 0) --}}
                    @if($documents->count() > 0)
                        {{-- @foreach($folder->files as $file ) --}}
                        @foreach ($docs as $file)
                            <div class="col-md-2 mb-4">
                                <div class="card text-center card-2">
                                    <div class="card-header border-0 pb-0">
                                        <div class="card-header-right">
                                            <div class="btn-group card-option">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#!" data-size="lg" data-url="{{ route('file.shareModal',$file->id) }}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Share Document')}}">
                                                        <i class="ti ti-share"></i>
                                                        <span>{{__('Share')}}</span>
                                                    </a>
                                                    <a href="#!" data-url="{{ route('file.renameModal',$file->id) }}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Rename Document')}}">
                                                        <i class="ti ti-pencil"></i>
                                                        <span>{{__('Rename')}}</span>
                                                    </a>
                                                    <a href="{{ route('files.download',$file->id) }}"  class="dropdown-item">
                                                        <i class="ti ti-download"></i>
                                                        <span> {{__('Download')}} </span>
                                                    </a>
                                                    <form action="{{ route('files.archive', $file->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-white dropdown-item"><i class="ti ti-archive"></i>Archive</button>
                                                    </form>
                                                    {{-- <a href="{{ route('files.archive', $file->id) }}"  class="dropdown-item">
                                                        <i class="ti ti-archive"></i>
                                                        <span> {{__('Archive')}} </span>
                                                    </a> --}}
                                                    {{-- <a href="#!"  class="dropdown-item bs-pass-para">
                                                        <i class="ti ti-adjustments"></i>
                                                        <span>{{__('Restore')}} </span>
                                                    </a> --}}
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body full-card">
                                        <div class="img-fluid rounded-circle card-avatar">
                                            <span class="nk-file-icon-type">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                                                    <g>
                                                        <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />
                                                        <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />
                                                        <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />
                                                        <rect x="27" y="31" width="18" height="2" rx="1" ry="1" style="fill:#599def" />
                                                        <rect x="27" y="36" width="18" height="2" rx="1" ry="1" style="fill:#599def" />
                                                        <rect x="27" y="41" width="18" height="2" rx="1" ry="1" style="fill:#599def" />
                                                        <rect x="27" y="46" width="12" height="2" rx="1" ry="1" style="fill:#599def" />
                                                    </g>
                                                </svg>
                                            </span>
                                            <h6 class=" mt-4 text-primary">{{ $file->file_name.'.'.$file = pathinfo(storage_path().$file->path, PATHINFO_EXTENSION); }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div align="center" id="norecord"><img style="margin-left:;"  width="100" src="https://img.freepik.com/free-vector/
                            no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                            alt="No results found" >
                            <p class="mt-2 text-danger">No Documents in this folder!</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @include('filemanagement.modals.create-file')

    @if($errors->any() || Session::has('error'))
    <script>
        $(document).ready(function() {
            document.getElementById("newFileButton").click();
        });
    </script>
    @endif
@endsection
