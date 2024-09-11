<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Query')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Query')); ?></li>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
        <?php echo $__env->make('hrm.includes.dash-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Subject Submited by')); ?></th>
                                <th><?php echo e(__('Department')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="font-style">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-NITT-2\resources\views/hrm/query.blade.php ENDPATH**/ ?>