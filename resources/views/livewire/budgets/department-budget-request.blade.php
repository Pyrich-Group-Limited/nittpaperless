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
        @can('set budget')
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
                        <table class="table">
                                <thead>
                                <tr>
                                    <th>{{__('#')}}</th>
                                    <th>{{__('Budget Category')}}</th>
                                    <th>{{__('Total Amount')}}</th>
                                    <th>{{__('Submitted On')}}</th>
                                    <th>{{__('Status')}}</th>
                                    @if( Gate::check('edit budget') ||Gate::check('delete budget') ||Gate::check('view budget'))
                                    <th width="200px">{{__('Action')}}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody class="font-style">
                                    @if (isset($departmentBudgets) && !empty($departmentBudgets) && count($departmentBudgets) > 0)
                                        @foreach ($departmentBudgets as $budget)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $budget->budgetCategory->name }}</td>
                                            <td>₦ {{ number_format($budget->total_requested,2) }}</td>
                                            <td>{{ $budget->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if ($budget->status == 'pending')
                                                    <span style="color: orange;">Pending</span>
                                                @elseif ($budget->status == 'approved')
                                                    <span style="color: green;">Approved</span>
                                                @elseif ($budget->status == 'rejected')
                                                    <span style="color: red;">Rejected</span>
                                                @endif
                                            </td>
                                            @if( Gate::check('edit budget') ||Gate::check('delete budget') ||Gate::check('view budget'))
                                                <td>
                                                    @can('view budget')
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" wire:click="setBudget('{{ $budget->id }}')"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-bs-toggle="modal" id="toggleApplicantDetails"
                                                            data-bs-target="#viewBudgetModal" data-size="lg"
                                                            data-bs-toggle="tooltip" title="{{ __('View Budget Details') }}"
                                                            data-title="{{ __('View Budget Details') }}">
                                                            <i class="ti ti-eye text-white"></i>
                                                        </a>
                                                    </div>
                                                    @endcan
                                                    
                                                    @can('delete budget')
                                                    @if ($budget->status == 'pending')
                                                        <div class="action-btn bg-danger ms-2">
                                                            <a href="#" wire:click="setActionId('{{$budget->id}}')" class="mx-3 btn btn-sm align-items-center confirm-delete" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}">
                                                            <i class="ti ti-trash text-white"></i></a>
                                                        </div>
                                                    @endif
                                                    @endcan
                                                </td>
                                            @endif
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
        @include('livewire.budgets.modals.set-budget-request')
        @include('livewire.budgets.modals.budget-details')
        <x-toast-notification />
    </div>
