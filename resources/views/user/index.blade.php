@extends('layouts.admin')

@php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{__('Manage User')}}
@endsection
@push('script-page')

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Client')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        @if (\Auth::user()->type == 'super admin' || \Auth::user()->type == 'HR')
            <a href="{{ route('user.userlog') }}" class="btn btn-primary btn-sm {{ Request::segment(1) == 'user' }}"
               data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('User Logs History') }}"><i class="ti ti-user-check"></i>
            </a>
        @endif
        @can('create user')
        <!-- {{-- data-url="{{ route('users.create') }}" --}} -->
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newUser"  data-bs-toggle="tooltip" title="{{__('Create')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                @foreach($users as $user)
                    <div class="col-md-3 mb-4">
                        <div class="card text-center card-2">
                            <div class="card-header border-0 pb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        <div class=" badge bg-primary p-2 px-3 rounded">
                                            {{ ucfirst($user->type) }}
                                        </div>
                                    </h6>

                                </div>

                                <div class="card-header-right">
                                    <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            @can('edit user')
                                                <a href="#!" data-size="lg" data-url="{{ route('users.edit',$user->id) }}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Edit User')}}">
                                                    <i class="ti ti-pencil"></i>
                                                    <span>{{__('Edit')}}</span>
                                                </a>
                                            @endcan

                                            @can('delete user')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user['id']],'id'=>'delete-form-'.$user['id']]) !!}
                                                <a href="#!"  class="dropdown-item bs-pass-para">
                                                    <i class="ti ti-archive"></i>
                                                    <span> @if($user->delete_status!=0){{__('Delete')}} @else {{__('Restore')}}@endif</span>
                                                </a>

                                                {!! Form::close() !!}
                                            @endcan
                                            <a href="#!" data-url="{{route('users.reset',\Crypt::encrypt($user->id))}}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Reset Password')}}">
                                                <i class="ti ti-adjustments"></i>
                                                <span>  {{__('Reset Password')}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body full-card">
                                <div class="img-fluid rounded-circle card-avatar">
                                    <img src="{{(!empty($user->avatar))? asset(Storage::url("uploads/avatar/".$user->avatar)): asset('uploads/user.png') }}"  class="img-user wid-80 rounded-circle">
                                </div>
                                <h4 class=" mt-2 text-primary">{{ $user->name }}</h4>
                                <small class="text-primary">{{ $user->email }}</small>
                                <p></p>


                                <div class="col text-center d-block h6 mb-0" data-bs-toggle="tooltip" title="{{__('Last Login')}}">
                                    {{ (!empty($user->last_login_at)) ? $user->last_login_at : '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal" id="newUser" tabindex="-1" role="dialog" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{Form::open(array('url'=>'users','method'=>'post'))}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('name',__('Name'),['class'=>'form-label']) }}
                                        {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter User Name'),'required'=>'required'))}}
                                        @error('name')
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('email',__('Email'),['class'=>'form-label'])}}
                                        {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email'),'required'=>'required'))}}
                                        @error('email')
                                        <small class="invalid-email" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('password',__('Password'),['class'=>'form-label'])}}
                                        {{Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter User Password'),'required'=>'required','minlength'=>"6"))}}
                                        @error('password')
                                        <small class="invalid-password" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('Location', __('Location'),['class'=>'form-label']) }}
                                    {!! Form::select('location', ['' => 'Select a Location'] +  ['Headquaters','Liason Offices'], null,array('class' => 'form-control select','required'=>'required','id' =>'select_location')) !!}
                                    @error('Location')
                                    <small class="invalid-role" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                                <div id="liasonTog" class="form-group col-md-6" style="display: none;">
                                    {{ Form::label('liason', __('Liason'),['class'=>'form-label']) }}
                                    {!! Form::select('liason', ['' => 'Select a Liason Office'] + $liasons, null,array('class' => 'form-control select','required'=>'required')) !!}
                                    @error('liason')
                                    <small class="invalid-role" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                                <div id="headquarterTog" class="form-group col-md-6" style="display: none;">
                                    {{ Form::label('headquaters', __('HeadQauter'),['class'=>'form-label']) }}
                                    {!! Form::select('headquaters', ['' => 'Select a HeadQauter'] + $headquaters, null,array('class' => 'form-control select','required'=>'required','id' =>'select_headquater')) !!}
                                    @error('headquaters')
                                    <small class="invalid-role" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                                <div id="directorateTog" style="display: none;" class="form-group col-md-6">
                                    {{ Form::label('directorate', __('Directorate'),['class'=>'form-label']) }}
                                    {!! Form::select('directorate', ['' => 'Select a Directorate'] + $directorates, null, ['class' => 'form-control select', 'required' => 'required']) !!}
                                    @error('directorate')
                                    <small class="invalid-role" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                                <div id="departmentTog" style="display: none;" class="form-group col-md-6">
                                    {{ Form::label('department', __('Department'),['class'=>'form-label']) }}
                                    {!! Form::select('department', $departments, null,array('class' => 'form-control select','required'=>'required','id' =>'sel_department')) !!}
                                    @error('Department')
                                    <small class="invalid-role" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('unit', __('Unit'),['class'=>'form-label']) }}
                                    {!! Form::select('unit', ['User Unit'], null,array('class' => 'form-control select','required'=>'required','id'=>'department_units')) !!}
                                    @error('Unit')
                                    <small class="invalid-role" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12" id="subUnitToggles">
                                    {{ Form::label('subunit', __('Sub-unit'),['class'=>'form-label']) }}
                                    {!! Form::select('subunit', ['User Sub-unit'], null,array('class' => 'form-control select','required'=>'required','id'=>'subunits')) !!}
                                    @error('subunit')
                                    <small class="invalid-role" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                                @if(\Auth::user()->type == 'super admin' || \Auth::user()->type == 'hrm')
                                    <div class="form-group col-md-6">
                                        {{ Form::label('role', __('User Role'),['class'=>'form-label']) }}
                                        {!! Form::select('role', $roles, null,array('class' => 'form-control select','required'=>'required')) !!}
                                        @error('role')
                                        <small class="invalid-role" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </small>
                                        @enderror
                                    </div>
                                @else
                                {!! Form::hidden('role', 'super admin', null,array('class' => 'form-control select2','required'=>'required')) !!}
                                @endif

                                <div class="form-group col-md-6">
                                    {{ Form::label('designation', __('Designation'),['class'=>'form-label']) }}
                                    {!! Form::select('designation', $designations, null,array('class' => 'form-control select','required'=>'required')) !!}
                                    @error('designation')
                                    <small class="invalid-role" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>


                                <div class="form-group col-md-6">
                                    {{ Form::label('level', __('Level'),['class'=>'form-label']) }}
                                    {!! Form::select('level', ['Level 07','Level 08','Level 09','Level 11','Level 12','Level 13','Level 14','Level 15'], null,array('class' => 'form-control select','required'=>'required')) !!}
                                    @error('Level')
                                    <small class="invalid-role" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>

                                @if(!$customFields->isEmpty())
                                    <div class="col-md-6">
                                        <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                                            @include('customFields.formBuilder')
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>

                        <div class="modal-footer">
                            <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
                            <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>



    @push('script')
    <script>
        var x = document.getElementById("subUnitToggles");
         x.style.display = "none"
         $('#sel_department').append('<option value="0" selected>Select Department...</options>');

        $(document).ready(function(){
            $('#select_location').on('change', function(){
                var selectedValue = $(this).val();
                $('#liasonTog, #headquarterTog').hide();
                if (selectedValue == 1) {
                    $('#liasonTog').show();
                    $('#departmentTog').show();
                } else if (selectedValue == 0) {
                    $('#headquarterTog').show();
                }
            })
            $('#select_headquater').on('change', function(){
                var selectedValue = $(this).val();
                $('#departmentTog, #directorateTog').hide();
                if (selectedValue == 1) {
                    $('#departmentTog').show();
                } else if (selectedValue == 0) {
                    $('#directorateTog').show();
                }
            })
            //get department units
            $('#sel_department').on('change',function(){
                let id = $(this).val();
                $('#department_units').empty();
                $('#department_units').append('<option value="0" disabled selected>Processing...</options>');
                    $.ajax({
                        url: '/get-department-units/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(_response){
                            var response = _response;
                            $('#department_units').empty();
                            $('#department_units').append('<option value="0" disabled selected>Select Staff Unit...</options>');
                            response.forEach(element => {
                                $('#department_units').append(`<option value="${element['id']}">${element['name']}</options>`);
                            });
                        },
                        error: function( _response ){
                            console.log(_response);
                        }
                    });
            });

            //get department subunit
            $('#department_units').on('change',function(){
                let id = $(this).val();
                $('#subunits').empty();
                $('#subunits').append('<option value="0" disabled selected>Processing...</options>');
                    $.ajax({
                        url: '/get-unit-subunits/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(_response){
                            var response = _response;

                            if(response!=0){
                                $('#subunits').empty();
                                $('#subunits').append('<option value="0" disabled selected>Select Staff Unit...</options>');

                                response.forEach(unit_sub => {
                                var x = document.getElementById("subUnitToggles");
                                x.style.display = "block"
                                $('#subunits').append(`<option value="${unit_sub['id']}">${unit_sub['name']}</options>`);
                            });
                            }else{
                                var x = document.getElementById("subUnitToggles");
                                x.style.display = "none"
                                // document.getElementById("subUnitToggles").style.display === "none";
                            }

                        },
                        error: function( _response ){
                            console.log(_response);
                        }
                    });
            });
        });
    </script>
    @endpush
@endsection
