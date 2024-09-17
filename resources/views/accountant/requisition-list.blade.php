@extends('layouts.admin')
@section('page-title')
    {{__('Requisition List')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('purchase.requisition')}}">{{__('Purchase Requisition')}}</a></li>
    <li class="breadcrumb-item"><a href="">{{__('Requisition List')}}</a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        {{-- <div class="table-head col-xl-12 mt-2" style="text-align: right;">
                            <a href="#" class="btn btn-primary" data-url="{{ route('requisition.new') }}" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip"><i class="ti ti-plus text-white"></i>New</a>
                        </div> --}}
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('SN')}}</th>
                                <th>{{__('Item')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Stock Balance')}}</th>
                                <th>{{__('Max Stock Level')}}</th>
                                <th>{{__('Required Qty')}}</th>
                                <th>{{__('Last Supply Date/Qty')}}</th>
                                <th>{{__('Last Requisition Date')}}</th>
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

