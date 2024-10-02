<?php echo e(Form::open(array('route'=>'leave.apply','method'=>'post'))); ?>

<?php echo csrf_field(); ?>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="form-label">Employee Name</label>
                <input type="text" class="form-control" value="<?php echo e(old('name')); ?>" placeholder="Employee Name" required>
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
                <label for="" class="form-label">Employee Department</label>
                <select name="department" value="<?php echo e(old('department')); ?>" id="" class="form-control">
                    <option value="">--Select Department--</option>
                    <option value="">Finance</option>
                    <option value="">Administrative</option>
                </select>
                <?php $__errorArgs = ['department'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="invalid-department" role="alert">
                    <strong class="text-danger"><?php echo e($message); ?></strong>
                </small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <?php if(\Auth::user()->type == 'client'): ?>
            <div class="form-group col-md-6">
                <label for="" class="form-label">Type of Leave</label>
                <select name="type_of_leave" value="<?php echo e(old('type_of_leave')); ?>" id="" class="form-control">
                    <option value="">--Select--</option>
                    <option value="">Casual</option>
                    <option value="">Annual</option>
                    <option value="">Maternal</option>
                </select>
                <?php $__errorArgs = ['type_of_leave'];
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
        <?php endif; ?>
        <div class="col-md-6">
            <div class="form-group">
                <label for=""  class="form-label">Leave Date</label>
                <input type="leave_date" value="<?php echo e(old('leave_date')); ?>" class="form-control" placeholder="Date" required>
                <?php $__errorArgs = ['leave_date'];
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
            <label for="" class="form-label">Number of Days</label>
            <input type="number" name="duration" value="<?php echo e(old('duration')); ?>" class="form-control" placeholder="Days" required>
            <?php $__errorArgs = ['duration'];
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
            <label for="" class="form-label">Resumption Date</label>
            <input type="date" value="<?php echo e(old('resurmption_date')); ?>" class="form-control" required>
            <?php $__errorArgs = ['resumption_date'];
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
    </div>

</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Apply')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/hrm/modals/apply-leave.blade.php ENDPATH**/ ?>