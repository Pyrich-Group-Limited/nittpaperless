@extends('layouts.admin')
@section('page-title')
    {{__('Dashboard')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><b>Welcome </b>{{ Ucfirst(Auth::user()->name). "(" .Auth::user()->department->name. ")" }}</li>
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xxl-7">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto mb-3 mb-sm-0">
                                                <a href="#">
                                                    <div class="d-flex align-items-center">
                                                        <div class="theme-avtar bg-primary">
                                                            <i class="ti ti-cast"></i>
                                                        </div>
                                                        <div class="ms-3">

                                                            <h6 class="m-0">{{__('Purchase Requisition')}}</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto mb-3 mb-sm-0">
                                                <a href="#">
                                                    <div class="d-flex align-items-center">
                                                        <div class="theme-avtar bg-primary">
                                                            <i class="ti ti-cast"></i>
                                                        </div>
                                                        <div class="ms-3">
                                                            <h6 class="m-0">{{__('Store Requisition Note')}}</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto mb-3 mb-sm-0">
                                                <a href="#">
                                                    <div class="d-flex align-items-center">
                                                        <div class="theme-avtar bg-primary">
                                                            <i class="ti ti-cast"></i>
                                                        </div>
                                                        <div class="ms-3">
                                                            <h6 class="m-0">{{__('Goods Recieved')}}</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto mb-3 mb-sm-0">
                                                <a href="#">
                                                    <div class="d-flex align-items-center">
                                                        <div class="theme-avtar bg-primary">
                                                            <i class="ti ti-cast"></i>
                                                        </div>
                                                        <div class="ms-3">
                                                            <h6 class="m-0">{{__('Inventory/Assets')}}</h6>
                                                        </div>
                                                    </div>
                                                </a>
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
    </div>
</div>

    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(array('route' => array('report.invoice.summary'),'method' => 'GET','id'=>'report_invoice_summary')) }}
                        <div class="row align-items-center justify-content-end">
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto mt-4">

                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('report_invoice_summary').submit(); return false;" data-bs-toggle="tooltip" title="{{__('Apply')}}" data-original-title="{{__('apply')}}">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>

                                        <a href="{{route('report.invoice.summary')}}" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="{{ __('Reset') }}" data-original-title="{{__('Reset')}}">
                                            <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <div id="printableArea">
        <div class="col-12" id="invoice-container">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab3" data-bs-toggle="pill" href="#purchase" role="tab" aria-controls="pills-summary" aria-selected="true">{{__('Purchase Requisition')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab4" data-bs-toggle="pill" href="#requisition" role="tab" aria-controls="pills-invoice" aria-selected="false">{{__('Store Requisition Note')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab5" data-bs-toggle="pill" href="#goods" role="tab" aria-controls="pills-invoice" aria-selected="false">{{__('Goods Received')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab6" data-bs-toggle="pill" href="#inventory" role="tab" aria-controls="pills-invoice" aria-selected="false">{{__('Inventory/Assets')}}</a>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade fade" id="purchase" role="tabpanel" aria-labelledby="profile-tab3">
                                        <table class="table table-flush table datatable" id="report-dataTable">
                                            <thead>
                                            <tr>
                                                <th> {{__('Invoice')}}</th>
                                                <th> {{__('Date')}}</th>
                                                <th> {{__('Customer')}}</th>
                                                <th> {{__('Category')}}</th>
                                                <th> {{__('Status')}}</th>
                                                <th> {{__('	Paid Amount')}}</th>
                                                <th> {{__('Due Amount')}}</th>
                                                <th> {{__('Payment Date')}}</th>
                                                <th> {{__('Amount')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {{-- @foreach ($invoices as $invoice) --}}
                                                <tr>
                                                    <td class="Id">
                                                        {{--                                                        <a href="{{ route('invoice.show', \Crypt::encrypt($invoice->id)) }}">{{ Auth::user()->invoiceNumberFormat($invoice->invoice_id) }}</a>--}}
                                                        {{-- <a href="{{ route('invoice.show',\Crypt::encrypt($invoice->id)) }}" class="btn btn-outline-primary">{{ Auth::user()->invoiceNumberFormat($invoice->invoice_id) }}</a>                                                    </td> --}}


                                                    </td>
                                                    <td></td>
                                                    <td> </td>
                                                    <td></td>
                                                    <td>

                                                    </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td></td>
                                                    <td> </td>
                                                </tr>
                                            {{-- @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade fade" id="requisition" role="tabpanel" aria-labelledby="profile-tab3">
                                        <table class="table table-flush table datatable" id="report-dataTable">
                                            <thead>
                                            <tr>
                                                <th> {{__('Store Requisition Note')}}</th>
                                                <th> {{__('Date')}}</th>
                                                <th> {{__('Customer')}}</th>
                                                <th> {{__('Category')}}</th>
                                                <th> {{__('Status')}}</th>
                                                <th> {{__('	Paid Amount')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td></td>
                                                    <td> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="tab-pane fade fade" id="goods" role="tabpanel" aria-labelledby="profile-tab3">
                                        <table class="table table-flush table datatable" id="report-dataTable">
                                            <thead>
                                            <tr>
                                                <th> {{__('Goods')}}</th>
                                                <th> {{__('Date')}}</th>
                                                <th> {{__('Customer')}}</th>
                                                <th> {{__('Category')}}</th>
                                                <th> {{__('Status')}}</th>
                                                <th> {{__('	Paid Amount')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td></td>
                                                    <td> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="tab-pane fade fade" id="inventory" role="tabpanel" aria-labelledby="profile-tab3">
                                        <table class="table table-flush table datatable" id="report-dataTable">
                                            <thead>
                                            <tr>
                                                <th> {{__('Goods')}}</th>
                                                <th> {{__('Date')}}</th>
                                                <th> {{__('Customer')}}</th>
                                                <th> {{__('Category')}}</th>
                                                <th> {{__('Status')}}</th>
                                                <th> {{__('	Paid Amount')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td></td>
                                                    <td> </td>
                                                </tr>
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
@endsection
