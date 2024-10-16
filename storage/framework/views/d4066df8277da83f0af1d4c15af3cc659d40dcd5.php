<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Approved Supply Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('approvedSupply.list')); ?>"><?php echo e(__('Approved Supply')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('approvedSupply.details')); ?>"><?php echo e(__('Approved Supply Details')); ?></a></li>
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
                                <th><?php echo e(__('SN')); ?></th>
                                <th><?php echo e(__('Item No.')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th><?php echo e(__('Qty')); ?></th>
                                <th><?php echo e(__('Unit Price')); ?></th>
                                <th><?php echo e(__('Total Price')); ?></th>
                                <th><?php echo e(__('Ledger Folio No.')); ?></th>
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
                                    <td></td>
                                    <td class="Action">
                                        <div class="action-btn bg-success ms-2">
                                            <a href="#" class="mx-3 btn btn-sm align-items-center"
                                                data-ajax-popup="false" data-bs-toggle="tooltip" title="<?php echo e(__('Approve')); ?>" data-title="<?php echo e(__('Approve')); ?>">
                                                <i class="ti ti-check text-white"></i>
                                            </a>
                                        </div>
                                        <div class="action-btn bg-primary ms-2">
                                            <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('comment.modal')); ?>"
                                                data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Add Comment')); ?>" data-title="<?php echo e(__('Add Comment')); ?>">
                                                <i class="ti ti-clipboard text-white"></i>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ENIT\nittpaperless\resources\views/accountant/approved-supply-note-details.blade.php ENDPATH**/ ?>