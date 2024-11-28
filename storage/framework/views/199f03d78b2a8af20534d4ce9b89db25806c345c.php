<div>
    <?php $__env->startSection('page-title'); ?>
        <?php echo e($selStaff->name); ?>

    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('script-page'); ?>
    <?php $__env->stopPush(); ?>
    <?php $__env->startSection('breadcrumb'); ?>
        <li class="breadcrumb-item"><a href="#"><?php echo e(__($selStaff->name)); ?></a></li>
        <li class="breadcrumb-item"><?php echo e(__('Permission')); ?></li>
        <hr>
    <?php $__env->stopSection(); ?>
    <div class="row" wire:ignore>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if($loop->first == 1): ?> active <?php endif; ?>"
                            id="pills-<?php echo e($loop->index); ?>-tab" data-bs-toggle="pill" href="#perm_<?php echo e($loop->index); ?>"
                            role="tab" aria-controls="pills-<?php echo e($loop->index); ?>"
                            aria-selected="false"><?php echo e($category->category); ?></a>
                    </li> &nbsp;
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane fade <?php if($loop->first == 1): ?> show active <?php endif; ?>" id="perm_<?php echo e($loop->index); ?>" role="tabpanel" aria-labelledby="pills-<?php echo e($loop->index); ?>-tab">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <div class="col-md-12">
                                    <div class="row">
                                        <?php $__currentLoopData = Spatie\Permission\Models\Permission::where('category', $category->category)->groupBy('module')->orderBy('module', 'ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <div class="col-md-3 mt-1">
                                            <li class="nav-item">
                                                <a class="nav-link active" wire:click="setModule('<?php echo e($module->module); ?>')"
                                                    data-bs-toggle="modal" data-bs-target="#managePermission" href="#staff"
                                                    role="tab" aria-controls="pills-home"
                                                    aria-selected="true"><?php echo e($module->module); ?></a>
                                        </li>
                                        </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                </div>

                            </ul>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    </div>
    <?php echo $__env->make('livewire.users.modals.manage-user-permission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.toast-notification','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('toast-notification'); ?>
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
<?php endif; ?>

</div>

<div class="modal-body">

</div>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/livewire/users/user-permission.blade.php ENDPATH**/ ?>