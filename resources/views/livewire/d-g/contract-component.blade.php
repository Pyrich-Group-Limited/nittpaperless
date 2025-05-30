<div>
    {{-- @extends('layouts.admin') --}}
    @section('page-title')
        {{__('Awarded Contracts')}}
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
            @if(\Auth::user()->type == 'super admin')
                <a href="#" data-size="md" data-url="{{ route('contract.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create New Contract')}}" class="btn btn-sm btn-primary">
                    <i class="ti ti-plus"></i>
                </a>
            @endif
        </div>
    @endsection

    {{-- @section('content') --}}
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th scope="col">{{__('#')}}</th>
                                    <th scope="col">{{__('Subject')}}</th>
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
                                    {{-- {{ dd($contracts) }} --}}
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

                                        <td>{{ $contract->projects->category->category_name }}</td>
                                        <td>{{ \Auth::user()->priceFormat($contract->value) }}</td>
                                        <td>{{  \Auth::user()->dateFormat($contract->start_date )}}</td>
                                        <td>{{  \Auth::user()->dateFormat($contract->end_date )}}</td>
                                        <td>
                                            <a href="#" class="action-item" data-url="{{ route('contract.description',$contract->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Description')}}" data-title="{{__('Desciption')}}"><i class="fa fa-comment"></i></a>
                                        </td>

                                        <td class="action ">
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
                                            {{-- @can('show contract') --}}
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="{{ route('contract.details',$contract->id) }}"
                                                   class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                   data-bs-whatever="{{__('View Contract Details')}}" data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('View')}}"> <span class="text-white"> <i class="ti ti-eye"></i></span>
                                                </a>
                                            </div>
                                            {{-- @endcan --}}
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
