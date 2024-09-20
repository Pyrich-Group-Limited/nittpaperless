@extends('layouts.admin')
@section('page-title')
    {{__('DTA Requests')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('DTA Requests')}}</li>
@endsection

@section('content')
        @include('hrm.includes.dash-nav')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <div class="table-head col-xl-12 mt-2" style="text-align: right;">
                            <a href="#" class="btn btn-primary" data-url="{{ route('hrm.applyDta') }}" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip"><i class="ti ti-plus text-white"></i>Apply DTA</a>
                        </div>
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('Destination')}}</th>
                                <th>{{__('Full Name')}}</th>
                                <th>{{__('Number of Days')}}</th>
                                <th>{{__('Travel Date')}}</th>
                                <th>{{__('Arrival Date')}}</th>
                                <th>{{__('Estimate Expenses')}}</th>
                                <th>{{__('Date Applied')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="font-style">
                                    <td>Morocco</td>
                                    <td>Test Employee</td>
                                    <td>15</td>
                                    <td>11-10-2024</td>
                                    <td>26-10-2024</td>
                                    <td>1,2000,000</td>
                                    <td>5-10-2024</td>
                                    <td class="Action">
                                        <div class="action-btn bg-success ms-2">
                                            <a href="#" class="mx-3 btn btn-sm align-items-center" data-url=""
                                                data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Approve')}}" data-title="{{__('Approve')}}">
                                                <i class="ti ti-check text-white"></i>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

