@extends('layouts.admin')
@section('page-title')
    {{__('Manage Unit')}}
@endsection @section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Unit')}}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        @can('create branch')
            <a href="#" data-url="{{ route('unit.create') }}" data-ajax-popup="true" data-title="{{__('Create New Branch')}}" data-bs-toggle="tooltip" title="{{__('Create')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-3">
            @include('layouts.hrm_setup')
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body table-border-style">

                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('Unit')}}</th>
                                <th width="200px">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            @foreach ($units as $unit)
                                <tr>
                                    <td>{{ $unit->name }}</td>
                                    <td class="Action text-end">
                                        <span>
                                            @can('edit branch')
                                                <div class="action-btn bg-primary ms-2">
                                                <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="{{ URL::to('unit/'.$unit->id.'/edit') }}"  data-ajax-popup="true" data-title="{{__('Edit Unit')}}" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit')}}"><i class="ti ti-pencil text-white"></i></a>
                                            </div>
                                            @endcan
                                            @can('delete branch')
                                                <div class="action-btn bg-danger ms-2">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['unit.destroy', $unit->id],'id'=>'delete-form-'.$unit->id]) !!}

                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$unit->id}}').submit();"><i class="ti ti-trash text-white text-white"></i></a>
                                                {!! Form::close() !!}
                                            </div>
                                            @endcan
                                        </span>
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
@endsection
