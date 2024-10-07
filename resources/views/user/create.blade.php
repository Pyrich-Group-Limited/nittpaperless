<div class="modal" id="newUser" tabindex="-1" role="dialog" wire:ignore>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {{Form::open(array('url'=>'users','method'=>'post'))}}
                <div class="modal-header">
                    <h5 class="modal-title" id="applyLeave">User Registration
                    </h5>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('name',__('Surname'),['class'=>'form-label']) }}
                                    {{Form::text('surname',null,array('class'=>'form-control','placeholder'=>__('Enter User Surname'),'required'=>'required'))}}
                                    @error('surname')
                                    <small class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('name',__('Firstname'),['class'=>'form-label']) }}
                                    {{Form::text('firstname',null,array('class'=>'form-control','placeholder'=>__('Enter User Firstname'),'required'=>'required'))}}
                                    @error('firstname')
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

                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('password',__('Password'),['class'=>'form-label'])}}
                                    {{Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter User Password'),'required'=>'required','minlength'=>"6"))}}
                                    @error('password')
                                    <small class="invalid-password" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group col-md-6">
                                {{ Form::label('location', __('Location'), ['class' => 'form-label']) }}
                                {!! Form::select('location', [
                                    '' => 'Select',
                                    'headquarters' => 'Headquarters',
                                    'liaison' => 'Liaison Offices'
                                ], null, array('class' => 'form-control select', 'required' => 'required', 'id' => 'select_location')) !!}
                                @error('location')
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                            <div id="liasonTog" class="form-group col-md-6" style="display: none;">
                                {{ Form::label('liason', __('Liason'),['class'=>'form-label']) }}
                                {!! Form::select('liason', ['' => 'Select a Liason Office'] + $liasons, null,array('class' => 'form-control select','id' =>'select_liason')) !!}
                                @error('liason')
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                            <div id="headquarterTog" class="form-group col-md-6" style="display: none;">
                                {{ Form::label('headquaters', __('Headquaters'),['class'=>'form-label']) }}
                                {!! Form::select('headquaters', [
                                    '' => 'Select',
                                    'directorates' => 'Directorates',
                                    'departments' => 'Departments'
                                ], 'headquarters', array('class' => 'form-control select', 'id' => 'select_headquater')) !!}
                                @error('headquaters')
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                            <div id="directorateTog" style="display: none;" class="form-group col-md-6">
                                {{ Form::label('directorate', __('Directorate'),['class'=>'form-label']) }}
                                {!! Form::select('directorate',$directorates, null, ['class' => 'form-control select','id'=>'sel_directorate']) !!}
                                {{-- {!! Form::select('directorate', ['' => 'Select a Directorate'] + $directorates, null, ['class' => 'form-control select','id'=>'sel_directorate']) !!} --}}
                                @error('directorate')
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                            <div id="departmentTog" style="display: none;" class="form-group col-md-6">
                                {{ Form::label('department', __('Department'),['class'=>'form-label']) }}
                                {!! Form::select('department', $departments, old('department'),array('class' => 'form-control select','id' =>'sel_department')) !!}
                                @error('department')
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                            <div id="depUnitTog" style="display: none;" class="form-group col-md-6">
                                {{ Form::label('unit', __('Unit'),['class'=>'form-label']) }}
                                {!! Form::select('unit', ['User Unit'], null,array('class' => 'form-control select','id'=>'department_units')) !!}
                                @error('Unit')
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                            {{-- <div id="dirUnitTog" style="display: none;" class="form-group col-md-6">
                                {{ Form::label('unit', __('Unit'),['class'=>'form-label']) }}
                                {!! Form::select('unit', ['Unit 01','Unit 02','Unit 03','Unit 4','Unit 5','Unit 6'], null,array('class' => 'form-control select','id'=>'directorate_units')) !!}
                                @error('Unit')
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                                @enderror
                            </div> --}}
                            <div class="form-group col-md-6" id="subUnitToggles">
                                {{ Form::label('subunit', __('Sub-unit'),['class'=>'form-label']) }}
                                {!! Form::select('subunit', ['User Sub-unit'], null,array('class' => 'form-control select','id'=>'subunits')) !!}
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
    @if($errors->any() || Session::has('error'))
    <script>
        $(document).ready(function(){
            console.log('user');
            document.getElementById("toggleOldUser").click();
        });
    </script>
    @endif

    @if(old('headquaters') && old('location')=="headquarters")
        <script>
            $(document).ready(function(){
                $('#headquarterTog').show();
            });
        </script>
    @else
    <script>
        $(document).ready(function(){
            $('#select_location').on('change', function(){
                $('#headquarterTog').hide();
            });
        });
    </script>
    @endif

    @if(old('directorate') && old('location')=="headquarters")
        <script>
            $(document).ready(function(){
                $('#directorateTog').show();
            });
        </script>
    @else
    <script>
        $(document).ready(function(){
            $('#directorateTog','#headquarterTog').hide();
        });
    </script>
    @endif

    @if(old('unit') && old('location')=="liaison")
        <script>
            $(document).ready(function(){
                $('#depUnitTog').show();

                let id = $('#sel_department').val();
                $('#department_units').empty();
                $('#department_units').append('<option value="" disabled selected>Processing...</options>');
                $.ajax({
                    url: '/get-department-units/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(_response){
                        var response = _response;
                        $('#department_units').empty();
                        $('#department_units').append('<option value="" disabled>Select Staff Unit...</options>');
                        response.forEach(element => {
                            $('#department_units').append(`<option value="${element['id']}">${element['name']}</options>`);
                        });
                    },
                    error: function( _response ){
                        console.log(_response);
                    }
                });
            });
        </script>
    @else
    <script>
        $(document).ready(function(){
            $('#depUnitTog').hide();
        });
    </script>
    @endif

    @if(old('department'))
        <script>
            $(document).ready(function(){
                $('#departmentTog').show();
            });
        </script>
    @else
    <script>
        $(document).ready(function(){
            $('#select_location').on('change', function(){
                $('#departmentTog').hide();
            });
        });
    </script>
    @endif

    @if(old('liason'))
        <script>
            $(document).ready(function(){
                $('#liasonTog').show();
            });
        </script>
    @else
    <script>
        $(document).ready(function(){
            $('#liasonTog').hide();
        });
    </script>
    @endif



    <script>
        var x = document.getElementById("subUnitToggles");
        x.style.display = "none"
        // $('#sel_department').append('<option value="" selected>Select Department...</options>');

        $(document).ready(function(){
            $('#select_location').on('change', function(){
                var selectedValue = $(this).val();
                // $('#liasonTog, #headquarterTog').hide();
                // alert('Location changed to: ' + selectedValue);
                if (selectedValue == "liaison") {
                    $('#liasonTog').show();
                    $('#departmentTog').show();
                    $('#depUnitTog').show();
                    $('#directorateTog, #headquarterTog').hide();
                    $('#sel_directorate').append('<option value="" selected>Select Directorate...</options>');
                    //  $('#directorateTog').hide();
                    // $('#select_liason').prop('required', true);
                } else if (selectedValue == "headquarters") {
                    $('#headquarterTog').show();
                    $('#liasonTog').hide();
                    // $('#select_headquater').prop('required', true);
                }
            })
            $('#select_headquater').on('change', function(){
                var selectedValue = $(this).val();
                $('#departmentTog, #directorateTog').hide();
                if (selectedValue == "departments") {
                    $('#departmentTog').show();
                    $('#depUnitTog').show();
                    // $('#department_units').prop('required', true);
                    // $('#department_units').prop('required', true);
                    $('#depUnitTog').show();
                    $('#department_units').append('<option value="" disabled selected>Select Staff Unit...</options>');

                } else if (selectedValue == "directorates") {
                    $('#directorateTog').show();
                    $('#dirUnitTog').show();
                    // $('#sel_directorate').prop('required', true);
                    // $('#directorate_units').prop('required', true);
                    $('#department_units').empty();
                    $('#department_units').append('<option value="" disabled selected>Select Staff Unit...</options>');
                    $('#depUnitTog').hide();

                }
            })
            //get department units
            $('#sel_department').on('change',function(){
                let id = $(this).val();
                $('#department_units').empty();
                $('#department_units').append('<option value="" disabled selected>Processing...</options>');
                    $.ajax({
                        url: '/get-department-units/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(_response){
                            var response = _response;
                            $('#department_units').empty();
                            $('#department_units').append('<option value="" disabled selected>Select Staff Unit...</options>');
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
                $('#subunits').append('<option value="" disabled selected>Processing...</options>');
                    $.ajax({
                        url: '/get-unit-subunits/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(_response){
                            var response = _response;

                            if(response!=0){
                                $('#subunits').empty();
                                $('#subunits').append('<option value="" disabled selected>Select Staff Unit...</options>');

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
