@extends('layouts.admin')
@section('page-title')
    {{__('Goods Received Notes')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('goodsReceived.list') }}">{{__('Goods Received Notes')}}</a></li>
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
                                <th>{{__('Project ID')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Supplier Name')}}</th>
                                <th>{{__('Invoice No.')}}</th>
                                <th>{{__('LPO No.')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($goods as $good)
                                <tr class="font-style">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $good->project->projectId }}</td>
                                    <td>{{ $good->created_at }}</td>
                                    <td>{{ $good->supplier_name }}</td>
                                    <td>{{ $good->invoice_no }}</td>
                                    <td>{{ $good->created_at }}</td>
                                    <td class="Action">
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="{{ route('goodsReceived.details',$good->id) }}" target="_blank" class="mx-3 btn btn-sm align-items-center"
                                                data-ajax-popup="false" data-bs-toggle="tooltip" title="{{__('Print goods receive note')}}" data-title="{{__('View Details')}}">
                                                <i class="ti ti-printer text-white"></i>
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
@endsection

