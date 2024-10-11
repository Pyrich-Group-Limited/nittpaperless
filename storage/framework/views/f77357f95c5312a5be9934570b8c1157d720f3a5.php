<div>
    <?php
        $profile = \App\Models\Utility::get_file('uploads/avatar');
    ?>
    <?php $__env->startSection('page-title'); ?>
        <?php echo e(__('ERGP')); ?>

    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('script-page'); ?>
    <?php $__env->stopPush(); ?>
    <?php $__env->startSection('breadcrumb'); ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
        <li class="breadcrumb-item"><?php echo e(__('ERGP')); ?></li>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('action-btn'); ?>
        <div class="float-end">

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create project')): ?>
                

                <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#AddErgpModal" id="toggleOldProject"
                    data-bs-toggle="tooltip" title="<?php echo e(__('Add ERGP')); ?>" class="btn btn-sm btn-primary">
                    <i class="ti ti-plus text-white"> </i>Add
                </a>
            <?php endif; ?>
        </div>
    <?php $__env->stopSection(); ?>

    <div class="col-xl-12">

        <div class="card mt-4">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><?php echo e(__('SN')); ?></th>
                                <th><?php echo e(__('Project Category')); ?></th>
                                <th><?php echo e(__('ERGP CODE')); ?></th>
                                <th><?php echo e(__('ERGP TITLE')); ?></th>
                                <th><?php echo e(__('Total Value')); ?></th>
                                <th><?php echo e(__('Amount Paid')); ?></th>
                                <th><?php echo e(__('Balance')); ?></th>
                                <th><?php echo e(__('Deficit')); ?></th>
                                <th><?php echo e(__('Year')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(isset($ergps) && !empty($ergps) && count($ergps) > 0): ?>
                                <?php $__currentLoopData = $ergps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ergp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($ergp->projectCategory->category_name); ?></td>
                                        <td><?php echo e($ergp->code); ?></td>
                                        <td><?php echo e($ergp->title); ?></td>
                                        <td>₦ <?php echo e(number_format($ergp->project_sum, 2)); ?></td>
                                        <td>₦ <?php echo e(number_format($ergp->amount_paid, 2)); ?></td>
                                        <td>₦ <?php echo e(number_format($ergp->balance, 2)); ?></td>
                                        <td>₦ <?php echo e(number_format($ergp->deficit, 2)); ?></td>
                                        <td><?php echo e($ergp->year); ?></td>
                                        <td>
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="<?php echo e(route('project.details', $ergp->id)); ?>"
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                    data-url="" data-ajax-popup="false" data-size="lg"
                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Show Details')); ?>"
                                                    data-title="<?php echo e(__('Show Details')); ?>">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" data-size="lg" data-bs-toggle="modal"
                                                    data-bs-target="#editProject" id="toggleOldProject"
                                                    wire:click="selProject(<?php echo e($ergp->id); ?>)"
                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Modify Project')); ?>"
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-danger ms-2">
                                                
                                                <a href="#"
                                                    class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i
                                                        class="ti ti-trash text-white"></i></a>
                                                <?php echo Form::close(); ?>

                                            </div>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <th scope="col" colspan="9">
                                        <h6 class="text-center"><?php echo e(__('No Record Found.')); ?></h6>
                                    </th>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('livewire.physical-planning.projects.modals.add-ergp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<div>
<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/livewire/physical-planning/ergp-component.blade.php ENDPATH**/ ?>