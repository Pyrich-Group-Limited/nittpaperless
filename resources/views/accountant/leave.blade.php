@extends('layouts.admin')
@section('page-title')
    {{__('Leave')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Leave')}}</li>
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
                                <th>{{__('Name')}}</th>
                                <th>{{__('Sku')}}</th>
                                <th>{{__('Sale Price')}}</th>
                                <th>{{__('Purchase Price')}}</th>
                                <th>{{__('Tax')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Unit')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Type')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- @foreach ($productServices as $productService) --}}
                                <tr class="font-style">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td>-</td>

                                    <td></td>

                                    @if(Gate::check('edit product & service') || Gate::check('delete product & service'))
                                        <td class="Action">

                                            <div class="action-btn bg-warning ms-2">
                                                <a href="#" class="mx-3 btn btn-sm align-items-center" data-url=""
                                                   data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Warehouse Details')}}" data-title="{{__('Warehouse Details')}}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>

                                            @can('edit product & service')
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="{{__('Edit')}}"  data-title="{{__('Edit Product')}}">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                        </td>
                                    @endif
                                </tr>
                            {{-- @endforeach --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

