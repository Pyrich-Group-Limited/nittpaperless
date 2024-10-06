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
        <a href="#" data-size="lg" data-url="{{ route('memos.create') }}" data-ajax-popup="true"
            data-bs-toggle="tooltip" title="{{ __('Create') }}" data-title="{{ __('Raise Memo') }}"
            class="btn btn-sm btn-primary">Raise Memo
            <i class="ti ti-plus"></i>
        </a>
    </div>
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
                                        <a class="nav-link active" id="profile-tab3" data-bs-toggle="pill" href="#incoming" role="tab" aria-controls="pills-summary" aria-selected="true">{{__('Incoming Memos')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab4" data-bs-toggle="pill" href="#outgoing" role="tab" aria-controls="pills-invoice" aria-selected="false">{{__('Outgoing Memos')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="tab-content" id="myTabContent2">
                                        <div class="tab-pane fade fade table-responsive" id="incoming" role="tabpanel" aria-labelledby="profile-tab3">
                                            <table class="table table-flush table datatable" id="report-dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('Full Name')}}</th>
                                                        <th>{{__('Department')}}</th>
                                                        <th>{{__('Type of Memo')}}</th>
                                                        <th>{{__('Date Issued')}}</th>
                                                        <th>{{__('Status')}}</th>
                                                        <th>{{__('Action')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($memos as $memo)
                                                            <tr class="font-style">
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="Action">
                                                                    <div class="action-btn bg-success ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="{{ route('memos.show', $memo->id) }}"
                                                                            data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('View Memo')}}" data-title="{{__('View Memo')}}">
                                                                            <i class="ti ti-eye text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-info ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Return')}}"  data-title="{{__('Return')}}">
                                                                            <i class="ti ti-share text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-danger ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Reject')}}"  data-title="{{__('Reject')}}">
                                                                            <i class="ti ti-plus text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane fade fade table-responsive" id="outgoing" role="tabpanel" aria-labelledby="profile-tab3">
                                            <table class="table table-flush table datatable" id="report-dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('Full Name')}}</th>
                                                        <th>{{__('Department')}}</th>
                                                        <th>{{__('Type of Memo')}}</th>
                                                        <th>{{__('Date Issued')}}</th>
                                                        <th>{{__('Status')}}</th>
                                                        <th>{{__('Action')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($memos as $memo)
                                                            <tr class="font-style">
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="Action">
                                                                    <div class="action-btn bg-success ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="{{ route('memos.show', $memo->id) }}"
                                                                            data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('View Memo')}}" data-title="{{__('View Memo')}}">
                                                                            <i class="ti ti-eye text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-info ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Return')}}"  data-title="{{__('Return')}}">
                                                                            <i class="ti ti-share text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-danger ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Reject')}}"  data-title="{{__('Reject')}}">
                                                                            <i class="ti ti-plus text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                            </table>
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

@endsection
