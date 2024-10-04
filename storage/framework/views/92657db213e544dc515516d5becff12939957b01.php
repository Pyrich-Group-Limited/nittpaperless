
    <div class="modal-body">
        <?php echo e(Form::open(array('route'=>'leave.apply','method'=>'post'))); ?>

        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="row">

                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">

                            <tbody>
                                <style>
                                    th{
                                        width: 200px !important;
                                    }
                                </style>
                                <tr>
                                    <th scope="row">Emloyee Name</th>
                                    <td>#<?php echo e($leave->user->name); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Department</th>
                                    <td><?php echo e($leave->user->department->name); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Type of Leave</th>
                                    <td><?php echo e($leave->leaveType->title); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Start Date</th>
                                    <td><?php echo e($leave->start_date); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">End Date</th>
                                    <td><?php echo e($leave->end_date); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Leave Duration</th>
                                    <td><?php echo e($leave->total_leave_days. " Days"); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>

        <div class="modal-footer">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
        </div>

        <?php echo e(Form::close()); ?>

    </div>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/hrm/modals/view-leave-application.blade.php ENDPATH**/ ?>