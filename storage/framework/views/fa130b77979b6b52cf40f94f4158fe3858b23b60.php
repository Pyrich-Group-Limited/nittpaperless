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
        <?php if($view == 'grid'): ?>
            <a href="<?php echo e(route('projects.list','list')); ?>"  data-bs-toggle="tooltip" title="<?php echo e(__('List View')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-list"></i>
            </a>

        <?php else: ?>
            <a href="<?php echo e(route('created-projects')); ?>"  data-bs-toggle="tooltip" title="<?php echo e(__('Grid View')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-layout-grid"></i>
            </a>
        <?php endif; ?>


        
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
                    <?php $__currentLoopData = \App\Models\Project::$project_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="dropdown-item filter-action pl-4" href="#" data-val="<?php echo e($key); ?>"><?php echo e(__($val)); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            


        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create project')): ?>
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newProject" id="toggleOldProject"  data-bs-toggle="tooltip" title="<?php echo e(__('Create New Project')); ?>"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if(isset($projects) && !empty($projects) && count($projects) > 0): ?>
<div class="col-12">
    <div class="row">

        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-xxl-3">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="d-flex align-items-center">
                            <img <?php echo e($project->img_image); ?> class="img-fluid wid-30 me-2" alt="">
                            <h5 class="mb-0"><a class="text-dark" href="<?php echo e(route('projects.show',$project)); ?>"><?php echo e($project->project_name); ?></a></h5>
                        </div>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create project')): ?>
                                        <a class="dropdown-item" data-ajax-popup="true"
                                           data-size="md" data-title="<?php echo e(__('Duplicate Project')); ?>"
                                           data-url="<?php echo e(route('project.copy', [$project->id])); ?>">
                                            <i class="ti ti-copy"></i> <span><?php echo e(__('Duplicate')); ?></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                                        <a href="#!" data-size="lg" data-url="<?php echo e(route('projects.edit', $project->id)); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit Project')); ?>">
                                            <i class="ti ti-pencil"></i>
                                            <span><?php echo e(__('Edit')); ?></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete project')): ?>
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['projects.destroy',$project->id]]); ?>

                                        <a href="#!" class="dropdown-item bs-pass-para">
                                            <i class="ti ti-archive"></i>
                                            <span> <?php echo e(__('Delete')); ?></span>
                                        </a>

                                        <?php echo Form::close(); ?>

                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                                        <a href="#!" data-size="lg" data-url="<?php echo e(route('invite.project.member.view', $project->id)); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Invite User')); ?>">
                                            <i class="ti ti-send"></i>
                                            <span><?php echo e(__('Invite User')); ?></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-2 justify-content-between">
                            <div class="col-auto"><span class="badge rounded-pill bg-<?php echo e(\App\Models\Project::$status_color[$project->status]); ?>"><?php echo e(__(\App\Models\Project::$project_status[$project->status])); ?></span>
                            </div>

                        </div>
                        <p class="text-muted text-sm mt-3"><?php echo e($project->description); ?></p>
                        <small><?php echo e(__('MEMBERS')); ?></small>
                        <div class="user-group">
                            <?php if(isset($project->users) && !empty($project->users) && count($project->users) > 0): ?>
                                <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($key < 3): ?>
                                        <a href="#" class="avatar rounded-circle avatar-sm">
                                            <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?>  alt="image" data-bs-toggle="tooltip" title="<?php echo e($user->name); ?>">
                                        </a>
                                    <?php else: ?>
                                        <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="card mb-0 mt-3">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="mb-0 <?php echo e((strtotime($project->start_date) < time()) ? 'text-danger' : ''); ?>"><?php echo e(Utility::getDateFormated($project->start_date)); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Start Date')); ?></p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h6 class="mb-0"><?php echo e(Utility::getDateFormated($project->end_date)); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Due Date')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php else: ?>
<div class="col-xl-12 col-lg-12 col-sm-12">
    <div class="card">
        <div class="card-body">
            <h6 class="text-center mb-0"><?php echo e(__('No Projects Found.')); ?></h6>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

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
<?php echo $__env->make('livewire.projects.modals.create-project', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>
<?php /**PATH /var/www/html/nittpaperless/resources/views/livewire/projects/projects-component.blade.php ENDPATH**/ ?>