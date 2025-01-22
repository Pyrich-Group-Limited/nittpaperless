<div>
    <div class="modal" id="managePermission" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e($selStaff->name ?? ''); ?> <?php echo e($selModule); ?> Permissions</h5>
                    <label class="form-check-label">
                        <input type="checkbox" wire:model="selectAll" class="form-check-input">
                        Select All
                    </label>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <?php if(count($permissions) > 0): ?>
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4">
                                        <div class="form-check form-check-inline mt-2">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input"
                                                       wire:model="sel_permissions"
                                                       value="<?php echo e($permission); ?>"
                                                       <?php if(in_array($permission, $sel_permissions)): ?> checked <?php endif; ?>>
                                                <?php echo e($permission); ?>

                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="text-center">No permissions available for this module.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="updatePermission">
                        Save Changes
                    </button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/livewire/users/modals/manage-user-permission.blade.php ENDPATH**/ ?>