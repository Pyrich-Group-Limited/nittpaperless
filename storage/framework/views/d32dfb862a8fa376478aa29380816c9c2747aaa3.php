<div>
    <?php
        $profile = \App\Models\Utility::get_file('uploads/avatar');
    ?>
    <?php $__env->startSection('page-title'); ?>
        <?php echo e(__('ERGP Details for Projects')); ?>

    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('script-page'); ?>
    <?php $__env->stopPush(); ?>
    <?php $__env->startSection('breadcrumb'); ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
        <li class="breadcrumb-item"><?php echo e(__('ERGP Projects')); ?></li>
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

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-danger">
                                    <i class="ti ti-report-money"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('ERGP VALUE')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0">
                                <?php
                                    foreach ($ergpDetails as $ergpDetail){

                                    }
                                ?>
                                <?php echo e(\Auth::user()->priceFormat($ergpDetail->category->ergp->project_sum)); ?>

                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-cash"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('PROJECTS VALUE')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0">
                                <?php echo e(\Auth::user()->priceFormat($ergpDetails->sum('budget'))); ?>

                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                <th><?php echo e(__('project Title')); ?></th>
                                <th><?php echo e(__('Project Value')); ?></th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(isset($ergpDetails) && !empty($ergpDetails) && count($ergpDetails) > 0): ?>
                                <?php $__currentLoopData = $ergpDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ergpDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($ergpDetail->category->category_name); ?></td>
                                        <td><?php echo e($ergpDetail->category->ergp->code); ?></td>
                                        <td><?php echo e($ergpDetail->project_name); ?></td>
                                        <td>₦ <?php echo e(number_format($ergpDetail->budget, 2)); ?></td>
                                        
                                        
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
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/d-g/view-ergp-expense-component.blade.php ENDPATH**/ ?>