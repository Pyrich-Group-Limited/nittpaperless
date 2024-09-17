<?php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage User')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Client')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if(\Auth::user()->type == 'super admin' || \Auth::user()->type == 'HR'): ?>
            <a href="<?php echo e(route('user.userlog')); ?>" class="btn btn-primary btn-sm <?php echo e(Request::segment(1) == 'user'); ?>"
               data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('User Logs History')); ?>"><i class="ti ti-user-check"></i>
            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create user')): ?>
        
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newUser"  data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 mb-4">
                        <div class="card text-center card-2">
                            <div class="card-header border-0 pb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        <div class=" badge bg-primary p-2 px-3 rounded">
                                            <?php echo e(ucfirst($user->type)); ?>

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
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit user')): ?>
                                                <a href="#!" data-size="lg" data-url="<?php echo e(route('users.edit',$user->id)); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                                    <i class="ti ti-pencil"></i>
                                                    <span><?php echo e(__('Edit')); ?></span>
                                                </a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete user')): ?>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user['id']],'id'=>'delete-form-'.$user['id']]); ?>

                                                <a href="#!"  class="dropdown-item bs-pass-para">
                                                    <i class="ti ti-archive"></i>
                                                    <span> <?php if($user->delete_status!=0): ?><?php echo e(__('Delete')); ?> <?php else: ?> <?php echo e(__('Restore')); ?><?php endif; ?></span>
                                                </a>

                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                            <a href="#!" data-url="<?php echo e(route('users.reset',\Crypt::encrypt($user->id))); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Reset Password')); ?>">
                                                <i class="ti ti-adjustments"></i>
                                                <span>  <?php echo e(__('Reset Password')); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body full-card">
                                <div class="img-fluid rounded-circle card-avatar">
                                    <img src="<?php echo e((!empty($user->avatar))? asset(Storage::url("uploads/avatar/".$user->avatar)): asset('uploads/user.png')); ?>"  class="img-user wid-80 rounded-circle">
                                </div>
                                <h4 class=" mt-2 text-primary"><?php echo e($user->name); ?></h4>
                                <small class="text-primary"><?php echo e($user->email); ?></small>
                                <p></p>


                                <div class="col text-center d-block h6 mb-0" data-bs-toggle="tooltip" title="<?php echo e(__('Last Login')); ?>">
                                    <?php echo e((!empty($user->last_login_at)) ? $user->last_login_at : ''); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div class="modal" id="newUser" tabindex="-1" role="dialog" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <?php echo e(Form::open(array('url'=>'users','method'=>'post'))); ?>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter User Name'),'required'=>'required'))); ?>

                                        <?php $__errorArgs = ['name'];
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('password',__('Password'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter User Password'),'required'=>'required','minlength'=>"6"))); ?>

                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="invalid-password" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </small>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
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

                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('department', __('Department'),['class'=>'form-label'])); ?>

                                    <?php echo Form::select('department', $departments, null,array('class' => 'form-control select','required'=>'required','id' =>'sel_department')); ?>

                                    <?php $__errorArgs = ['Department'];
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
                                    <?php echo e(Form::label('unit', __('Unit'),['class'=>'form-label'])); ?>

                                    <?php echo Form::select('unit', ['User Unit'], null,array('class' => 'form-control select','required'=>'required','id'=>'department_units')); ?>

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

                                <div class="form-group col-md-12" id="subUnitToggles">
                                    <?php echo e(Form::label('subunit', __('Sub-unit'),['class'=>'form-label'])); ?>

                                    <?php echo Form::select('subunit', ['User Sub-unit'], null,array('class' => 'form-control select','required'=>'required','id'=>'subunits')); ?>

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
    <script>
        var x = document.getElementById("subUnitToggles");
         x.style.display = "none"
         $('#sel_department').append('<option value="0" selected>Select Department...</options>');

        $(document).ready(function(){

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
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-server\htdocs\e-NITT\resources\views/user/index.blade.php ENDPATH**/ ?>