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

        <div class="form-group col-md-6">
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
            {!! Form::select('unit', $roles, null,array('class' => 'form-control select','required'=>'required','id'=>'department_units')) !!}
            @error('Unit')
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

