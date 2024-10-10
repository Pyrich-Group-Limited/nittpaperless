<div>
    <?php
    $profile=\App\Models\Utility::get_file('uploads/avatar');
    ?>
 <?php $__env->startSection('page-title'); ?>
     <?php echo e(__('ERGP')); ?>

 <?php $__env->stopSection(); ?>

 <?php $__env->startPush('script-page'); ?>
 <?php $__env->stopPush(); ?>
 <?php $__env->startSection('breadcrumb'); ?>
     <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
     <li class="breadcrumb-item"><?php echo e(__('ERGP')); ?></li>
 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('action-btn'); ?>
        <div class="float-end">

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create project')): ?>
                

                <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#editProject" id="toggleOldProject"
                    data-bs-toggle="tooltip" title="<?php echo e(__('Add ERGP')); ?>" class="btn btn-sm btn-primary">
                    <i class="ti ti-plus text-white"> Add</i>
                </a>
            <?php endif; ?>
        </div>
    <?php $__env->stopSection(); ?>

<div class="col-xl-12">

    <div class="card mt-4">
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th><?php echo e(__('SN')); ?></th>
                        <th><?php echo e(__('ERGP CODE')); ?></th>
                        <th><?php echo e(__('ERGP TITLE')); ?></th>
                        <th><?php echo e(__('Total Value')); ?></th>
                        <th><?php echo e(__('Amount Paid')); ?></th>
                        <th><?php echo e(__('Balance')); ?></th>
                        <th><?php echo e(__('Deficit')); ?></th>
                        <th><?php echo e(__('Year')); ?></th>
                        <th><?php echo e(__('Action')); ?></th>
                    </tr>
                    </thead>

                    <tbody>
                    
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div>
<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/livewire/physical-planning/ergp-component.blade.php ENDPATH**/ ?>