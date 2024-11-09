<div>
@section('page-title')
    {{__('Manage Budget')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Manage Budget')}}</li>
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
    @can('manage budget')
        <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newBudgetCategory" id="toggleOldProject"
        data-bs-toggle="tooltip" title="{{ __('Create new budget Category') }}" class="btn btn-sm btn-primary">
        <i class="ti ti-plus text-white"> </i>Create
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
                                <th>{{__('Chart of Account')}}</th>
                                <th>{{__('Budgeted Amount')}}</th>
                                <th>{{__('Expected Expenditure')}}</th>
                                <th>{{__('Variance')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Year')}}</th>
                                @if( Gate::check('edit budget') ||Gate::check('delete budget') ||Gate::check('view budget'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @if (isset($categories) && !empty($categories) && count($categories) > 0)
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->chartOfAccounts->code }}</td>
                                        <td> ₦ {{ number_format($category->total_amount,2) }}</td>
                                        <td>
                                            @if($category->remaining_amount==0)
                                                ₦ {{ number_format($category->total_amount + $category->deficit,2) }}
                                            {{-- @elseif($category->remaining_amount!=0) --}}
                                            @else
                                            {{-- ₦  0.00 --}}
                                            ₦ {{ number_format($category->remaining_amount,2) }}
                                            @endif
                                        </td>
                                        <td>₦ {{ number_format($category->deficit,2) }}</td>
                                        <td>
                                            @if ($category->status == 'open')
                                                <span style="color: green;">Open</span>
                                            @elseif ($category->status == 'closed')
                                                <span style="color: red;">Closed</span>
                                            @endif
                                        </td>
                                        <td>{{ $category->year }}</td>
                                        @if( Gate::check('edit budget') ||Gate::check('delete budget') || Gate::check('view budget'))
                                            <td>
                                                @can('edit budget')
                                                    @if($category->status=="closed")
                                                        <div class="action-btn bg-success ms-2">
                                                            <a href="#" wire:click="setActionId('{{$category->id}}')" class="mx-3 btn btn-sm align-items-center confirm-open" data-bs-toggle="tooltip" title="{{__('Open')}}" data-original-title="{{__('Open')}}">
                                                            {{-- <i class="ti ti-unlock text-white"></i></a> --}}
                                                            <i class="fa fa-unlock text-white"></i></a>
                                                        </div>
                                                    @else
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="#" wire:click="setActionId('{{$category->id}}')" class="mx-3 btn btn-sm align-items-center confirm-close" data-bs-toggle="tooltip" title="{{__('Close')}}" data-original-title="{{__('Close')}}">
                                                            <i class="ti ti-lock text-white"></i></a>
                                                        </div>
                                                    @endif
                                                @endcan
                                                @can('edit budget')
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" wire:click="setBudget('{{ $category->id }}')"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#updateBudgetCategory" data-size="lg"
                                                        data-bs-toggle="tooltip" title="{{ __('Update Budget') }}">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                                    @endcan
                                                @can('delete budget')
                                                <div class="action-btn bg-danger ms-2">
                                                    <a href="#" wire:click="setActionId('{{$category->id}}')" class="mx-3 btn btn-sm align-items-center confirm-delete" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}">
                                                    <i class="ti ti-trash text-white"></i></a>
                                                </div>
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
    @include('livewire.budgets.modals.set-budget')
    @include('livewire.budgets.modals.edit-budget-modal')
    <x-toast-notification />
</div>
