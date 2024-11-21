<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Leave Pending Approvals')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Leave Pending Approvals')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style" >
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Employee Name')); ?></th>
                                <th><?php echo e(__('Employee Department')); ?></th>
                                <th><?php echo e(__('Type of Leave')); ?></th>
                                <th><?php echo e(__('Leave Date')); ?></th>
                                <th><?php echo e(__('Number of Days')); ?></th>
                                <th><?php echo e(__('Resumption Date')); ?></th>
                                <th><?php echo e(__('Leave Status')); ?></th>
                                <th><?php echo e(__('Approval Stage')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $approvals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $approval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e($approval->leave->user->name); ?></td>
                                    <td><?php echo e($approval->leave->user->department->name); ?></td>
                                    <td><?php echo e($approval->leave->leaveType->title); ?></td>
                                    <td>11-10-2024</td>
                                    <td><?php echo e($approval->leave->total_leave_days); ?></td>
                                    <td><?php echo e($approval->leave->end_date); ?></td>
                                    <td>
                                        <span class="badge <?php if($approval->leave->status=='Pending'): ?> bg-warning
                                            <?php elseif($approval->leave->status=='Approved'): ?> bg-primary
                                            <?php elseif($approval->leave->status=='reject'): ?> bg-danger
                                            <?php endif; ?> p-2 px-3 rounded"><?php echo e($approval->leave->status); ?>

                                        </span>
                                        
                                    </td>
                                    <td><?php echo e($approval->status); ?> / <?php echo e($approval->approval_stage); ?></td>
                                    <td class="Action">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('approve leave')): ?>
                                        <div class="action-btn bg-info ms-2">
                                            <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="<?php echo e(route('view-leave-application',$approval->leave->id)); ?>" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>"  data-title="<?php echo e(__('Leave Applicaiton Details')); ?>">
                                                <i class="ti ti-eye text-white"></i>
                                            </a>
                                        </div>
                                            <form method="POST" action="<?php echo e(route('approvals.update', $approval->id)); ?>">
                                                <?php echo csrf_field(); ?>
                                                <select name="status" class="">
                                                    <option value="approved">Approve</option>
                                                    <option value="rejected">Reject</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm" >Update Approval</button>
                                            </form>
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
    
    <?php if($errors->any() || Session::has('error')): ?>
    <script>
         $(document).ready(function() {
            // $('#applyLeaveButton').modal('show');
            document.getElementById("applyLeaveButton").click();
         });
    </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/hrm/approvals.blade.php ENDPATH**/ ?>