<div>
    <?php
   $profile=\App\Models\Utility::get_file('uploads/avatar');
   ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Project Applicants')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Project Applicants')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        


        
                <a href="#" class="btn btn-sm btn-primary action-item" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-filter"></i>
                </a>
                <div class="dropdown-menu  dropdown-steady" id="project_sort">
                    <a class="dropdown-item active" href="#" data-val="created_at-desc">
                        <i class="ti ti-sort-descending"></i><?php echo e(__('Newest')); ?>

                    </a>
                    <a class="dropdown-item" href="#" data-val="created_at-asc">
                        <i class="ti ti-sort-ascending"></i><?php echo e(__('Oldest')); ?>

                    </a>

                    <a class="dropdown-item" href="#" data-val="project_name-desc">
                        <i class="ti ti-sort-descending-letters"></i><?php echo e(__('From Z-A')); ?>

                    </a>
                    <a class="dropdown-item" href="#" data-val="project_name-asc">
                        <i class="ti ti-sort-ascending-letters"></i><?php echo e(__('From A-Z')); ?>

                    </a>
                </div>

            

            
                <a href="#" class="btn btn-sm btn-primary action-item" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="btn-inner--icon"><?php echo e(__('Status')); ?></span>
                </a>
                <div class="dropdown-menu  project-filter-actions dropdown-steady" id="project_status">
                    <a class="dropdown-item filter-action filter-show-all pl-4 active" href="#"><?php echo e(__('Show All')); ?></a>
                    
                </div>
            
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
                            <th><?php echo e(__('Applicant Name')); ?></th>
                            <th><?php echo e(__('Company Name')); ?></th>
                            <th><?php echo e(__('Year of Inc.')); ?></th>
                            <th><?php echo e(__('TIN')); ?></th>
                            <th><?php echo e(__('Email')); ?></th>
                            <th><?php echo e(__('Phone')); ?></th>
                            <th><?php echo e(__('Application Status')); ?></th>
                            <th class="text-end"><?php echo e(__('Action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($projectApplicants)>0): ?>
                            <?php $__currentLoopData = $projectApplicants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectApplicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0"><?php echo e($projectApplicant->contractor->name); ?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0"><?php echo e($projectApplicant->applicant->company_name); ?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0"><?php echo e($projectApplicant->applicant->year_of_incorporation); ?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0"><?php echo e($projectApplicant->applicant->company_tin); ?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0"><?php echo e($projectApplicant->applicant->email); ?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0"><?php echo e($projectApplicant->applicant->phone); ?></p>
                                        </div>
                                    </td>
                                    <td class="">
                                        <span class="badge <?php if($projectApplicant->application_status=='pending'): ?> bg-warning
                                            <?php elseif($projectApplicant->application_status=='on_review'): ?> bg-info
                                            <?php elseif($projectApplicant->application_status=='selected'): ?> bg-primary
                                            <?php elseif($projectApplicant->application_status=='rejected'): ?> bg-danger
                                            <?php endif; ?> p-2 px-3 rounded"><?php echo e($projectApplicant->application_status); ?></span>
                                    </td>
                                    
                                    <td class="text-end">
                                        <span>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" id="toggleApplicantDetails" data-bs-target="#viewApplicantModal" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('View Applicant Details')); ?>" data-title="<?php echo e(__('View Applicant Details')); ?>">
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?> 
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                                            <div class="action-btn bg-info ms-2">
                                                    <a href="#" wire:click="setProject('<?php echo e($projectApplicant->id); ?>')" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#uploadBOQModal" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Recommend to DG')); ?>" data-title="<?php echo e(__('Recommend contractor for DG Approval')); ?>">
                                                        <i class="ti ti-share text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <th scope="col" colspan="9"><h6 class="text-center"><?php echo e(__('No Appplicants yet.')); ?></h6></th>
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
<?php echo $__env->make('livewire.projects.modals.project-applicant-details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</div>
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/projects/project-applicants-component.blade.php ENDPATH**/ ?>