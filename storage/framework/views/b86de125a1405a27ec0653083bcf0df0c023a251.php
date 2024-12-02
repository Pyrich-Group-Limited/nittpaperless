<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><b>Welcome </b><?php echo e(Ucfirst(Auth::user()->name). " (" .Auth::user()->department->name. ")"); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <?php if($projectsWithoutComments->isEmpty()): ?>
            
        <?php else: ?>
            <div class="row">
                <h4 class="text-danger">Projects awaiting your comment.</h4>
                <?php $__currentLoopData = $projectsWithoutComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body bg-warning">
                                <h5 class="card-title"><?php echo e($project->project_name); ?></h5>
                                
                                <a href="<?php echo e(route('project.shared', $project->id)); ?>" class="btn btn-primary btn-sm">
                                    View Project
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <a href="<?php echo e(route('requisition.raise')); ?>">
                                                <div class="d-flex align-items-center">
                                                    <div class="theme-avtar bg-primary">
                                                        <i class="ti ti-cast"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        
                                                        <h6 class="m-0"><?php echo e(__('Payment Requisition')); ?></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <a href="<?php echo e(route('storeReq.list')); ?>">
                                                <div class="d-flex align-items-center">
                                                    <div class="theme-avtar bg-primary">
                                                        <i class="ti ti-cast"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="m-0"><?php echo e(__('Store Requisition Note')); ?></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <a href="<?php echo e(route('hrm.query')); ?>">
                                                <div class="d-flex align-items-center">
                                                    <div class="theme-avtar bg-primary">
                                                        <i class="ti ti-cast"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="m-0"><?php echo e(__('Query/Complaints')); ?></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <a href="<?php echo e(route('approvals.index')); ?>">
                                                <div class="d-flex align-items-center">
                                                    <div class="theme-avtar bg-primary">
                                                        <i class="ti ti-cast"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        
                                                        <h6 class="m-0"><?php echo e(__('Leave Requests')); ?></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <a href="<?php echo e(route('memos.index')); ?>">
                                                <div class="d-flex align-items-center">
                                                    <div class="theme-avtar bg-primary">
                                                        <i class="ti ti-cast"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="m-0"><?php echo e(__('Memos')); ?></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
        
        
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Training</h5>
                        <div class="row  mt-4">
                            <div class="col-md-6 col-sm-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-users"></i>
                                    </div>
                                    <div class="ms-2">
                                        <p class="text-muted text-sm mb-0">Total Training</p>
                                        <h4 class="mb-0 text-success"><?php echo e($onGoingTraining +   $doneTraining); ?></h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 my-3 my-sm-0">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="theme-avtar bg-success">
                                        <i class="ti ti-user-check"></i>
                                    </div>
                                    <div class="ms-2">
                                        <p class="text-muted text-sm mb-0">Active Training</p>
                                        <h4 class="mb-0 text-danger"><?php echo e($onGoingTraining); ?></h4>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5>Jobs</h5>
                            <div class="col-md-6 col-sm-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-award"></i>
                                    </div>
                                    <div class="ms-2">
                                        <p class="text-muted text-sm mb-0">Total Jobs</p>
                                        <h4 class="mb-0 text-primary"><?php echo e($activeJob + $inActiveJOb); ?></h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <a href="<?php echo e(route('jobsAvailable.index')); ?>">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="theme-avtar bg-success">
                                            <i class="ti ti-award"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0">Active Jobs</p>
                                            <h4 class="mb-0 text-danger"><?php echo e($activeJob); ?></h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        
    

    <div class="row">
        <div class="col-lg-6">
            <div class="card list_card">
                <div class="card-header">
                    <h4><?php echo e(__('Announcement List')); ?></h4>
                </div>
                <div class="card-body dash-card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Title')); ?></th>
                                    <th><?php echo e(__('Start Date')); ?></th>
                                    <th><?php echo e(__('End Date')); ?></th>
                                    <th><?php echo e(__('description')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($announcement->title); ?></td>
                                        <td><?php echo e(\Auth::user()->dateFormat($announcement->start_date)); ?></td>
                                        <td><?php echo e(\Auth::user()->dateFormat($announcement->end_date)); ?></td>
                                        <td><?php echo e($announcement->description); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4">
                                            <div class="text-center">
                                                <h6><?php echo e(__('There is no Announcement List')); ?></h6>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card list_card">
                <div class="card-header">
                    <h4><?php echo e(__('Meeting List')); ?></h4>
                </div>
                <div class="card-body dash-card-body">
                    <?php if(count($meetings) > 0): ?>
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Meeting title')); ?></th>
                                        <th><?php echo e(__('Meeting Date')); ?></th>
                                        <th><?php echo e(__('Meeting Time')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($meeting->title); ?></td>
                                            <td><?php echo e(\Auth::user()->dateFormat($meeting->date)); ?></td>
                                            <td><?php echo e(\Auth::user()->timeFormat($meeting->time)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="p-2">
                            <?php echo e(__('No meeting scheduled yet.')); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/dashboard/hod-dashboard.blade.php ENDPATH**/ ?>