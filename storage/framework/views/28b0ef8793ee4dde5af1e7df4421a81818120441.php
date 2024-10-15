<div id="createUser">
    <div class="modal" id="shareProjectDetails" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Share Project Details</h5>
                    </div>
                    <div class="modal-body">
                        <form action="#" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="">Project Applicant</label>
                                        <h2><?php echo e($projectApplicant->applicant->company_name); ?></h2>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="">Share with: (<span class="text-xs text-muted"><?php echo e(__('You can select one or more users to share file with')); ?></span>) </label>
                                        <select name="user_id[]" id="choices-multiple1" class="form-control select2" multiple>
                                            <option value="#">Select one or more Users</option>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?> &nbsp; (<?php echo e($user->type); ?>)</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                    
                                </div>
                            </div>
                    
                            <div class="modal-footer">
                                <input type="button" id="closeModal" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
                                <input type="submit" value="<?php echo e(__('Share')); ?>" class="btn  btn-primary">
                            </div>
                        </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeModal").click();
    })
</script>



<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/d-g/modals/share-project.blade.php ENDPATH**/ ?>