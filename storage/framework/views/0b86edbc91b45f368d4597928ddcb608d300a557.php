<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Leave')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Leave')); ?></li>
<?php $__env->stopSection(); ?>




<?php $__env->startSection('content'); ?>
        
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style" >
                    <div class="table-responsive">
                        <div class="table-head col-xl-12 mt-2" style="text-align: right;">
                            <a href="#" class="btn btn-primary" id="applyLeaveButton" data-bs-toggle="modal" data-bs-target="#applyLeave"   data-size="lg " data-bs-toggle="tooltip"><i class="ti ti-plus text-white"></i>Apply for Leave</a>
                        </div>
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Employee Name')); ?></th>
                                <th><?php echo e(__('Employee Department')); ?></th>
                                <th><?php echo e(__('Type of Leave')); ?></th>
                                <th><?php echo e(__('Leave Date')); ?></th>
                                <th><?php echo e(__('Number of Days')); ?></th>
                                <th><?php echo e(__('Resumption Date')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e($leave->user->name); ?></td>
                                    <td><?php echo e($leave->user->department->name); ?></td>
                                    <td><?php echo e($leave->leaveType->title); ?></td>
                                    <td>11-10-2024</td>
                                    <td><?php echo e($leave->total_leave_days); ?></td>
                                    <td><?php echo e($leave->end_date); ?></td>
                                    <td><?php echo e($leave->status); ?></td>
                                    <td class="Action">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage leave')): ?>
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
                                        <?php else: ?>
                                        <div class="action-btn bg-danger ms-2">
                                            <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="<?php echo e(route('view-leave-application',$leave->id)); ?>" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>"  data-title="<?php echo e(__('Leave Applicaiton Details')); ?>">
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
    <?php echo $__env->make('hrm.modals.apply-leave', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if($errors->any() || Session::has('error')): ?>
    <script>
         $(document).ready(function() {
            // $('#applyLeaveButton').modal('show');
            document.getElementById("applyLeaveButton").click();
         });
    </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/hrm/leave.blade.php ENDPATH**/ ?>