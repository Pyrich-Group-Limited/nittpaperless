@extends('layouts.admin')
@section('page-title')
    {{__('Set Budget')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Set Budget')}}</li>
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
                                <th>{{__('Location/Liason office')}}</th>
                                <th>{{__('Dapartment')}}</th>
                                <th>{{__('Year')}}</th>
                                <th>{{__('Approved By')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="font-style">
                                    <td>Gombe Liason Office</td>
                                    <td>Procurement</td>
                                    <td>2024</td>
                                    <td>Ahmed Isah</td>

                                        <td class="Action">
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="#"
                                                   data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Details')}}" data-title="{{__('Details')}}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="#" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Edit')}}"  data-title="{{__('Edit Record')}}">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-danger ms-2">
                                                <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="#" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Delete')}}"  data-title="{{__('Delete Record')}}">
                                                    <i class="ti ti-trash text-white"></i>
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

