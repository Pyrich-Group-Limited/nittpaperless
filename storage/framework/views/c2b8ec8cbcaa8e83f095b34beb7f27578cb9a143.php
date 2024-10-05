<div class="">
    <form action="<?php echo e(route('files.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="">File Name</label>
                    <input type="text" name="filename" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">File Content</label>
                    <input type="file" name="file" aria-multiselectable="" class="form-control" required>
                </div>
                

                <div class="form-group">
                    <label for="">File Folder</label>
                    <select name="folder_id" id="" class="form-control" >
                        <option value="#">Select folder</option>
                        <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($folder->id); ?>"><?php echo e($folder->folder_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="<?php echo e(__('Upload File')); ?>" class="btn  btn-primary">
        </div>
    </form>
</div>




<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/filemanagement/modals/create-file.blade.php ENDPATH**/ ?>