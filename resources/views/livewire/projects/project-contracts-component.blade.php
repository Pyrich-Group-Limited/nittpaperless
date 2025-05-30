<div>
{{-- @extends('layouts.admin') --}}
@section('page-title')
    {{__('Manage Contracts')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Contracts')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        <a href="{{ route('contract.grid') }}"  data-bs-toggle="tooltip" title="{{__('Grid View')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-layout-grid"></i>
        </a>
        <a href="#" data-size="md" data-url="{{ route('contract.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create New Contract')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">{{__('#')}}</th>
                                <th scope="col">{{__('Project Name')}}</th>
                                @if(\Auth::user()->type!='contractor')
                                    <th scope="col">{{__('Contractor')}}</th>
                                @endif
                                <th scope="col">{{__('Project')}}</th>

                                <th scope="col">{{__('Contract Type')}}</th>
                                <th scope="col">{{__('Contract Value')}}</th>
                                <th scope="col">{{__('Start Date')}}</th>
                                <th scope="col">{{__('End Date')}}</th>
                                <th scope="col">{{__('')}}</th>
                                <th scope="col" >{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($contracts as $contract)

                                <tr class="font-style">
                                    <td>
                                        <a href="{{route('contract.details',$contract->id)}}" class="btn btn-outline-primary">{{\Auth::user()->contractNumberFormat($contract->id)}}</a>
                                    </td>
                                    <td>{{ $contract->subject}}</td>
                                    @if(\Auth::user()->type!='contractor')
                                        <td>{{ !empty($contract->clients)?$contract->clients->name:'-' }}</td>
                                    @endif
                                    <td>{{ !empty($contract->projects)?$contract->projects->project_name:'-' }}</td>

                                    <td>{{$contract->projects->category->category_name }}</td>
                                    <td>{{ \Auth::user()->priceFormat($contract->value) }}</td>
                                    <td>{{  \Auth::user()->dateFormat($contract->start_date )}}</td>
                                    <td>{{  \Auth::user()->dateFormat($contract->end_date )}}</td>
                                    <td>
                                        <a href="#" class="action-item" data-url="{{ route('contract.description',$contract->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Description')}}" data-title="{{__('Description')}}"><i class="fa fa-comment"></i></a>
                                    </td>

                                    <td class="action ">
                                        @can('recommend payment')
                                            <div class="action-btn bg-success ms-2">
                                                <a href="{{ route('contracts.recommend', $contract->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                    data-bs-whatever="{{__('Recommend Payment')}}" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{__('Recommend Payment')}}"
                                                    >
                                                    <span class="text-white"> <i class="ti ti-cash"></i></span>
                                                </a>
                                            </div>
                                        @endcan

                                        @can('view recommended payment')
                                            <div class="action-btn bg-success ms-2">
                                                <a href="{{ route('contracts.recommend', $contract->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                    data-bs-whatever="{{__('View Recommended Payment')}}" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{__('View Recommended Payment')}}"
                                                    >
                                                    <span class="text-white"> <i class="ti ti-eye"></i></span>
                                                </a>
                                            </div>
                                        @endcan

                                        @if(\Auth::user()->type=='super admin')
                                            @if($contract->status=='accept')
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-size="lg"
                                                       data-url="{{ route('contract.copy', $contract->id) }}"
                                                       data-ajax-popup="true"
                                                       data-title="{{ __('Copy Contract') }}"
                                                       class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                       data-bs-toggle="tooltip" data-bs-placement="top"
                                                       title="{{ __('Duplicate') }}"><i
                                                            class="ti ti-copy text-white"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                        @can('view contract')
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="{{ route('contract.details',$contract->id) }}"
                                                   class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                   data-bs-whatever="{{__('View Contract Details')}}" data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('View')}}"> <span class="text-white"> <i class="ti ti-eye"></i></span>
                                                </a>
                                            </div>
                                        @endcan
                                        {{-- @can('edit contract')
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="{{ route('contract.edit',$contract->id) }}" data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Edit Contract')}}">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a></div>
                                        @endcan
                                        @can('delete contract')
                                            <div class="action-btn bg-danger ms-2">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['contract.destroy', $contract->id]]) !!}
                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}"><i class="ti ti-trash text-white"></i></a>
                                                {!! Form::close() !!}
                                            </div>
                                        @endcan --}}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- @endsection --}}

</div>
