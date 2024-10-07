<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('My DTA Requests')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('My DTA Requests')); ?></li>
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
                        <a class="dropdown-item filter-action pl-4" href="#" data-val=""><?php echo e(__('Status Filter')); ?></a>
                </div>
            
            <a href="#" data-size="lg" data-url="<?php echo e(route('dta.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Apply for DTA')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Destination')); ?></th>
                                <th><?php echo e(__('Full Name')); ?></th>
                                <th><?php echo e(__('Number of Days')); ?></th>
                                <th><?php echo e(__('Travel Date')); ?></th>
                                <th><?php echo e(__('Arrival Date')); ?></th>
                                <th><?php echo e(__('Estimate Expenses')); ?></th>
                                <th><?php echo e(__('Date Applied')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $dtaRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dtaRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="font-style">
                                        <td><?php echo e($dtaRequest->destination); ?></td>
                                        <td><?php echo e($dtaRequest->user->name); ?></td>
                                        <td>
                                            <?php echo e(round(strtotime($dtaRequest->arrival_date) - strtotime($dtaRequest->travel_date))/ 86400); ?> Days
                                        <td>
                                            <?php echo e(date('d-M-Y', strtotime($dtaRequest->travel_date))); ?>

                                        </td>
                                        <td><?php echo e(date('d-M-Y', strtotime($dtaRequest->arrival_date))); ?></td>
                                        <td>₦ <?php echo e(number_format($dtaRequest->estimated_expense,2)); ?></td>
                                        <td><?php echo e($dtaRequest->created_at->format('d-M-Y')); ?></td>
                                        <td>
                                            <?php if($dtaRequest->status=="pending"): ?>
                                                <p class="text-warning mb-0"><?php echo e($dtaRequest->status); ?> <?php echo e($dtaRequest->current_approver.' '.'approval'); ?></p>
                                            <?php elseif($dtaRequest->status=="rejected"): ?>
                                                <p class="text-danger mb-0"><?php echo e($dtaRequest->status); ?></p>
                                            <?php else: ?>
                                                <p class="text-success mb-0"><?php echo e($dtaRequest->status); ?></p>
                                            <?php endif; ?>
                                        </td>
                                        <td class="Action">
                                            <?php if($dtaRequest->status!="rejected"): ?>
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="<?php echo e(route('dta.show',$dtaRequest->id)); ?>" data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('DTA Details')); ?>"  data-title="<?php echo e(__('DTA Details')); ?>">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reject dta')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url=<?php echo e(route('reject.show',$dtaRequest->id)); ?> data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Reject with Comment')); ?>"  data-title="<?php echo e(__('Reject with Comment')); ?>">
                                                        <i class="ti ti-thumb-down text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if($dtaRequest->status=="rejected"): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="<?php echo e(route('rejected.show',$dtaRequest->id)); ?>" data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"  data-title="<?php echo e(__('Details')); ?>">
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/dta/index.blade.php ENDPATH**/ ?>