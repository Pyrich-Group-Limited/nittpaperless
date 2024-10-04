@extends('layouts.admin')
@php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{__('Files')}}
@endsection
@push('script-page')

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Files')}}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="mt-2 " id="multiCollapseExample1">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-8">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="btn-box">
                                        <input type="text" class="form-control" placeholder="Search files, folder">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto mt-2">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti ti-plus"></i> <span>Create</span></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="#!" data-size="lg" data-url="{{ route('file.create') }}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Create File')}}">
                                            <i class="ti ti-file-plus"></i>
                                            <span>{{__('Create File')}}</span>
                                        </a>
                                        <a href="#!" data-url="{{ route('folder.create') }}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Create Folder')}}">
                                            <i class="ti ti-folder-plus"></i>
                                            <span>  {{__('Create Folder')}}</span>
                                        </a>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-sm" data-url="{{ route('file.upload') }}" data-ajax-popup="true"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Upload Files') }}"><i class="ti ti-cloud-upload"></i> Upload
                                    </a>
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
                <h2>My Folders</h2>
                @if($folders->count() > 0)
                    @foreach($folders as $folder)
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
                                            <a href="#!" data-size="md" data-url="{{ route('folder.renameModal',$folder->id) }}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Rename Folder')}}">
                                                <i class="ti ti-pencil"></i>
                                                <span>{{__('Rename')}}</span>
                                            </a>
                                            <a href="{{ route('folder.details',$folder->id) }}"  class="dropdown-item">
                                                <i class="ti ti-eye"></i>
                                                <span> {{__('View Details')}}</span>
                                            </a>
                                            <a href="#!"  class="dropdown-item bs-pass-para">
                                                <i class="ti ti-share"></i>
                                                <span> {{__('Share')}}</span>
                                            </a>
                                            <a href="#!"  class="dropdown-item bs-pass-para">
                                                <i class="ti ti-archive"></i>
                                                <span> {{__('Archive')}}</span>
                                            </a>
                                            {!! Form::close() !!}
                                            <a href="#!" data-url="" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Reset Password')}}">
                                                <i class="ti ti-adjustments"></i>
                                                <span>  {{__('Restore')}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body full-card">
                                <div class="img-fluid rounded-circle card-avatar">

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
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p>No folders created.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
