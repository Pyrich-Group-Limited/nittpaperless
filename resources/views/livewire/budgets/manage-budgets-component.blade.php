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
    @can('create appraisal')
        <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newBudgetCategory" id="toggleOldProject"
        data-bs-toggle="tooltip" title="{{ __('Create new budget Category') }}" class="btn btn-sm btn-primary">
        <i class="ti ti-plus text-white"> </i>Create
        </a>
        @endcan
    </div>
@endsection

    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-body table-border-style">
                    <div class="table-responsive">
                    <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('#')}}</th>
                                <th>{{__('Budget Category')}}</th>
                                <th>{{__('Total Amount')}}</th>
                                <th>{{__('Remaining Amount')}}</th>
                                <th>{{__('Status')}}</th>
                                @if( Gate::check('edit appraisal') ||Gate::check('delete appraisal') ||Gate::check('show appraisal'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td> ₦ {{ number_format($category->total_amount,2) }}</td>
                                    <td>₦ {{ number_format($category->remaining_amount,2) }}</td>
                                    <td>{{ $category->status }}</td>
                                    @if( Gate::check('edit appraisal') ||Gate::check('delete appraisal') ||Gate::check('show appraisal'))
                                        <td>
                                            @can('show appraisal')
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" data-url="{{ route('appraisal.show',$category->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Appraisal Detail')}}" data-bs-toggle="tooltip" title="{{__('View')}}" data-original-title="{{__('View Detail')}}" class="mx-3 btn btn-sm align-items-center">
                                                    <i class="ti ti-eye text-white"></i></a>
                                            </div>
                                                @endcan
                                            @can('edit appraisal')
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" data-url="{{ route('appraisal.edit',$category->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Appraisal')}}" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit')}}" class="mx-3 btn btn-sm align-items-center">
                                                <i class="ti ti-pencil text-white"></i></a>
                                            </div>
                                                @endcan
                                            @can('delete appraisal')
                                            <div class="action-btn bg-danger ms-2">
                                                <form action="" method="DELETE" wire:submit.prevent='destroy'>
                                            {{-- {!! Form::open(['method' => 'DELETE', 'route' => ['appraisal.destroy', $category->id],'id'=>'delete-form-'.$category->id]) !!} --}}
                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm-yes="document.getElementById('delete-form-{{$category->id}}').submit();">
                                                <i class="ti ti-trash text-white"></i></a>
                                                </form>
                                                {{-- {!! Form::close() !!} --}}
                                            </div>
                                            @endcan
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
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
