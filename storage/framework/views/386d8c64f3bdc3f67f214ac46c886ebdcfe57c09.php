<div class="modal" id="newUser" tabindex="-1" role="dialog" wire:ignore>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <?php echo e(Form::open(array('url'=>'users','method'=>'post'))); ?>

                <div class="modal-header">
                    <h5 class="modal-title" id="applyLeave">User Registration
                    </h5>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('name',__('Surname'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::text('surname',null,array('class'=>'form-control','placeholder'=>__('Enter User Surname'),'required'=>'required'))); ?>

                                    <?php $__errorArgs = ['surname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="invalid-name" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('name',__('Firstname'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::text('firstname',null,array('class'=>'form-control','placeholder'=>__('Enter User Firstname'),'required'=>'required'))); ?>

                                    <?php $__errorArgs = ['firstname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="invalid-name" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email'),'required'=>'required'))); ?>

                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="invalid-email" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            
                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('location', __('Location'), ['class' => 'form-label'])); ?>

                                <?php echo Form::select('location', [
                                    '' => 'Select',
                                    'headquarters' => 'Headquarters',
                                    'liaison' => 'Liaison Offices'
                                ], null, array('class' => 'form-control select', 'required' => 'required', 'id' => 'select_location')); ?>

                                <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div id="liasonTog" class="form-group col-md-6" style="display: none;">
                                <?php echo e(Form::label('liason', __('Liason'),['class'=>'form-label'])); ?>

                                <?php echo Form::select('liason', ['' => 'Select a Liason Office'] + $liasons, null,array('class' => 'form-control select','id' =>'select_liason')); ?>

                                <?php $__errorArgs = ['liason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div id="headquarterTog" class="form-group col-md-6" style="display: none;">
                                <?php echo e(Form::label('headquaters', __('Headquaters'),['class'=>'form-label'])); ?>

                                <?php echo Form::select('headquaters', [
                                    '' => 'Select',
                                    'directorates' => 'Directorates',
                                    'departments' => 'Departments'
                                ], 'headquarters', array('class' => 'form-control select', 'id' => 'select_headquater')); ?>

                                <?php $__errorArgs = ['headquaters'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div id="directorateTog" style="display: none;" class="form-group col-md-6">
                                <?php echo e(Form::label('directorate', __('Directorate'),['class'=>'form-label'])); ?>

                                <?php echo Form::select('directorate',$directorates, null, ['class' => 'form-control select','id'=>'sel_directorate']); ?>

                                
                                <?php $__errorArgs = ['directorate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div id="departmentTog" style="display: none;" class="form-group col-md-6">
                                <?php echo e(Form::label('department', __('Department'),['class'=>'form-label'])); ?>

                                <?php echo Form::select('department', $departments, old('department'),array('class' => 'form-control select','id' =>'sel_department')); ?>

                                <?php $__errorArgs = ['department'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div id="depUnitTog" style="display: none;" class="form-group col-md-6">
                                <?php echo e(Form::label('unit', __('Unit'),['class'=>'form-label'])); ?>

                                <?php echo Form::select('unit', ['User Unit'], null,array('class' => 'form-control select','id'=>'department_units')); ?>

                                <?php $__errorArgs = ['Unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            
                            <div class="form-group col-md-6" id="subUnitToggles">
                                <?php echo e(Form::label('subunit', __('Sub-unit'),['class'=>'form-label'])); ?>

                                <?php echo Form::select('subunit', ['User Sub-unit'], null,array('class' => 'form-control select','id'=>'subunits')); ?>

                                <?php $__errorArgs = ['subunit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <?php if(\Auth::user()->type == 'super admin' || \Auth::user()->type == 'hrm'): ?>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('role', __('User Role'),['class'=>'form-label'])); ?>

                                    <?php echo Form::select('role', $roles, null,array('class' => 'form-control select','required'=>'required')); ?>

                                    <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="invalid-role" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            <?php else: ?>
                            <?php echo Form::hidden('role', 'super admin', null,array('class' => 'form-control select2','required'=>'required')); ?>

                            <?php endif; ?>

                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('designation', __('Designation'),['class'=>'form-label'])); ?>

                                <?php echo Form::select('designation', $designations, null,array('class' => 'form-control select','required'=>'required')); ?>

                                <?php $__errorArgs = ['designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>


                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('level', __('Level'),['class'=>'form-label'])); ?>

                                <?php echo Form::select('level', ['Level 07','Level 08','Level 09','Level 11','Level 12','Level 13','Level 14','Level 15'], null,array('class' => 'form-control select','required'=>'required')); ?>

                                <?php $__errorArgs = ['Level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-role" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <?php if(!$customFields->isEmpty()): ?>
                                <div class="col-md-6">
                                    <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                                        <?php echo $__env->make('customFields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
                        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
                    </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('script'); ?>
    <?php if($errors->any() || Session::has('error')): ?>
    <script>
        $(document).ready(function(){
            console.log('user');
            document.getElementById("toggleOldUser").click();
        });
    </script>
    <?php endif; ?>

    <?php if(old('headquaters') && old('location')=="headquarters"): ?>
        <script>
            $(document).ready(function(){
                $('#headquarterTog').show();
            });
        </script>
    <?php else: ?>
    <script>
        $(document).ready(function(){
            $('#select_location').on('change', function(){
                $('#headquarterTog').hide();
            });
        });
    </script>
    <?php endif; ?>

    <?php if(old('directorate') && old('location')=="headquarters"): ?>
        <script>
            $(document).ready(function(){
                $('#directorateTog').show();
            });
        </script>
    <?php else: ?>
    <script>
        $(document).ready(function(){
            $('#directorateTog','#headquarterTog').hide();
        });
    </script>
    <?php endif; ?>

    <?php if(old('unit') && old('location')=="liaison"): ?>
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
    <?php else: ?>
    <script>
        $(document).ready(function(){
            $('#depUnitTog').hide();
        });
    </script>
    <?php endif; ?>

    <?php if(old('department')): ?>
        <script>
            $(document).ready(function(){
                $('#departmentTog').show();
            });
        </script>
    <?php else: ?>
    <script>
        $(document).ready(function(){
            $('#select_location').on('change', function(){
                $('#departmentTog').hide();
            });
        });
    </script>
    <?php endif; ?>

    <?php if(old('liason')): ?>
        <script>
            $(document).ready(function(){
                $('#liasonTog').show();
            });
        </script>
    <?php else: ?>
    <script>
        $(document).ready(function(){
            $('#liasonTog').hide();
        });
    </script>
    <?php endif; ?>



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
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/user/create.blade.php ENDPATH**/ ?>