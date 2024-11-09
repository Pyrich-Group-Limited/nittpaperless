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
                                <th>{{__('Credit')}}</th>
                                <th>{{__('Debit')}}</th>
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
                                        <td>₦ {{ number_format($category->remaining_amount,2) }}</td>
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
                                                @can('view budget')
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-url="{{ route('appraisal.show',$category->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Appraisal Detail')}}" data-bs-toggle="tooltip" title="{{__('View')}}" data-original-title="{{__('View Detail')}}" class="mx-3 btn btn-sm align-items-center">
                                                        <i class="ti ti-eye text-white"></i></a>
                                                </div>
                                                    @endcan
                                                @can('edit budget')
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-url="{{ route('appraisal.edit',$category->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Appraisal')}}" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit')}}" class="mx-3 btn btn-sm align-items-center">
                                                    <i class="ti ti-pencil text-white"></i></a>
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
    <x-toast-notification />
</div>
