@extends('layouts.admin')
@section('page-title')
    {{__('Store Requisition List')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('store.requisition')}}">{{__('Store Requisition')}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('req.list')}}">{{__('Store Requisition List')}}</a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('SN')}}</th>
                                <th>{{__('Item Number')}}</th>
                                <th>{{__('Denomination')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Article')}}</th>
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
                                    <td class="Action">
                                        <div class="action-btn bg-success ms-2">
                                            <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="{{ route('req.details') }}"
                                                data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('View Approve')}}" data-title="{{__('View Approve')}}">
                                                <i class="ti ti-check text-white"></i>
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

