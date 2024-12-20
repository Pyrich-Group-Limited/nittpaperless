@extends('layouts.admin')
@php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{__('Shared Documents')}}
@endsection
@push('script-page')

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Shared Documents')}}</li>
@endsection

@section('content')
<div class="row">
    <div id="printableArea">
        <div class="col-12" id="invoice-container">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab3" data-bs-toggle="pill" href="#incomingFiles" role="tab" aria-controls="pills-summary" aria-selected="true"><i class="ti ti-files"> </i> {{__('Documents Shared With Me')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab4" data-bs-toggle="pill" href="#outgoingFiles" role="tab" aria-controls="pills-invoice" aria-selected="false"><i class="ti ti-files"> </i> {{__('Documents I Shared')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade fade table-responsive" id="incomingFiles" role="tabpanel" aria-labelledby="profile-tab3">
                                        <table class="table table-flush table datatable" id="report-dataTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">{{__('Sender')}}</th>
                                                    <th>{{__('Location')}}</th>
                                                    <th>{{__('Department')}}</th>
                                                    <th>{{__('Document Name')}}</th>
                                                    <th>{{__('Priority')}}</th>
                                                    <th>{{__('Date Shared')}}</th>
                                                    <th>{{__('Signature')}}</th>
                                                    <th>{{__('Action')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($filesSharedWithUser as $file)
                                                        @foreach($file->sharedWith as $incoming)
                                                            <tr class="font-style">
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div>
                                                                            <div class="avatar-parent-child">
                                                                                <img alt="" class="avatar rounded-circle avatar-sm" @if(!empty($incoming->createdBy) && !empty($incoming->createdBy->avatar)) src="{{asset(Storage::url('uploads/avatar')).'/'.$incoming->createdBy->avatar}}" @else  src="{{asset(Storage::url('uploads/avatar')).'/avatar.png'}}" @endif>
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            {{!empty($incoming->name)?$incoming->name:''}}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $incoming->location ?? ''}}</td>
                                                                <td>{{ $incoming->department->name ?? '' }}</td>
                                                                <td>{{ $file->file_name }}</td>
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div class="media-body">
                                                                            @if($incoming->priority == 0)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-primary p-2 px-3 rounded">   Low</span>
                                                                            @elseif($incoming->priority == 1)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-info p-2 px-3 rounded">  Medium </span>
                                                                            @elseif($incoming->priority == 2)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-warning p-2 px-3 rounded">   High </span>
                                                                            @elseif($incoming->priority == 3)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-danger p-2 px-3 rounded">   Critical</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $incoming->created_at->format('d-M-Y') }}</td>
                                                                <td>
                                                                    @if ($incoming && $incoming->signature)
                                                                        <img src="{{ asset('storage/' . $incoming->signature->signature_path) }}" alt="Signature" height="50">
                                                                    @else
                                                                        <strike>{{ $incoming->name }}</strike>
                                                                    @endif
                                                                </td>
                                                                <td class="Action">
                                                                    <div class="action-btn bg-primary ms-2">
                                                                        <a href="#!" data-size="lg" data-url="{{ route('file.shareModal',$incoming->id) }}" data-ajax-popup="true" class="mx-3 btn btn-sm  align-items-center" title="{{__('Share Document')}}" data-bs-original-title="{{__('Share Document')}}">
                                                                            <i class="ti ti-share text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-info ms-2">
                                                                        <a href="#!" data-url="{{ route('file.renameModal',$incoming->id) }}" data-ajax-popup="true" class="mx-3 btn btn-sm  align-items-center" title="{{__('Rename Document')}}" data-bs-original-title="{{__('Rename Document')}}">
                                                                            <i class="ti ti-pencil text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-primary ms-2">
                                                                        <a href="{{ route('files.download',$incoming->id) }}" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="false"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Download Document')}}"  data-title="{{__('Download Document')}}">
                                                                            <i class="ti ti-download text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-danger ms-2">
                                                                        <form action="{{ route('files.archive', $incoming->id) }}" method="POST" style="display:inline;">
                                                                            @csrf
                                                                            <button type="submit" class="mx-3 btn btn-sm  align-items-center" title="{{__('Archive Document')}}"><i class="ti ti-archive text-white"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                        </table>
                                        @if ($filesSharedWithUser->isEmpty())
                                        <div align="center" id="norecord"><img style="margin-left:;"  width="100" src="https://img.freepik.com/free-vector/
                                            no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                                            alt="No results found" >
                                            <p class="mt-2 text-danger">No record found!</p>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="tab-pane fade fade table-responsive" id="outgoingFiles" role="tabpanel" aria-labelledby="profile-tab4">
                                        <table class="table table-flush table datatable" id="report-dataTable">
                                            <thead>
                                                <tr>
                                                    <th>{{__('Shared With')}}</th>
                                                    <th>{{__('Location')}}</th>
                                                    <th>{{__('Department')}}</th>
                                                    <th>{{__('Document Name')}}</th>
                                                    <th>{{__('Priority')}}</th>
                                                    <th>{{__('Date Shared')}}</th>
                                                    <th>{{__('Action')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($filesSharedByUser as $file)
                                                        @foreach($file->sharedWith as $outgoing)
                                                            <tr class="font-style">
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div>
                                                                            <div class="avatar-parent-child">
                                                                                <img alt="" class="avatar rounded-circle avatar-sm" @if(!empty($outgoing->createdBy) && !empty($outgoing->createdBy->avatar)) src="{{asset(Storage::url('uploads/avatar')).'/'.$outgoing->createdBy->avatar}}" @else  src="{{asset(Storage::url('uploads/avatar')).'/avatar.png'}}" @endif>
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            {{!empty($outgoing->name)?$outgoing->name:''}}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $outgoing->location ?? '' }}</td>
                                                                <td>{{ $outgoing->department->name ?? ''}}</td>
                                                                <td>{{ $file->file_name }}</td>
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div class="media-body">
                                                                            @if($outgoing->priority == 0)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-primary p-2 px-3 rounded">   Low</span>
                                                                            @elseif($outgoing->priority == 1)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-info p-2 px-3 rounded">  Medium </span>
                                                                            @elseif($outgoing->priority == 2)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-warning p-2 px-3 rounded">   High </span>
                                                                            @elseif($outgoing->priority == 3)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-danger p-2 px-3 rounded">   Critical</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $outgoing->created_at->format('d-M-Y') }}</td>
                                                                <td class="Action">
                                                                    <div class="action-btn bg-primary ms-2">
                                                                        <a href="#!" data-size="lg" data-url="{{ route('file.shareModal',$outgoing->id) }}" data-ajax-popup="true" class="mx-3 btn btn-sm  align-items-center" title="{{__('Share Document')}}" data-bs-original-title="{{__('Share Document')}}">
                                                                            <i class="ti ti-share text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-info ms-2">
                                                                        <a href="#!" data-url="{{ route('file.renameModal',$outgoing->id) }}" data-ajax-popup="true" class="mx-3 btn btn-sm  align-items-center" title="{{__('Rename Document')}}" data-bs-original-title="{{__('Rename Document')}}">
                                                                            <i class="ti ti-pencil text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-primary ms-2">
                                                                        <a href="{{ route('files.download',$outgoing->id) }}" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="false"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Download Document')}}"  data-title="{{__('Download Document')}}">
                                                                            <i class="ti ti-download text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-danger ms-2">
                                                                        <form action="{{ route('files.archive', $outgoing->id) }}" method="POST" style="display:inline;">
                                                                            @csrf
                                                                            <button type="submit" class="mx-3 btn btn-sm  align-items-center" title="{{__('Archive Document')}}"><i class="ti ti-archive text-white"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                        </table>
                                        @if ($filesSharedByUser->isEmpty())
                                        <div align="center" id="norecord"><img style="margin-left:;"  width="100" src="https://img.freepik.com/free-vector/
                                            no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                                            alt="No results found" >
                                            <p class="mt-2 text-danger">No record found!</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-xxl-12">
          
            {{-- <div class="row">

                @if($sharedFiles->isNotEmpty())
                    @foreach($sharedFiles as $file)
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                <div align="center" id="norecord"><img style="margin-left:;"  width="100" src="https://img.freepik.com/free-vector/
                    no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                    alt="No results found" >
                    <p class="mt-2 text-danger">No shared Documents!</p>
                </div>
                @endif
            </div> --}}
        </div>
    </div>
@endsection
