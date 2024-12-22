<div>
    @section('page-title')
        Requisitions for Payment Voucher Approval.
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
        <li class="breadcrumb-item">{{__('Requisitions for Payment Voucher Approval')}}</li>
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
                                        href="#pendingRequisitions" role="tab" aria-controls="pills-summary"
                                        aria-selected="true"><i class="ti ti-load"> </i>
                                        {{ __('Pending Requisitions') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-bs-toggle="pill"
                                        href="#approvedRequisitions" role="tab" aria-controls="pills-summary"
                                        aria-selected="false"><i class="ti ti-check"> </i>
                                        {{ __('Approved Requisitions') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="tab-content" id="myTabContent3" wire:ignore.self>
                                    <div class="tab-pane fade fade show active table-responsive" id="pendingRequisitions"
                                        role="tabpanel" aria-labelledby="profile-tab2" wire:ignore.self>
                                        <table class="table table-flush" id="report-dataTable" wire:ignore.self>
                                            <thead>
                                                <tr>
                                                    <th>{{ __('#') }}</th>
                                                    <th>{{ __('Staff Name') }}</th>
                                                    <th>{{ __('Department') }}</th>
                                                    <th>{{ __('RequisitionType') }}</th>
                                                    <th>{{ __('Pupose') }}</th>
                                                    <th>{{ __('Amount') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Request Date') }}</th>
                                                    <th width="200px">{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="font-style">
                                                @if ($requisitions->isEmpty())
                                                    <tr>
                                                        <td scope="col" colspan="9">
                                                            <h6 class="text-center">
                                                                {{ __('No requisition requests to approve.') }}</h6>
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($requisitions as $requisition)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $requisition->staff->name }}</td>
                                                            <td>{{ $requisition->department->name }}</td>
                                                            <td>{{ $requisition->requisition_type }}</td>
                                                            <td>{{ Str::limit($requisition->purpose, 20) }}</td>
                                                            <td> ₦ {{ number_format($requisition->amount, 2) }}</td>
                                                            <td>
                                                                @if ($requisition->status == 'pending')
                                                                    <span
                                                                        class="badge bg-warning p-2 px-3 rounded">Pending</span>
                                                                @elseif ($requisition->status == 'cash_office_approved')
                                                                    <span
                                                                        class="badge bg-success p-2 px-3 rounded">Approved</span>
                                                                @elseif ($requisition->status == 'rejected')
                                                                    <span
                                                                        class="badge bg-danger p-2 px-3 rounded">Rejected</span>
                                                                @else
                                                                    <span class="badge bg-warning p-2 px-3 rounded">
                                                                        {{ $requisition->status }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $requisition->created_at->format('d-M-Y') }}</td>
                                                            <td>
                                                                <div class="action-btn bg-primary ms-2">
                                                                    <a href="#"
                                                                        wire:click="setRequisition('{{ $requisition->id }}')"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#viewRequisitionDetailsModal"
                                                                        data-size="lg" data-bs-toggle="tooltip"
                                                                        title="{{ __('View Details') }}">
                                                                        <i class="ti ti-eye text-white"></i>
                                                                    </a>
                                                                </div>
                                                                @if($requisition->status != 'pending')
                                                                    @can('approve as pv')    
                                                                        <button class="btn btn-success btn-sm" type="submit" target="popup" 
                                                                        onclick="window.open('{{ route('requisition.voucher', $requisition->id) }}','popup', 'width=994, height=1123')">
                                                                        <i class="fa fa-print"></i> View Voucher
                                                                        </button>
                                                                    @endcan
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                            
                                    <div class="tab-pane fade fade table-responsive" id="approvedRequisitions"
                                        role="tabpanel" aria-labelledby="profile-tab3" wire:ignore.self>
                                        <table class="table table-flush" id="report-dataTable" wire:ignore.self>
                                            <thead>
                                                <tr>
                                                    <th>{{ __('#') }}</th>
                                                    <th>{{ __('Staff Name') }}</th>
                                                    <th>{{ __('Department') }}</th>
                                                    <th>{{ __('RequisitionType') }}</th>
                                                    <th>{{ __('Pupose') }}</th>
                                                    <th>{{ __('Amount') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Request Date') }}</th>
                                                    <th width="200px">{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="font-style">
                                                @if (isset($approvedRequisitions) && !empty($approvedRequisitions) && count($approvedRequisitions) > 0)
                                                    @foreach ($approvedRequisitions as $approvedRequisition)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $approvedRequisition->staff->name }}</td>
                                                            <td>{{ $approvedRequisition->department->name }}</td>
                                                            <td>{{ $approvedRequisition->requisition_type }}</td>
                                                            <td>{{ Str::limit($approvedRequisition->purpose, 20) }}</td>
                                                            <td> ₦ {{ number_format($approvedRequisition->amount, 2) }}
                                                            </td>
                                                            <td>
                                                                @if ($approvedRequisition->status == 'pending')
                                                                    <span
                                                                        class="badge bg-warning p-2 px-3 rounded">Pending</span>
                                                                @elseif ($approvedRequisition->status == 'cash_office_approved')
                                                                    <span
                                                                        class="badge bg-success p-2 px-3 rounded">Approved</span>
                                                                @elseif ($approvedRequisition->status == 'rejected')
                                                                    <span
                                                                        class="badge bg-danger p-2 px-3 rounded">Rejected</span>
                                                                @else
                                                                    <span class="badge bg-warning p-2 px-3 rounded">
                                                                        {{ $approvedRequisition->status }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $approvedRequisition->created_at->format('d-M-Y') }}
                                                            </td>
                                                            <td>
                                                                <div class="action-btn bg-primary ms-2">
                                                                    <a href="#"
                                                                        wire:click="setRequisition('{{ $approvedRequisition->id }}')"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#viewRequisitionDetailsModal"
                                                                        data-size="lg" data-bs-toggle="tooltip"
                                                                        title="{{ __('View Details') }}">
                                                                        <i class="ti ti-eye text-white"></i>
                                                                    </a>
                                                                </div>

                                                                @if($approvedRequisition->status != 'pending')
                                                                    @can('approve as pv')    
                                                                        <button class="btn btn-success btn-sm" type="submit" target="popup" 
                                                                        onclick="window.open('{{ route('requisition.voucher', $approvedRequisition->id) }}','popup', 'width=994, height=1123')">
                                                                        <i class="fa fa-print"></i> View Voucher
                                                                        </button>
                                                                    @endcan
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <th scope="col" colspan="9">
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
        @include('livewire.requisitions.modals.requisition-details')
        <x-toast-notification />
    </div>
    