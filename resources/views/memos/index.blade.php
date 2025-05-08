@extends('layouts.admin')
@section('page-title')
    {{__('Memos')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Memos')}}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        <a href="#" class="btn btn-sm btn-primary" id="raiseMemoButton" data-bs-toggle="modal" data-bs-target="#raisememo"   data-size="lg " data-bs-toggle="tooltip"><i class="ti ti-plus text-white"></i>Raise a Memo</a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div id="printableArea">
            <div class="col-12" id="invoice-container">
                    <div class="card">
                        {{-- <div class="d-flex justify-content-between w-100"> --}}
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <!-- 🔎 Filter Form -->
                                    <div class="col-12 col-lg-12 mb-3 mb-lg-4">
                                        <form method="GET" action="{{ route('memos.index') }}" class="row g-2">
                                            <div class="col-md-4">
                                                <input type="text" name="title" class="form-control" placeholder="Search by Title" value="{{ request('title') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" name="created_at" class="form-control" value="{{ request('created_at') }}">
                                            </div>
                                            <div class="col-md-4 d-flex gap-2">
                                                <button type="submit" class="btn btn-primary w-100"><i class="ti ti-search"></i> Filter</button>
                                                <a href="{{ route('memos.index') }}" class="btn btn-secondary w-100">Reset</a>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- 📌 Memo Tabs -->
                                    <div class="col-12 col-lg-12 text-lg-end">
                                        <ul class="nav nav-pills justify-content-lg-end">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="profile-tab2" data-bs-toggle="pill" href="#memos" role="tab" aria-controls="pills-summary" aria-selected="true">
                                                    <i class="ti ti-files"></i> {{ __('Memos') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab3" data-bs-toggle="pill" href="#incoming" role="tab" aria-controls="pills-summary" aria-selected="false">
                                                    <i class="ti ti-download"></i> {{ __('Incoming Memos') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="contact-tab4" data-bs-toggle="pill" href="#outgoing" role="tab" aria-controls="pills-invoice" aria-selected="false">
                                                    <i class="ti ti-upload"></i> {{ __('Outgoing Memos') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="tab-content" id="myTabContent2">
                                        <div class="tab-pane fade fade show active table-responsive" id="memos" role="tabpanel" aria-labelledby="profile-tab2">
                                            <table class="table table-flush table datatable">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('Creator Name')}}</th>
                                                        <th>{{__('Department')}}</th>
                                                        <th>{{__('Memo Title')}}</th>
                                                        <th>{{__('Priority')}}</th>
                                                        <th>{{__('Description')}}</th>
                                                        <th>{{__('Date')}}</th>
                                                        <th>{{__('Action')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($memos as $memo)
                                                            <tr class="font-style">
                                                                <td>{{ $memo->creator->name }}</td>
                                                                <td>{{ $memo->creator->department->name }}</td>
                                                                <td>{{ $memo->title }}</td>
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div class="media-body">
                                                                            @if($memo->priority == 0)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-primary p-2 px-3 rounded">   Low</span>
                                                                            @elseif($memo->priority == 1)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-info p-2 px-3 rounded">  Medium </span>
                                                                            @elseif($memo->priority == 2)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-warning p-2 px-3 rounded">   High </span>
                                                                            @elseif($memo->priority == 3)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-danger p-2 px-3 rounded">   Critical</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ Str::limit($memo->description, 20, '...') }}</td>
                                                                <td>{{ $memo->created_at->format('d-M-Y') }}</td>
                                                                <td class="Action">
                                                                    <div class="action-btn bg-success ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="{{ route('memos.show', $memo->id) }}"
                                                                            data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="{{__('View Memo')}}" data-title="{{__('View Memo')}}">
                                                                            <i class="ti ti-eye text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-info ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="{{ route('memos.shareModal', $memo->id) }}" data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="{{__('Share Memo')}}"  data-title="{{__('Share Memo')}}">
                                                                            <i class="ti ti-share text-white"></i>
                                                                        </a>
                                                                    </div>

                                                                    <div class="action-btn bg-primary ms-2">
                                                                        <a href="{{ route('memos.download',$memo->id) }}" target="_blank" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="false"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Download Memo')}}"  data-title="{{__('Download Memo')}}">
                                                                            <i class="ti ti-download text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane fade fade table-responsive" id="incoming" role="tabpanel" aria-labelledby="profile-tab3">
                                            <table class="table table-flush table datatable" id="report-dataTable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{__('Sender')}}</th>
                                                        <th>{{__('Location')}}</th>
                                                        <th>{{__('Department')}}</th>
                                                        <th>{{__('Memo Title')}}</th>
                                                        <th>{{__('Priority')}}</th>
                                                        <th>{{__('Date Shared')}}</th>
                                                        <th>{{__('Signature')}}</th>
                                                        <th>{{__('Action')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($incomingMemos as $incomingMemo)
                                                            <tr class="font-style">
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div>
                                                                            <div class="avatar-parent-child">
                                                                                <img alt="" class="avatar rounded-circle avatar-sm" @if(!empty($incomingMemo->createdBy) && !empty($incomingMemo->createdBy->avatar)) src="{{asset(Storage::url('uploads/avatar')).'/'.$incomingMemo->createdBy->avatar}}" @else  src="{{asset(Storage::url('uploads/avatar')).'/avatar.png'}}" @endif>
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            {{!empty($incomingMemo->sharedBy->name)?$incomingMemo->sharedBy->name:''}}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $incomingMemo->sharedBy->location }}</td>
                                                                <td>{{ $incomingMemo->sharedBy->department->name }}</td>
                                                                <td>{{ $incomingMemo->memo->title }}</td>
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div class="media-body">
                                                                            @if($incomingMemo->memo->priority == 0)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-primary p-2 px-3 rounded">   Low</span>
                                                                            @elseif($incomingMemo->memo->priority == 1)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-info p-2 px-3 rounded">  Medium </span>
                                                                            @elseif($incomingMemo->memo->priority == 2)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-warning p-2 px-3 rounded">   High </span>
                                                                            @elseif($incomingMemo->memo->priority == 3)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-danger p-2 px-3 rounded">   Critical</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $incomingMemo->created_at->format('d-M-Y') }}</td>
                                                                <td>
                                                                    @if ($incomingMemo->sharedBy && $incomingMemo->sharedBy->signature)
                                                                        <img src="{{ asset('storage/' . $incomingMemo->sharedBy->signature->signature_path) }}" alt="Signature" height="50">
                                                                    @else
                                                                        <strike>{{ $incomingMemo->sharedBy->name }}</strike>
                                                                    @endif
                                                                </td>
                                                                <td class="Action">
                                                                    <div class="action-btn bg-success ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="{{ route('memos.show', $incomingMemo->memo_id) }}"
                                                                            data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="{{__('View Memo')}}" data-title="{{__('View Memo')}}">
                                                                            <i class="ti ti-eye text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-info ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="{{ route('memos.shareModal', $incomingMemo->memo->id) }}" data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="{{__('Share Memo')}}"  data-title="{{__('Share Memo')}}">
                                                                            <i class="ti ti-share text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-primary ms-2">
                                                                        <a href="{{ route('memos.download',$incomingMemo->memo->id) }}" target="_blank" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="false"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Download Memo')}}"  data-title="{{__('Download Memo')}}">
                                                                            <i class="ti ti-download text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                            </table>
                                            @if ($incomingMemos->isEmpty())
                                            <div align="center" id="norecord"><img style="margin-left:;"  width="100" src="https://img.freepik.com/free-vector/
                                                no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                                                alt="No results found" >
                                                <p class="mt-2 text-danger">No incoming record found!</p>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="tab-pane fade fade table-responsive" id="outgoing" role="tabpanel" aria-labelledby="profile-tab4">
                                            <table class="table table-flush table datatable" id="report-dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('Shared With')}}</th>
                                                        <th>{{__('Location')}}</th>
                                                        <th>{{__('Department')}}</th>
                                                        <th>{{__('Memo Title')}}</th>
                                                        <th>{{__('Priority')}}</th>
                                                        <th>{{__('Date Shared')}}</th>
                                                        <th>{{__('Action')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($outgoingMemos as $outgoingMemo)
                                                            <tr class="font-style">
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div>
                                                                            <div class="avatar-parent-child">
                                                                                <img alt="" class="avatar rounded-circle avatar-sm" @if(!empty($outgoingMemo->createdBy) && !empty($outgoingMemo->createdBy->avatar)) src="{{asset(Storage::url('uploads/avatar')).'/'.$outgoingMemo->createdBy->avatar}}" @else  src="{{asset(Storage::url('uploads/avatar')).'/avatar.png'}}" @endif>
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            {{!empty($outgoingMemo->sharedWith->name)?$outgoingMemo->sharedWith->name:''}}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $outgoingMemo->sharedWith->location }}</td>
                                                                <td>{{ $outgoingMemo->sharedWith->department->name }}</td>
                                                                <td>{{ $outgoingMemo->memo->title }}</td>
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div class="media-body">
                                                                            @if($outgoingMemo->memo->priority == 0)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-primary p-2 px-3 rounded">   Low</span>
                                                                            @elseif($outgoingMemo->memo->priority == 1)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-info p-2 px-3 rounded">  Medium </span>
                                                                            @elseif($outgoingMemo->memo->priority == 2)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-warning p-2 px-3 rounded">   High </span>
                                                                            @elseif($outgoingMemo->memo->priority == 3)
                                                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-danger p-2 px-3 rounded">   Critical</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $outgoingMemo->created_at->format('d-M-Y') }}</td>
                                                                <td class="Action">
                                                                    <div class="action-btn bg-success ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="{{ route('memos.show', $outgoingMemo->memo_id) }}"
                                                                            data-ajax-popup="true" data-size="lg " data-bs-toggle="tooltip" title="{{__('View Memo')}}" data-title="{{__('View Memo')}}">
                                                                            <i class="ti ti-eye text-white"></i>
                                                                        </a>
                                                                    </div>

                                                                    <div class="action-btn bg-primary ms-2">
                                                                        <a href="{{ route('memos.download',$outgoingMemo->memo->id) }}" target="_blank" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="false"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Download Memo')}}"  data-title="{{__('Download Memo')}}">
                                                                            <i class="ti ti-download text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                            </table>
                                            @if ($outgoingMemos->isEmpty())
                                            <div align="center" id="norecord"><img style="margin-left:;"  width="100" src="https://img.freepik.com/free-vector/
                                                no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                                                alt="No results found" >
                                                <p class="mt-2 text-danger">No outgoing record found!</p>
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
    @include('memos.create')

    @if($errors->any() || Session::has('error'))
    <script>
        $(document).ready(function() {
            document.getElementById("raiseMemoButton").click();
        });
    </script>
    @endif

@endsection
