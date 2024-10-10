
<div class="">
    <form action="<?php echo e(route('memos.share', $memo->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="">Memo Title</label>
                    <input type="text" disabled value="<?php echo e($memo->title); ?>" name="file_id" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="">Share with</label>
                    <select name="shared_with" id="shared_with" class="form-control">
                        <option value="#">---Select---</option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea name="comment" id="comment" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="<?php echo e(__('Share')); ?>" class="btn  btn-primary">
        </div>
    </form>
</div>



<?php /**PATH /var/www/html/nittpaperless/resources/views/memos/shareModal.blade.php ENDPATH**/ ?>