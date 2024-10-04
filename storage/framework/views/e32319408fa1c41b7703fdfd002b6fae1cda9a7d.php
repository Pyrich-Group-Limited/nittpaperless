<div class="">
    <form action="<?php echo e(route('folders.rename',$folder->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card text-center card-2">
                        <div class="card-body full-card">
                            <div class="card-body full-card">
                                <div class="img-fluid rounded-circle card-avatar">
                                    <span class="nk-file-icon-type">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                                            <g>
                                                <rect x="32" y="16" width="28" height="15" rx="2.5" ry="2.5" style="fill:#f29611" />
                                                <path d="M59.7778,61H12.2222A6.4215,6.4215,0,0,1,6,54.3962V17.6038A6.4215,6.4215,0,0,1,12.2222,11H30.6977a4.6714,4.6714,0,0,1,4.1128,2.5644L38,24H59.7778A5.91,5.91,0,0,1,66,30V54.3962A6.4215,6.4215,0,0,1,59.7778,61Z" style="fill:#ffb32c" />
                                                <path d="M8.015,59c2.169,2.3827,4.6976,2.0161,6.195,2H58.7806a6.2768,6.2768,0,0,0,5.2061-2Z" style="fill:#f2a222" />
                                            </g>
                                        </svg>
                                    </span>
                                    <h6 class=" mt-4 text-primary"><?php echo e($folder->folder_name); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">File Name</label>
                    <input type="text" value="<?php echo e($folder->folder_name); ?>" name="name" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
            <input type="submit" value="<?php echo e(__('Rename Folder')); ?>" class="btn  btn-primary">
        </div>
    </form>
</div>




<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/filemanagement/modals/rename-folder.blade.php ENDPATH**/ ?>