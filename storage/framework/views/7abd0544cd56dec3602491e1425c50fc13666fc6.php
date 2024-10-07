<div class="">
    <form action="<?php echo e(route('memos.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="">Memo Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Memo Description</label>
                    <textarea name="description" id="" class="form-control" cols="30" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Attach File</label>
                    <input type="file" name="file" aria-multiselectable="" class="form-control" required>
                </div>
                

            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="<?php echo e(__('Submit')); ?>" class="btn  btn-primary">
        </div>
    </form>
</div>




<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/memos/create.blade.php ENDPATH**/ ?>