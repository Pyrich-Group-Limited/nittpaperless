<div>
    <?php
   $profile=\App\Models\Utility::get_file('uploads/avatar');
   ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Awarded Contracts')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Contracts')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
            
                <a href="#" class="btn btn-sm btn-primary action-item" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="btn-inner--icon"><?php echo e(__('Status')); ?></span>
                </a>
                <div class="dropdown-menu  project-filter-actions dropdown-steady" id="project_status">
                    <a class="dropdown-item filter-action filter-show-all pl-4 active" href="#"><?php echo e(__('Show All')); ?></a>
                </div>
            


        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create project')): ?>
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newProject" id="toggleOldProject"  data-bs-toggle="tooltip" title="<?php echo e(__('Create New Project')); ?>"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>


    <div class="col-xl-12 mt-5">

        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><?php echo e(__('#')); ?></th>
                            <th><?php echo e(__('Subject')); ?></th>
                            <th><?php echo e(__('Contractor')); ?></th>
                            <th><?php echo e(__('Project')); ?></th>
                            <th><?php echo e(__('Contract Type')); ?></th>
                            <th><?php echo e(__('Contract Value')); ?></th>
                            <th><?php echo e(__('Start Date')); ?></th>
                            <th><?php echo e(__('End Date')); ?></th>
                            <th class="text-end"><?php echo e(__('Action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        
                            
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            
                                        </div>
                                    </td>
                                    <td>

                                        <div class="d-flex align-items-center">
                                            
                                        </div>
                                    </td>
                                    <td class="">
                                        
                                    </td>
                                    
                                    <td class="text-end">
                                        <h5 class="mb-0 text-success">
                                            
                                        </h5>
                                        <div class="progress mb-0">
                                            
                                        </div>
                                    </td>
                                    
                                    <td class="text-end">
                                        
                                    </td>
                                </tr>
                            
                        
                            <tr>
                                <th scope="col" colspan="7"><h6 class="text-center"><?php echo e(__('No contracts Found.')); ?></h6></th>
                            </tr>
                        
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



</div>
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/d-g/contract-component.blade.php ENDPATH**/ ?>