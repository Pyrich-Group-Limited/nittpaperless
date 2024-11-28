<div>
    @section('page-title')
    {{__('My DTA Requests')}}
@endsection

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
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newDtaRequest" id="toggleOldProject"
            data-bs-toggle="tooltip" title="{{ __('Make new DTA request') }}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus text-white"> </i>New
            </a>
    </div>
@endsection

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
                                        @if ($dtaRequest->status == 'pending')
                                            <span class="badge bg-warning p-2 px-3 rounded">Pending</span>
                                            @elseif ($dtaRequest->status == 'approved')
                                            <span class="badge bg-success p-2 px-3 rounded">Approved</span>
                                            @elseif ($dtaRequest->status == 'rejected')
                                            <span class="badge bg-danger p-2 px-3 rounded">Rejected</span>
                                            @else
                                            <span class="badge bg-warning p-2 px-3 rounded">
                                                {{ $dtaRequest->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="Action">
                                        @if($dtaRequest->status!="rejected")
                                        <div class="action-btn bg-info ms-2">
                                            <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="{{ route('dta.show',$dtaRequest->id) }}" data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="{{__('DTA Details')}}"  data-title="{{__('DTA Details')}}">
                                                <i class="ti ti-eye text-white"></i>
                                            </a>
                                        </div>
                                        @endif
                                        @can('reject dta')
                                            <div class="action-btn bg-danger ms-2">
                                                <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url={{ route('reject.show',$dtaRequest->id) }} data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="{{__('Reject with Comment')}}"  data-title="{{__('Reject with Comment')}}">
                                                    <i class="ti ti-thumb-down text-white"></i>
                                                </a>
                                            </div>
                                        @endcan
                                        @if($dtaRequest->status=="rejected")
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="{{ route('rejected.show',$dtaRequest->id) }}" data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="{{__('Details')}}"  data-title="{{__('Details')}}">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                        @endif
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
@include('livewire.dta.modals.create-dta')
<x-toast-notification />


</div>