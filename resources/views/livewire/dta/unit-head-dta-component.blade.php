<div>
    @section('page-title')
        DTA Request for Unit Head Approval.
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
        <li class="breadcrumb-item">{{__('DTA Request for Approval.')}}</li>
    @endsection
    @push('css-page')
        <style>
            @import url({{ asset('css/font-awesome.css') }});
        </style>
    @endpush
    
    @section('action-btn')
        <div class="float-end">
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
        </div>
    @endsection

    <div class="row mt-3">
        <div id="printableArea">
            <div class="col-12" id="invoice-container">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab2" data-bs-toggle="pill"
                                        href="#pendingDtas" role="tab" aria-controls="pills-summary"
                                        aria-selected="true"><i class="ti ti-load"> </i>
                                        {{ __('Pending DTA Requests') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-bs-toggle="pill"
                                        href="#approvedDtas" role="tab" aria-controls="pills-summary"
                                        aria-selected="false"><i class="ti ti-check"> </i>
                                        {{ __('Approved DTA Requests') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="tab-content" id="myTabContent3" wire:ignore.self>
                                    <div class="tab-pane fade fade table-responsive" id="pendingDtas"
                                        role="tabpanel" aria-labelledby="profile-tab2" wire:ignore.self>
                                        <table class="table table-flush" id="report-dataTable" wire:ignore.self>
                                            <thead>
                                                <tr>
                                                    <th>{{__('#')}}</th>
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
                                            <tbody class="font-style">
                                                @if (isset($dtaRequests) && !empty($dtaRequests) && count($dtaRequests) > 0)
                                                    @foreach ($dtaRequests as $dtaRequest)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
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
                                                            <td>
                                                                <div class="action-btn bg-primary ms-2">
                                                                    <a href="#" wire:click="setDta('{{ $dtaRequest->id }}')"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#viewDtaIformationModal" data-size="lg"
                                                                        data-bs-toggle="tooltip" title="{{ __('View DTA Details') }}">
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
                                                @else
                                                    <tr>
                                                        <th scope="col" colspan="10">
                                                            <h6 class="text-center">{{ __('No Record Found.') }}</h6>
                                                        </th>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                            
                                    <div class="tab-pane fade fade table-responsive" id="approvedDtas"
                                        role="tabpanel" aria-labelledby="profile-tab3" wire:ignore.self>
                                        <table class="table table-flush" id="report-dataTable" wire:ignore.self>
                                            <thead>
                                                <tr>
                                                    <th>{{__('#')}}</th>
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
                                            <tbody class="font-style">
                                                @if (isset($approvedDtaRequests) && !empty($approvedDtaRequests) && count($approvedDtaRequests) > 0)
                                                    @foreach ($approvedDtaRequests as $approvedDtaRequest)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $approvedDtaRequest->destination }}</td>
                                                            <td>{{ $approvedDtaRequest->user->name }}</td>
                                                            <td>
                                                                {{ round(strtotime($approvedDtaRequest->arrival_date) - strtotime($approvedDtaRequest->travel_date))/ 86400 }} Days
                                                            <td>
                                                                {{ date('d-M-Y', strtotime($approvedDtaRequest->travel_date)) }}
                                                            </td>
                                                            <td>{{ date('d-M-Y', strtotime($approvedDtaRequest->arrival_date)) }}</td>
                                                            <td>₦ {{ number_format($approvedDtaRequest->estimated_expense,2)  }}</td>
                                                            <td>{{ $approvedDtaRequest->created_at->format('d-M-Y') }}</td>
                                                            <td>
                                                                @if ($approvedDtaRequest->status == 'pending')
                                                                <span class="badge bg-warning p-2 px-3 rounded">Pending</span>
                                                                @elseif ($approvedDtaRequest->status == 'approved')
                                                                <span class="badge bg-success p-2 px-3 rounded">Approved</span>
                                                                @elseif ($approvedDtaRequest->status == 'rejected')
                                                                <span class="badge bg-danger p-2 px-3 rounded">Rejected</span>
                                                                @else
                                                                <span class="badge bg-warning p-2 px-3 rounded">
                                                                    {{ $approvedDtaRequest->status }}
                                                                </span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="action-btn bg-primary ms-2">
                                                                    <a href="#" wire:click="setDta('{{ $approvedDtaRequest->id }}')"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#viewDtaIformationModal" data-size="lg"
                                                                        data-bs-toggle="tooltip" title="{{ __('View DTA Details') }}">
                                                                        <i class="ti ti-eye text-white"></i>
                                                                    </a>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <th scope="col" colspan="10">
                                                            <h6 class="text-center">{{ __('No Record Found.') }}</h6>
                                                        </th>
                                                    </tr>
                                                @endif
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
        @include('livewire.dta.modals.dta-details')
        <x-toast-notification />
    </div>
    