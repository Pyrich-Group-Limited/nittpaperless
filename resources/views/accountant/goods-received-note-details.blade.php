@extends('layouts.admin')
@section('page-title')
    {{__('Goods Received Note')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('goodsReceived.list') }}">{{__('Goods Received Notes')}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('goodsReceived.details') }}">{{__('Goods Received Note Details')}}</a></li>
@endsection

@section('content')
    {{-- <div class="row">
        @include('accountant.includes.nav')
    </div> --}}
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('SN')}}</th>
                                <th>{{__('Item No.')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Qty')}}</th>
                                <th>{{__('Unit Price')}}</th>
                                <th>{{__('Total Price')}}</th>
                                <th>{{__('Ledger Folio No.')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="font-style">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="Action">
                                        <div class="action-btn bg-success ms-2">
                                            <a href="#" class="mx-3 btn btn-sm align-items-center"
                                                data-ajax-popup="false" data-bs-toggle="tooltip" title="{{__('Approve')}}" data-title="{{__('Approve')}}">
                                                <i class="ti ti-check text-white"></i>
                                            </a>
                                        </div>
                                        <div class="action-btn bg-primary ms-2">
                                            <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="{{ route('comment.modal') }}"
                                                data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Add Comment')}}" data-title="{{__('Add Comment')}}">
                                                <i class="ti ti-clipboard text-white"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

