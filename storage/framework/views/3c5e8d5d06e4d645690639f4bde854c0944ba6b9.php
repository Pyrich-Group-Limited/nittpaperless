<div>
    <?php
   $profile=\App\Models\Utility::get_file('uploads/avatar');
   ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Projects')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Projects')); ?></li>
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
                            <th><?php echo e(__('Project')); ?></th>
                            <th><?php echo e(__('Project No.')); ?></th>
                            <th><?php echo e(__('Project Status')); ?></th>
                            <th><?php echo e(__('Users')); ?></th>
                            <th><?php echo e(__('Completion')); ?></th>
                            <th><?php echo e(__('Approval Status')); ?></th>
                            <th class="text-end"><?php echo e(__('Action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($projects) && !empty($projects) && count($projects) > 0): ?>
                            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0"><a href="<?php echo e(route('project.details',$project)); ?>" class="name mb-0 h6 text-sm"><?php echo e($project->project_name); ?></a></p>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="d-flex align-items-center">
                                            <p class="mb-0"><a href="#" class="name mb-0 h6 text-sm"><?php echo e($project->projectId); ?></a></p>
                                        </div>
                                    </td>
                                    <td class="">
                                        <span class="badge <?php if($project->status=='pending'): ?> bg-secondary
                                            <?php elseif($project->status=='in_progress'): ?> bg-info
                                            <?php elseif($project->status=='on_hold'): ?> bg-warning
                                            <?php elseif($project->status=='completed'): ?> bg-primary
                                            <?php elseif($project->status=='canceled'): ?> bg-danger
                                            <?php endif; ?> p-2 px-3 rounded"><?php echo e($project->status); ?></span>
                                    </td>
                                    <td class="">
                                        <div class="avatar-group" id="project_<?php echo e($project->id); ?>">
                                            <?php if(isset($project->users) && !empty($project->users) && count($project->users) > 0): ?>
                                                <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($key < 3): ?>
                                                        <a href="#" class="avatar rounded-circle">
                                                            <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('uploads/user.png')); ?>" <?php endif; ?> title="<?php echo e($user->name); ?>" style="height:36px;width:36px;">
                                                        </a>
                                                    <?php else: ?>
                                                        <?php break; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(count($project->users) > 3): ?>
                                                    <a href="#" class="avatar rounded-circle avatar-sm">
                                                        <img avatar="+ <?php echo e(count($project->users)-3); ?>" style="height:36px;width:36px;">
                                                    </a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php echo e(__('-')); ?>

                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <h5 class="mb-0 text-success">
                                            <?php echo e($project->project_progress()['percentage']); ?>

                                        </h5>
                                        <div class="progress mb-0">
                                            <div class="progress-bar bg-<?php echo e($project->project_progress()['color']); ?>" style="width: <?php echo e($project->project_progress()['percentage']); ?>;"></div>
                                        </div>
                                    </td>
                                    <td class="">
                                        <?php if($project->advert_approval_status == false): ?>
                                            <span class="badge bg-warning p-2 px-3 rounded">Pending</span>
                                        <?php elseif($project->advert_approval_status== true): ?>
                                            <span class="badge bg-success p-2 px-3 rounded">Approved</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <span>
                                            
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="<?php echo e(route('dg.projectDetails', $project->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="" data-ajax-popup="false" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Show Details')); ?>" data-title="<?php echo e(__('Show Details')); ?>">
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                                </div>
                                            
                                        </span>

                                        <?php if($project->project_boq!=null && $project->advert_approval_status==true): ?>
                                            
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="<?php echo e(route('dg.projectApplicants',$project->id)); ?>" data-size="lg"  data-bs-toggle="tooltip" title="<?php echo e(__('View Recommended Applicant')); ?>"  class="mx-3 btn btn-sm d-inline-flex align-items-center">
                                                        <i class="ti ti-users text-white"></i>
                                                    </a>
                                                </div>
                                            
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <th scope="col" colspan="7"><h6 class="text-center"><?php echo e(__('No Projects Pending approval Found.')); ?></h6></th>
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



</div>
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/d-g/dg-projects-component.blade.php ENDPATH**/ ?>