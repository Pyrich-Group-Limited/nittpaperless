@extends('layouts.admin')
@section('page-title')
    {{__('Purchase Requisition')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Purchase Requisition')}}</li>
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
                        <div class="table-head col-xl-12 mt-2" style="text-align: right;">
                            <a href="#" class="btn btn-primary" data-url="{{ route('requisition.new') }}" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip"><i class="ti ti-plus text-white"></i>New</a>
                        </div>
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('SN')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('From')}}</th>
                                <th>{{__('Department')}}</th>
                                <th>{{__('Unit')}}</th>
                                <th>{{__('Branch/Liason Office')}}</th>
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
                                    <td class="Action">
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="{{ route('req.list') }}" class="mx-3 btn btn-sm align-items-center"
                                                data-ajax-popup="false" data-bs-toggle="tooltip" title="{{__('View Details')}}" data-title="{{__('View Details')}}">
                                                <i class="ti ti-eye text-white"></i>
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

