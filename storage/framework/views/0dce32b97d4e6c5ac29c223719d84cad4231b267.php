<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Set Budget')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Set Budget')); ?></li>
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
                                <th><?php echo e(__('Location/Liason office')); ?></th>
                                <th><?php echo e(__('Dapartment')); ?></th>
                                <th><?php echo e(__('Year')); ?></th>
                                <th><?php echo e(__('Approved By')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="font-style">
                                    <td>Gombe Liason Office</td>
                                    <td>Procurement</td>
                                    <td>2024</td>
                                    <td>Ahmed Isah</td>

                                        <td class="Action">
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="#"
                                                   data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>" data-title="<?php echo e(__('Details')); ?>">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="#" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"  data-title="<?php echo e(__('Edit Record')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-danger ms-2">
                                                <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="#" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"  data-title="<?php echo e(__('Delete Record')); ?>">
                                                    <i class="ti ti-trash text-white"></i>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ARthur\Desktop\projects\pyrich\nittpaperless\resources\views/accountant/set-budget-index.blade.php ENDPATH**/ ?>