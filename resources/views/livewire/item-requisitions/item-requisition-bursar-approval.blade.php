<div>
    @section('page-title')
        {{ __('DEPARTMENTAL STORE REQUISITIONS') }}
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item">{{ __('DEPARTMENTAL STORE REQUISITIONS') }}</li>
    @endsection
    
    {{-- @section('action-btn')
        <div class="float-end">
            <a href="#" class="btn btn-primary" id="applyLeaveButton" data-bs-toggle="modal" data-bs-target="#newItemRequisition"
                data-size="lg " data-bs-toggle="tooltip">
                <i class="ti ti-plus text-white"></i>Departmental Item Requisitions
            </a>
        </div>
    @endsection --}}

    {{-- <div class="center">
        <div wire:loading wire:target="setFilter"><x-g-loader /></div>
    </div> --}}

    <div class="row mt-3">
        <div class="col-md-12 mt-3">
            @if(is_null($selectedDepartment))
                <div class="card">
                    <div class="card-header">
                        <strong>DEPARTMENTAL STORE REQUISITIONS</strong> 
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Department</th>
                                    <th>Requisitions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $departmentName => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $departmentName }}</td>
                                        <td>{{ $data['count'] }}</td>
                                        <td>
                                            <button wire:click="selectDepartment('{{ $departmentName }}')" class="btn btn-primary btn-sm">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @elseif(is_null($selectedRequisition))
                <div class="card">
                    <div class="card-header">
                        <h4>Requisitions for: {{ $selectedDepartment }}</h4>
                        <button wire:click="$set('selectedDepartment', null)" class="btn btn-primary btn-sm float-end"><i class="ti ti-back"><<</i> Back</button>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Requester</th>
                                    <th>Number of Items</th>
                                    <th>Approval Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requisitions as $index => $requisition)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $requisition->staff->name }}</td>
                                        <td>{{ $requisition->items->count() }}</td>
                                        <td>
                                            @if ($requisition->status == 'bursar_approved')
                                                <span class="badge bg-success p-2 px-3 rounded">{{ $requisition->status }}</span>
                                            @else
                                                <span class="badge bg-warning p-2 px-3 rounded">{{ $requisition->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button wire:click="selectRequisition({{ $requisition->id }})" class="btn btn-primary btn-sm">
                                                View Details
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header">
                        <h4>Requisition Details</h4>
                        <button wire:click="$set('selectedRequisition', null)" class="btn btn-primary btn-sm float-end"><i class="ti ti-back"><<</i> Back</button>
                    </div>
                    <div class="card-body">
                        <h5 class="modal-title">Requester: {{ $selectedRequisition->staff->name }}</h5>
                        <h6 class="modal-title">Status: {{ ucfirst($selectedRequisition->status) }}</h6>
                        <br>
                        <br>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__('SN')}}</th>
                                        <th>{{__('Item Name')}}</th>
                                        <th>{{__('Item Description')}}</th>
                                        <th>{{__('Quantity')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($selectedRequisition->items as $item)
                                            <tr>
                                                <td> <p>{{ $loop->iteration }}</p> </td>
                                                <td> <p>{{ $item->item_name }}</p> </td>
                                                <td> <p>{{ $item->description }}</p> </td>
                                                <td> <p>{{ $item->quantity_requested }}</p> </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label class="form-label" for="exampleFormControlTextarea1">{{__('Comment')}}</label>
                            <textarea class="form-control" wire:model.defer="comments" placeholder="Comments (optional)" rows="5"></textarea>
                            @error('comments') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div wire:loading wire:target="approveRequisition"><x-g-loader /></div>
                        <div wire:loading wire:target="rejectRequisition"><x-g-loader /></div>

                        @if ($selectedRequisition->status !='hod_approved')
                                <span class="badge bg-success">You have approved this requisition</span>
                        @else
                            <button wire:click="approveRequisition" class="btn btn-success btn-sm">Approve</button>
                            <button wire:click="rejectRequisition" class="btn btn-danger btn-sm">Reject</button>
                        @endif
                        
                    </div>
                </div>
            @endif
        </div>
    </div>
    <x-toast-notification />
</div>


