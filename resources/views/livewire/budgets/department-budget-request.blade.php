<div>
    @section('page-title')
        {{__('Department Budget')}}
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
        <li class="breadcrumb-item">{{__('Department Budget')}}</li>
    @endsection
    @push('css-page')
        <style>
            @import url({{ asset('css/font-awesome.css') }});
        </style>
    @endpush

    @section('action-btn')
        <div class="float-end">
        @can('create appraisal')
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newBudgetModal" id="toggleOldProject"
            data-bs-toggle="tooltip" title="{{ __('Create new budget') }}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus text-white"> </i>New
            </a>
            @endcan
        </div>
    @endsection

        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                <div class="card-body table-border-style">
                        <div class="table-responsive">
                        <table class="table datatable">
                                <thead>
                                <tr>
                                    <th>{{__('#')}}</th>
                                    {{-- <th>{{__('Department')}}</th> --}}
                                    <th>{{__('Budget Category')}}</th>
                                    <th>{{__('Total Amount')}}</th>
                                    <th>{{__('Submitted On')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th width="200px">{{__('Action')}}</th>
                                    {{-- @if( Gate::check('edit appraisal') ||Gate::check('delete appraisal') ||Gate::check('show appraisal'))
                                    @endif --}}
                                </tr>
                                </thead>
                                <tbody class="font-style">
                                    @foreach ($departmentBudgets as $budget)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $budget->department->name }}</td> --}}
                                        <td>{{ $budget->budgetCategory->name }}</td>
                                        <td>₦ {{ number_format($budget->total_requested,2) }}</td>
                                        <td>{{ $budget->created_at->format('d M Y') }}</td>
                                        <td>
                                            {{-- {{ $budget->status }} --}}
                                            @if ($budget->status == 'pending')
                                                <span style="color: orange;">Pending</span>
                                            @elseif ($budget->status == 'approved')
                                                <span style="color: green;">Approved</span>
                                            @elseif ($budget->status == 'rejected')
                                                <span style="color: red;">Rejected</span>
                                            @endif
                                        </td>
                                        {{-- @if( Gate::check('edit appraisal') ||Gate::check('delete appraisal') ||Gate::check('show appraisal')) --}}
                                            <td>
                                                @can('show appraisal')
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-url="{{ route('appraisal.show',$budget->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Appraisal Detail')}}" data-bs-toggle="tooltip" title="{{__('View')}}" data-original-title="{{__('View Detail')}}" class="mx-3 btn btn-sm align-items-center">
                                                        <i class="ti ti-eye text-white"></i></a>
                                                </div>
                                                    @endcan
                                                @can('edit appraisal')
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-url="{{ route('appraisal.edit',$budget->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Appraisal')}}" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit')}}" class="mx-3 btn btn-sm align-items-center">
                                                    <i class="ti ti-pencil text-white"></i></a>
                                                </div>
                                                    @endcan
                                                @can('delete appraisal')
                                                <div class="action-btn bg-danger ms-2">
                                                    <form action="" method="DELETE" wire:submit.prevent='destroy'>
                                                {{-- {!! Form::open(['method' => 'DELETE', 'route' => ['appraisal.destroy', $budget->id],'id'=>'delete-form-'.$budget->id]) !!} --}}
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm-yes="document.getElementById('delete-form-{{$budget->id}}').submit();">
                                                    <i class="ti ti-trash text-white"></i></a>
                                                    </form>
                                                    {{-- {!! Form::close() !!} --}}
                                                </div>
                                                @endcan
                                            </td>
                                        {{-- @endif --}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('livewire.budgets.modals.set-budget-request')
        <x-toast-notification />
    </div>
