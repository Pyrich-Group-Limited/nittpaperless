<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('DTA Requests')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('DTA Requests')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        <?php echo $__env->make('hrm.includes.dash-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <div class="table-head col-xl-12 mt-2" style="text-align: right;">
                            <a href="#" class="btn btn-primary" data-url="<?php echo e(route('hrm.applyDta')); ?>" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip"><i class="ti ti-plus text-white"></i>Apply DTA</a>
                        </div>
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
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="font-style">
                                    <td>Morocco</td>
                                    <td>Test Employee</td>
                                    <td>15</td>
                                    <td>11-10-2024</td>
                                    <td>26-10-2024</td>
                                    <td>1,2000,000</td>
                                    <td>5-10-2024</td>
                                    <td class="Action">
                                        <div class="action-btn bg-success ms-2">
                                            <a href="#" class="mx-3 btn btn-sm align-items-center" data-url=""
                                                data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Approve')); ?>" data-title="<?php echo e(__('Approve')); ?>">
                                                <i class="ti ti-check text-white"></i>
                                            </a>
                                        </div>
                                        <div class="action-btn bg-info ms-2">
                                            <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('Return')); ?>"  data-title="<?php echo e(__('Return')); ?>">
                                                <i class="ti ti-share text-white"></i>
                                            </a>
                                        </div>
                                        <div class="action-btn bg-danger ms-2">
                                            <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('Reject')); ?>"  data-title="<?php echo e(__('Reject')); ?>">
                                                <i class="ti ti-plus text-white"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/hrm/dta.blade.php ENDPATH**/ ?>