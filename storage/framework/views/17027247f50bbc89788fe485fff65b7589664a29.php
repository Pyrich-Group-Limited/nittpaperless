<div id="managePermissions">
    <div class="modal" id="managePermission" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave"><?php echo e($selStaff->name); ?> <?php echo e($selModule); ?> Permissions
                        </h5>
                        <label class="form-check-label mt-1">
                            <input type="checkbox" wire:model="selectAll"  class="form-check-input" />
                            Select All
                        </label>

                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <?php if(count($permissions)>0): ?>
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class=" col-md-4" wire:ignore.self>
                                        <div class="form-check form-check-inline mt-2" wire:ignore.self>
                                            <label class="form-check-label" wire:ignore.self>
                                                <input type="checkbox" key="<?php echo e($permission); ?>" id="<?php echo e($permission); ?>" class="form-check-input"
                                                    <?php if($permission): ?> checked <?php endif; ?>
                                                    wire:model.defer="sel_permissions"
                                                    value="<?php echo e($permission); ?>"><?php echo e($permission); ?>

                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div align="center"><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.g-loader','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('g-loader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <input type="button" value="<?php echo e(__('OK')); ?>" class="btn  btn-light"
                            data-bs-dismiss="modal">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('script'); ?>
        <?php if($errors->any() || Session::has('error')): ?>
            <script>
                $(document).ready(function() {
                    document.getElementById("toggleOldUser").click();
                });
            </script>
        <?php endif; ?>
    <?php $__env->stopPush(); ?>

</div>
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/users/modals/manage-user-permission.blade.php ENDPATH**/ ?>