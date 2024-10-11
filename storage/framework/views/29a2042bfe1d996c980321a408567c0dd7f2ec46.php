<div class="modal" id="uploadUsers" tabindex="-1" role="dialog" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form wire:submit.prevent="uploadUser" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                            <h5 class="modal-title" id="applyLeave">Upload Users </h5>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <?php if($failed_upload): ?>
                            <div class="alert alert-danger alert-dismissible alert-alt fade show mt-3">
                                <strong>Attention! </strong> Some records were not uploaded. kindly ensure you <br> entered all records correctly.
                                <input type="button"  wire:click.prevent="downloadFailedUpload" value="<?php echo e(__('Donlaod Failed Upload')); ?>" class="btn  btn-danger">
                            </div>
                        <?php endif; ?>
                            <div class="col-md-8 mt-1">
                                <div class="form-group">
                                    <input type="file" wire:model="uploadFile" class="form-control">
                                    <div style="color: red" align="center" wire:loading wire:target="uploadFile" >Loading...</div>

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
                            <div class="col-md-4 ">
                                <a href="<?php echo e(asset('uploads/staf-sample.xlsx')); ?>"><input type="button" value="<?php echo e(__('Download Template')); ?>" class="btn  btn-primary"></a>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <input type="button" id="closeUploadUser" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
                        <input type="submit" value="<?php echo e(__('Onboard Users')); ?>" class="btn  btn-primary">
                    </div>
                </form>
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

    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeUploadUser").click();
        })
    </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\nittdig\resources\views/user/upload-users.blade.php ENDPATH**/ ?>