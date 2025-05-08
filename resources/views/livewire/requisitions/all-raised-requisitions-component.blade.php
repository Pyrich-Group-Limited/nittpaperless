<div>
    @section('page-title')
        {{__('Requisitions')}}
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
        <li class="breadcrumb-item">{{__('Requisitions')}}</li>
    @endsection
    @push('css-page')
        <style>
            @import url({{ asset('css/font-awesome.css') }});
        </style>
    @endpush
    
        <div class="d-flex justify-content-end gap-2">
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
    
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                <div class="card-body table-border-style">
                        <div class="table-responsive">
                        <table class="table">
                                <thead>
                                <tr>
                                    <th>{{__('#')}}</th>
                                    <th>{{__('Staff Name')}}</th>
                                    <th>{{__('Department')}}</th>
                                    <th>{{__('RequisitionType')}}</th>
                                    <th>{{__('Pupose')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Status')}}</th>
                                    {{-- <th>{{__('Description')}}</th> --}}
                                    <th>{{__('Request Date')}}</th>
                                    <th width="200px">{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody class="font-style">
                                @if (isset($requisitions) && !empty($requisitions) && count($requisitions) > 0)
                                    @foreach ($requisitions as $requisition)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $requisition->staff->name }}</td>
                                            <td>{{ $requisition->department->name }}</td>
                                            <td>{{ $requisition->requisition_type }}</td>
                                            <td>{{ Str::limit($requisition->purpose,20) }}</td>
                                            <td> ₦ {{ number_format($requisition->amount,2) }}</td>
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
                                            {{-- <td style="word-wrap: normal">{{ Str::limit($requisition->description,20) }}</td> --}}
                                            <td>{{ $requisition->created_at->format('d-M-Y') }}</td>
                                                <td>
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" wire:click="setRequisition('{{ $requisition->id }}')"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#viewRequisitionDetailsModal" data-size="lg"
                                                            data-bs-toggle="tooltip" title="{{ __('View Details') }}">
                                                            <i class="ti ti-eye text-white"></i>
                                                        </a>
                                                    </div>
                                                    @if($requisition->status != 'pending')
                                                        {{-- @can('print voucher')     --}}
                                                            <button class="btn btn-success btn-sm" type="submit" target="popup" 
                                                            onclick="window.open('{{ route('requisition.voucher', $requisition->id) }}','popup', 'width=994, height=1123')">
                                                            <i class="fa fa-print"></i> Print Voucher
                                                            </button>
                                                        {{-- @endcan --}}
                                                    @endif

                                                    

                                                    {{-- <div class="action-btn bg-warning ms-2">
                                                        <a href="#" wire:click="setRequisition('{{ $requisition->id }}')"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modifyRequisition" data-size="lg"
                                                            data-bs-toggle="tooltip" title="{{ __('Update') }}">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <a href="#" wire:click="setActionId('{{$requisition->id}}')" class="mx-3 btn btn-sm align-items-center confirm-delete" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}">
                                                        <i class="ti ti-trash text-white"></i></a>
                                                    </div> --}}
                                                </td>
                                            {{-- @endif --}}
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
        {{-- @include('livewire.requisitions.modals.raise-requisition-modal')
        @include('livewire.requisitions.modals.edit-requisition')--}}
        @include('livewire.requisitions.modals.requisition-details') 
        <x-toast-notification />
    </div>
    