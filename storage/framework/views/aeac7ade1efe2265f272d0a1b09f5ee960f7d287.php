<div class="modal-body">
    <?php if(Auth::user()->type=="unit head" || Auth::user()->type=="supervisor"): ?>
        <?php echo e(Form::open(array('route'=>['approve.unithead',$dta->id],'method'=>'post'))); ?>

        <?php echo Form::hidden('type', 0); ?>

        <?php echo Form::submit('Approve', ['class' => 'btn btn-primary btn-sm']); ?>

        <?php echo Form::close(); ?>

    <?php elseif(Auth::user()->type=="liason office head" || auth()->user()->type=='HOD'): ?>
        <?php echo e(Form::open(array('route'=>['approve.hod',$dta->id],'method'=>'post'))); ?>

        <?php echo Form::hidden('type', 0); ?>

        <?php echo Form::submit('Approve', ['class' => 'btn btn-primary btn-sm']); ?>

        <?php echo Form::close(); ?>

    <?php elseif(Auth::user()->type=="accountant"): ?>
        <?php echo e(Form::open(array('route'=>['approve.accountant',$dta->id],'method'=>'post'))); ?>

        <?php echo Form::hidden('type', 0); ?>

        <?php echo Form::submit('Approve', ['class' => 'btn btn-primary btn-sm']); ?>

        <?php echo Form::close(); ?>

    <?php endif; ?>

    <br>

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
                                <td><?php echo e($dta->user->name); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Destination</th>
                                <td><?php echo e($dta->destination); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Purpose</th>
                                <td style="white-space: pre-wrap"><?php echo e($dta->purpose); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Travel Date</th>
                                <td><?php echo e(date('d-M-Y', strtotime($dta->travel_date))); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Arrival Date</th>
                                <td><?php echo e(date('d-M-Y', strtotime($dta->arrival_date))); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Estimated Expenses</th>
                                <td>₦ <?php echo e(number_format($dta->estimated_expense,2)); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Date Submitted</th>
                                <td><?php echo e($dta->created_at->format('d-M-Y')); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td>
                                    <?php if($dta->status=="pending"): ?>
                                        <p class="text-warning mb-0"><?php echo e($dta->status); ?> <?php echo e($dta->current_approver.' '.'approval'); ?></p>
                                    <?php elseif($dta->status=="rejected"): ?>
                                            <p class="text-danger mb-0"><?php echo e($dtaRequest->status); ?></p>
                                    <?php else: ?>
                                        <p class="text-success mb-0"><?php echo e($dta->status); ?></p>
                                    <?php endif; ?>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        </div>

        <div class="modal-footer">
            <input type="button" value="<?php echo e(('Cancel')); ?>" class="btn  btn-light btn-sm" data-bs-dismiss="modal">
            
            
        </div>
    
    <?php echo e(Form::close()); ?>

    </div>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/dta/show.blade.php ENDPATH**/ ?>