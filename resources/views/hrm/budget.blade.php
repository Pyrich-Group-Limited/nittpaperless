@extends('layouts.admin')
@section('page-title')
    {{__('Departmental Budget')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Departmental Budget')}}</li>
@endsection

{{-- @section('action-btn')
    <div class="float-end">
        <a href="#" data-size="lg" data-url="{{ route('warehouse-transfer.create') }}" data-ajax-popup="true"
            data-bs-toggle="tooltip" title="{{ __('Create') }}" data-title="{{ __('Create Warehouse Transfer') }}"
            class="btn btn-sm btn-primary">Apply Here
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection --}}

@section('content')
        @include('hrm.includes.dash-nav')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('Location/Liason Office')}}</th>
                                <th>{{__('Department')}}</th>
                                <th>{{__('Year')}}</th>
                                <th>{{__('Approved By')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="font-style">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="Action">
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="#" class="mx-3 btn btn-sm align-items-center" data-url=""
                                                data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Warehouse Details')}}" data-title="{{__('Warehouse Details')}}">
                                                <i class="ti ti-eye text-white"></i>
                                            </a>
                                        </div>
                                        <div class="action-btn bg-info ms-2">
                                            <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Edit')}}"  data-title="{{__('Edit Product')}}">
                                                <i class="ti ti-pencil text-white"></i>
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

