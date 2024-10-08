<div class="">
    <form action="<?php echo e(route('folders.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="">Folder Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="<?php echo e(__('Create Folder')); ?>" class="btn  btn-primary">
        </div>
    </form>
</div>



<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/filemanagement/modals/create-folder.blade.php ENDPATH**/ ?>