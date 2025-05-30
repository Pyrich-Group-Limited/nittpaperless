@extends('layouts.admin')
@php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{__('This Month Documents')}}
@endsection
@push('script-page')

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('This Month Documents')}}</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                @if($thisMonthfiles->isNotEmpty())
                    @foreach($thisMonthfiles as $file)
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
                                                <a href="#!" data-size="lg" data-url="{{ route('file.shareModal',$file->id) }}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Share File')}}">
                                                    <i class="ti ti-share"></i>
                                                    <span>{{__('Share')}}</span>
                                                </a>
                                                <a href="#!" data-url="{{ route('file.renameModal',$file->id) }}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Rename File')}}">
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
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body full-card">
                                    <div class="img-fluid rounded-circle card-avatar">
                                        <span class="nk-file-icon-type">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                                                <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />
                                                <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />
                                                <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />
                                                <rect x="27" y="31" width="18" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                                <rect x="27" y="35" width="18" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                                <rect x="27" y="39" width="18" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                                <rect x="27" y="43" width="14" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                                <rect x="27" y="47" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                            </svg>
                                        </span>
                                        <h6 class=" mt-4 text-primary">{{ $file->file_name.'.'.$file = pathinfo(storage_path().$file->path, PATHINFO_EXTENSION); }}
                                        </h6>
                                        {{-- <p>{{ strtotime($file->created_at->format('M d, Y H:i')) }}</p> --}}
                                        {{-- <p>{{  $file->created_at->format('M d, Y H:i') }}</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                <div align="center" id="norecord"><img style="margin-left:;"  width="100" src="https://img.freepik.com/free-vector/
                    no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                    alt="No results found" >
                    <p class="mt-2 text-danger">No Documents found!</p>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
