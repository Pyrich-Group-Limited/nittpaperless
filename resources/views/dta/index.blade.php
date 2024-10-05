@extends('layouts.admin')
@section('page-title')
    {{__('My DTA Requests')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('My DTA Requests')}}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        {{------------ Start Filter ----------------}}
                <a href="#" class="btn btn-sm btn-primary action-item" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-filter"></i>
                </a>
                <div class="dropdown-menu  dropdown-steady" id="project_sort">
                    <a class="dropdown-item active" href="#" data-val="created_at-desc">
                        <i class="ti ti-sort-descending"></i>{{__('Newest')}}
                    </a>
                    <a class="dropdown-item" href="#" data-val="created_at-asc">
                        <i class="ti ti-sort-ascending"></i>{{__('Oldest')}}
                    </a>

                    <a class="dropdown-item" href="#" data-val="project_name-desc">
                        <i class="ti ti-sort-descending-letters"></i>{{__('From Z-A')}}
                    </a>
                    <a class="dropdown-item" href="#" data-val="project_name-asc">
                        <i class="ti ti-sort-ascending-letters"></i>{{__('From A-Z')}}
                    </a>
                </div>

            {{------------ End Filter ----------------}}

            {{------------ Start Status Filter ----------------}}
                <a href="#" class="btn btn-sm btn-primary action-item" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="btn-inner--icon">{{__('Status')}}</span>
                </a>
                <div class="dropdown-menu  project-filter-actions dropdown-steady" id="project_status">
                    <a class="dropdown-item filter-action filter-show-all pl-4 active" href="#">{{__('Show All')}}</a>
                        <a class="dropdown-item filter-action pl-4" href="#" data-val="">{{__('Status Filter')}}</a>
                </div>
            {{------------ End Status Filter ----------------}}
            <a href="#" data-size="lg" data-url="{{ route('dta.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Apply for DTA')}}" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
    </div>
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
                                <th>{{__('Destination')}}</th>
                                <th>{{__('Full Name')}}</th>
                                <th>{{__('Number of Days')}}</th>
                                <th>{{__('Travel Date')}}</th>
                                <th>{{__('Arrival Date')}}</th>
                                <th>{{__('Estimate Expenses')}}</th>
                                <th>{{__('Date Applied')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($dtaRequests as $dtaRequest)
                                    <tr class="font-style">
                                        <td>{{ $dtaRequest->destination }}</td>
                                        <td>{{ $dtaRequest->user->name }}</td>
                                        <td>
                                            {{ round(strtotime($dtaRequest->arrival_date) - strtotime($dtaRequest->travel_date))/ 86400 }} Days
                                        <td>
                                            {{ date('d-M-Y', strtotime($dtaRequest->travel_date)) }}
                                        </td>
                                        <td>{{ date('d-M-Y', strtotime($dtaRequest->arrival_date)) }}</td>
                                        <td>₦ {{ number_format($dtaRequest->estimated_expense,2)  }}</td>
                                        <td>{{ $dtaRequest->created_at->format('d-M-Y') }}</td>
                                        <td>
                                            @if($dtaRequest->status=="pending")
                                                <p class="text-warning mb-0">{{ $dtaRequest->status }} {{ $dtaRequest->current_approver.' '.'approval' }}</p>
                                            @elseif($dtaRequest->status=="rejected")
                                                <p class="text-danger mb-0">{{ $dtaRequest->status }}</p>
                                            @else
                                                <p class="text-success mb-0">{{ $dtaRequest->status }}</p>
                                            @endif
                                        </td>
                                        <td class="Action">
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="{{ route('dta.show',$dtaRequest->id) }}" data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="{{__('DTA Details')}}"  data-title="{{__('DTA Details')}}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                            @can('reject dta')
                                                <div class="action-btn bg-danger ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url={{ route('reject.show',$dtaRequest->id) }} data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="{{__('Reject with Comment')}}"  data-title="{{__('Reject with Comment')}}">
                                                        <i class="ti ti-thumb-down text-white"></i>
                                                    </a>
                                                </div>
                                            @endcan
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

