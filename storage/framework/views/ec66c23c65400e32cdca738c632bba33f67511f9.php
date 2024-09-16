<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Store Requisition Notes')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Store Requisition Notes')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php echo $__env->make('accountant.includes.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <div class="table-head col-xl-12 mt-2" style="text-align: right;">
                            <a href="#" class="btn btn-primary" data-url="<?php echo e(route('hrm.applyLeave')); ?>" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip"><i class="ti ti-plus text-white"></i>New</a>
                        </div>
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('SN')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Rank')); ?></th>
                                <th><?php echo e(__('Section')); ?></th>
                                <th><?php echo e(__('Department')); ?></th>
                                <th><?php echo e(__('Location')); ?></th>
                                <th><?php echo e(__('Requisition Note No.')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="font-style">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-</td>
                                    <td></td>

                                        <td class="Action">

                                            <div class="action-btn bg-warning ms-2">
                                                <a href="<?php echo e(route('storeReq.list')); ?>" class="mx-3 btn btn-sm align-items-center" data-url="#"
                                                   data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('View Details')); ?>" data-title="<?php echo e(__('View Details')); ?>">
                                                    <i class="ti ti-eye text-white"></i>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-NITT-2\resources\views/accountant/store-requisition.blade.php ENDPATH**/ ?>