<div id="updateUser">
    <div class="modal" id="editUser" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Modify User
                        </h5>
                    </div>
                    <div class="modal-body">
                    <?php if($selUser): ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('name', __('Surname'), ['class' => 'form-label'])); ?>

                                    <input type="text" wire:model.defer="surname" class="form-control"
                                        placeholder="Surname" />
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
                                    <?php echo e(Form::label('name', __('Firstname'), ['class' => 'form-label'])); ?>

                                    <input type="text" wire:model.defer="firstname" class="form-control"
                                        placeholder="Firstname" />
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
                                    <?php echo e(Form::label('email', __('Email'), ['class' => 'form-label'])); ?>

                                    <input type="email" wire:model.defer="email" class="form-control"
                                        placeholder="email" />
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
                                <label for="ulocation" class="form-label">Location</label>
                                <select wire:model="location" id="ulocation" class="form-control">
                                    <option value="" selected>-- Select Location --</option>
                                    <option value="Headquarters">Headquarters</option>
                                    <option value="Liaison-Offices">Liaison Office</option>
                                </select>
                                <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <?php if($location): ?>
                                <div class="form-group col-md-6">
                                    <label for="ulocation_type" class="form-label"><?php echo e($location); ?></label>
                                    <select wire:model="location_type" id="ulocation_type" class="form-control">
                                        <option value="" selected>-- Select Location --</option>
                                        <?php if($location == 'Headquarters'): ?>
                                            <option value="Department">Department</option>
                                            <option value="Directorate">Directorate</option>
                                        <?php else: ?>
                                            <?php $__currentLoopData = $liasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $liason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($liason->id); ?>"><?php echo e($liason->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            <?php endif; ?>


                            <?php if($location_type): ?>
                                <div class="form-group col-md-6">
                                    <label for="udepartment"
                                        class="form-label"><?php echo e($location == 'Headquarters' ? $location_type : 'Department'); ?></label>
                                    <select wire:model="department" id="udepartment" class="form-control">
                                        <option value="" selected>-- Select
                                            <?php echo e($location == 'Headquarters' ? $location_type : 'Department'); ?> --</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['department'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            <?php endif; ?>

                            <?php if($department && ($location_type == 'Department' || $location == 'Liaison-Offices') && $location_type): ?>
                                <div class="form-group col-md-6">
                                    <label for="uunit" class="form-label">Unit</label>
                                    <select wire:model="unit" id="uunit" class="form-control">
                                        <option value="" selected>-- Select Unit --</option>
                                        <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($unit->id); ?>"><?php echo e($unit->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            <?php endif; ?>

                            <?php if($unit && count($subunits) > 0): ?>
                                <div class="form-group col-md-6">
                                    <label for="usubunit" class="form-label">SubUnit</label>
                                    <select wire:model.defer="subunit" id="usubunit" class="form-control">
                                        <option value="" selected>-- Select Sub Unit --</option>
                                        <?php $__currentLoopData = $subunits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subunit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($subunit->id); ?>"><?php echo e($subunit->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['subunit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            <?php endif; ?>

                            <div class="form-group col-md-6">
                                <label for="udesignation" class="form-label">Designation</label>
                                <select wire:model.defer="designation" id="udesignation" class="form-control">
                                    <option value="" selected>-- Select Designation --</option>
                                    <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($designation->id); ?>" ><?php echo e($designation->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-designation" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="ulevel" class="form-label">Level</label>
                                <select wire:model.defer="level" id="ulevel" class="form-control">
                                    <option value="" selected>-- Select Level --</option>
                                    <option value="Level 07">Level 07</option>
                                    <option value="Level 08">Level 08</option>
                                    <option value="Level 09">Level 09</option>
                                    <option value="Level 11">Level 11</option>
                                    <option value="Level 12">Level 12</option>
                                    <option value="Level 13">Level 13</option>
                                    <option value="Level 14">Level 14</option>
                                    <option value="Level 15">Level 15</option>
                                </select>
                                <?php $__errorArgs = ['level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="uuser_role" class="form-label">Role</label>
                                <select wire:model="user_role" id=u"user_role" class="form-control">
                                    <option  selected>-- Select User Role --</option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role); ?>" ><?php echo e(ucwords($role)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['user_role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-user_role" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="button" value="<?php echo e(__('Cancel')); ?>" id="closeEditModal" class="btn  btn-light" data-bs-dismiss="modal">
                            <input type="button" wire:click="updateUser"  value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
                        </div>
                    <?php else: ?>
                    <lable align="center">Loading...</lable>
                    <?php endif; ?>

                    </div>


                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('script'); ?>
        <?php if($errors->any() || Session::has('error')): ?>
            <script>
                $(document).ready(function() {
                    document.getElementById("toggleOldUser").click();
                });
            </script>
        <?php endif; ?>

        <script>
            window.addEventListener('success', event => {
                document.getElementById("closeEditModal").click();
            })
        </script>
    <?php $__env->stopPush(); ?>

</div>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/livewire/users/modals/edit-user-modal.blade.php ENDPATH**/ ?>