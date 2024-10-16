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
                     
                 </div>
             

     </div>
 <?php $__env->stopSection(); ?>


<div class="col-xl-12">

    <div class="card mt-4">
        <div class="card-body table-border-style">
            <div class="table-responsive">

                <table class="table">
                    <thead>
                    <tr>
                        <th><?php echo e(__('Project')); ?></th>
                        <th><?php echo e(__('Status')); ?></th>
                        <th><?php echo e(__('Users')); ?></th>
                        <th><?php echo e(__('Completion')); ?></th>
                        <th class="text-end"><?php echo e(__('Action')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($projects) && !empty($projects) && count($projects) > 0): ?>
                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo e(asset('uploads/project.png')); ?>" class="wid-40 rounded me-3">
                                        <p class="mb-0"><a href="<?php echo e(route('pp.projects.show',$project)); ?>" class="name mb-0 h6 text-sm"><?php echo e($project->project_name); ?></a></p>
                                    </div>
                                </td>

                                <td class="">
                                    <span class="badge bg-info p-2 px-3 rounded"><?php echo e($project->status); ?></span><?php if($project->project_boq==null): ?> <span class="badge bg-danger p-2 px-3 rounded">Pending BOQ</span> <?php endif; ?>
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
                                <td class="text-end">
                                    <span>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="<?php echo e(route('pp.projects.show',$project)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('View Project')); ?>" data-title="<?php echo e(__('View Project')); ?>">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                    <?php if($project->project_boq==null): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                                            <div class="action-btn bg-info ms-2">
                                                    <a href="#" wire:click="setProject('<?php echo e($project->id); ?>')" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#uploadBOQModal" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Upload Bill of Quantity')); ?>" data-title="<?php echo e(__('Upload Bill of Quantity')); ?>">
                                                        <i class="ti ti-upload text-white"></i>
                                                    </a>
                                                </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                                    <div class="action-btn bg-info ms-2">
                                            <a href="#" wire:click="setProject('<?php echo e($project->id); ?>')" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#uploadBOQModal" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Edit Bill of Quantity')); ?>" data-title="<?php echo e(__('Edit Bill of Quantity')); ?>">
                                                <i class="ti ti-edit text-white"></i>
                                            </a>
                                        </div>
                                <?php endif; ?>
                                    <?php endif; ?>
                                        
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <th scope="col" colspan="7"><h6 class="text-center"><?php echo e(__('No Projects Found.')); ?></h6></th>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

 <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('physical-planning.projects.uploadboq')->html();
} elseif ($_instance->childHasBeenRendered('l3521000371-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l3521000371-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3521000371-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3521000371-0');
} else {
    $response = \Livewire\Livewire::mount('physical-planning.projects.uploadboq');
    $html = $response->html();
    $_instance->logRenderedChild('l3521000371-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

<div>
<?php /**PATH C:\xampp\htdocs\ENIT\nittpaperless\resources\views/livewire/physical-planning/projects/physical-planning-projects-component.blade.php ENDPATH**/ ?>