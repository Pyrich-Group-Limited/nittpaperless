<div>
    @section('page-title')
        {{ __('Department Budget for Approval') }}
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item">{{ __('Department Budget for Approval') }}</li>
    @endsection
    @push('css-page')
        <style>
            @import url({{ asset('css/font-awesome.css') }});
        </style>
    @endpush

    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table" id="bgt_table">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Department') }}</th>
                                    <th>{{ __('Budget Category') }}</th>
                                    <th>{{ __('Total Amount') }}</th>
                                    <th>{{ __('Submitted On') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th width="200px">{{ __('Action') }}</th>
                                    {{-- @if (Gate::check('edit appraisal') || Gate::check('delete appraisal') || Gate::check('show appraisal'))
                                @endif --}}
                                </tr>
                            </thead>
                            <tbody class="font-style">
                                @if (isset($departmentBudgets) && !empty($departmentBudgets) && count($departmentBudgets) > 0)
                                    @foreach ($departmentBudgets as $budget)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $budget->department->name }}</td>
                                            <td>{{ $budget->budgetCategory->name }}</td>
                                            <td>₦ {{ number_format($budget->total_requested, 2) }}</td>
                                            <td>{{ $budget->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if ($budget->status == 'pending')
                                                    <span style="color: orange;">Pending</span>
                                                @elseif ($budget->status == 'pending_dg_approval')
                                                    <span style="color: rgb(8, 110, 128);">Pending DG Approval</span>
                                                @elseif ($budget->status == 'approved')
                                                    <span style="color: green;">Approved</span>
                                                @elseif ($budget->status == 'rejected')
                                                    <span style="color: red;">Rejected</span>
                                                @endif
                                            </td>
                                            {{-- @if (Gate::check('edit appraisal') || Gate::check('delete appraisal') || Gate::check('show appraisal')) --}}
                                            <td>
                                                @can('view budget') 
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="#" wire:click="setBudget('{{ $budget->id }}')"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-bs-toggle="modal" id="toggleApplicantDetails"
                                                            data-bs-target="#viewBudgetModal" data-size="lg"
                                                            data-bs-toggle="tooltip" title="{{ __('View Budget Details') }}"
                                                            data-title="{{ __('View Budget Details') }}">
                                                            <i class="ti ti-eye text-white"></i>
                                                        </a>
                                                    </div>
                                                    @if(auth()->user()->type=="accountant" && $budget->status == 'pending')
                                                        <div class="action-btn bg-primary ms-2">
                                                            <a href="#" wire:click="markPendingDgApproval({{ $budget->id }})"
                                                                title="{{ __('Forward to DG') }}"
                                                                class="mx-3 btn btn-sm align-items-center" >
                                                                <i class="ti ti-check text-white"></i></a>
                                                        </div>
                                                    @endif
                                                @endcan
                                                @can('approve budget')
                                                    @if(auth()->user()->type=="DG")
                                                        <div class="action-btn bg-primary ms-2">
                                                            <a href="#" wire:click="approveBudget({{ $budget->id }})"
                                                                title="{{ __('Approve Budget') }}"
                                                                class="mx-3 btn btn-sm align-items-center @if ($budget->status == 'approved') disabled @endif" >
                                                                <i class="ti ti-check text-white"></i></a>
                                                        </div>
                                                    @endif
                                                @endcan

                                                @can('approve budget')
                                                    @if($budget->status != 'rejected')
                                                        <div class="action-btn bg-danger ms-2">
                                                            <a href="#" wire:click="$set('selectedBudgetId', {{ $budget->id }})"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                data-bs-toggle="modal" id="toggleApplicantDetails"
                                                                data-bs-target="#rejectModal" data-size="lg"
                                                                data-bs-toggle="tooltip" title="{{ __('Reject Budget') }}"
                                                                >
                                                                <i class="ti ti-arrow-left text-white"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endcan
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
    @include('livewire.budgets.modals.budget-details')
    @include('livewire.budgets.modals.reject-budget-modal')
    <x-toast-notification />
</div>
