<div class="modal" id="uploadUsers" tabindex="-1" role="dialog" wire:ignore>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <?php echo e(Form::open(array('url'=>'upload-users','enctype'=>'multipart/form-data','method'=>'post'))); ?>

                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="applyLeave">Upload Users
                    </h5>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mt-1">
                                <div class="form-group">
                                    <?php echo e(Form::file('uploadFile',null,array('class'=>'form-control','placeholder'=>__('Select File'),'required'=>'required'))); ?>

                                    <?php $__errorArgs = ['uploadFile'];
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
                            <div class="col-md-6 ">
                                <input type="submit" value="<?php echo e(__('Download Template')); ?>" class="btn  btn-primary">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
                        <input type="submit" value="<?php echo e(__('Onboard Users')); ?>" class="btn  btn-primary">
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
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/user/upload-users.blade.php ENDPATH**/ ?>