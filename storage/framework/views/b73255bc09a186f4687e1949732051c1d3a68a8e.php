<div class="modal-body">
     <?php echo e(Form::open(array('route'=>['reject.dta',$dtaReject->id],'method'=>'post'))); ?>

    
    

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
                                <td><?php echo e($dtaReject->user->name); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Destination</th>
                                <td><?php echo e($dtaReject->destination); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Purpose</th>
                                <td style="white-space: pre-wrap"><?php echo e($dtaReject->purpose); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Travel Date</th>
                                <td><?php echo e(date('d-M-Y', strtotime($dtaReject->travel_date))); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Arrival Date</th>
                                <td><?php echo e(date('d-M-Y', strtotime($dtaReject->arrival_date))); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Estimated Expenses</th>
                                <td>₦ <?php echo e(number_format($dtaReject->estimated_expense,2)); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Date Submitted</th>
                                <td><?php echo e($dtaReject->created_at->format('d-M-Y')); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td>
                                    <?php if($dtaReject->status=="pending"): ?>
                                        <p class="text-warning mb-0"><?php echo e($dtaReject->status); ?> <?php echo e($dtaReject->current_approver.' '.'approval'); ?></p>
                                    <?php elseif($dtaReject->status=="rejected"): ?>
                                            <p class="text-danger mb-0"><?php echo e($dtaRequest->status); ?></p>
                                    <?php else: ?>
                                        <p class="text-success mb-0"><?php echo e($dtaReject->status); ?></p>
                                    <?php endif; ?>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="form-group col-md-12">
            <label for="" class="form-label">Add Rejection Comment</label>
            <textarea name="comment" id="" cols="30" rows="3" class="form-control" required></textarea>
            <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="invalid-role" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="modal-footer">
            <input type="button" value="<?php echo e(('Cancel')); ?>" class="btn  btn-light btn-sm" data-bs-dismiss="modal">
            <input type="submit" value="<?php echo e(__('Reject')); ?>" class="btn  btn-danger btn-sm">
        </div>
    
    <?php echo e(Form::close()); ?>

    </div>
<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/dta/reject.blade.php ENDPATH**/ ?>