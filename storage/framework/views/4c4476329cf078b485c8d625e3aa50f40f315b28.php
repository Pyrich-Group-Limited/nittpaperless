
<div class="">
    <form action="<?php echo e(route('files.share',$file->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="">File Name</label>
                    <input type="text" value="<?php echo e($file->file_name); ?>" name="file_id" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="">Share with</label>
                    <select name="user_id" id="" class="form-control" >
                        <option value="#">Select User</option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="<?php echo e(__('Share')); ?>" class="btn  btn-primary">
        </div>
    </form>
</div>



<?php /**PATH /var/www/html/nittpaperless/resources/views/filemanagement/modals/share-modal.blade.php ENDPATH**/ ?>