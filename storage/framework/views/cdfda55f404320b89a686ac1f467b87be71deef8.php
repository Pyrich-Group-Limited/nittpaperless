<div class="modal" id="applyLeave" tabindex="-1" role="dialog" wire:ignore>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyLeave">Leave Application
                </h5>
            </div>
            <div class="modal-body">
                <?php echo e(Form::open(array('route'=>'leave.apply','method'=>'post'))); ?>

                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Type of Leave</label>
                                <select name="type_of_leave" id="" class="form-control">
                                    <option value="" selected>--Select Type of Leave--</option>
                                    <?php $__currentLoopData = $leaveTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($leave->id); ?>" <?php echo e(old('type_of_leave') == $leave->id ? 'selected' : ''); ?>><?php echo e($leave->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['type_of_leave'];
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""  class="form-label">Start Date</label>
                                <input type="date" name="start_date" value="<?php echo e(old('start_date')); ?>" class="form-control" placeholder="Date" required>
                                <?php $__errorArgs = ['start_date'];
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""  class="form-label">End Date</label>
                                <input type="date" name="end_date" value="<?php echo e(old('end_date')); ?>" class="form-control" placeholder="Date" required>
                                <?php $__errorArgs = ['end_date'];
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

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for=""  class="form-label">Reason for Leave</label>
                                <textarea name="reason" class="form-control" role="5"><?php echo e(old('reason')); ?></textarea>
                                <?php $__errorArgs = ['reason'];
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

                    </div>

                </div>

                <div class="modal-footer">
                    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
                    <input type="submit" value="<?php echo e(__('Apply')); ?>" class="btn  btn-primary">
                </div>

                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/nittpaperless/resources/views/hrm/modals/apply-leave.blade.php ENDPATH**/ ?>