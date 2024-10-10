<div class="modal-body">
    <div class="row">
            <?php $__currentLoopData = $dtas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col text-center">
                    <div class="card p-4 mb-4">
                        <h7 class="report-text gray-text mb-0"><?php echo e($dta->status); ?> :</h7>
                        <h6 class="report-text mb-0"><?php echo e($dta->total); ?></h6>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="row mt-2">
            <table class="table datatable">
                <thead>
                <tr>
                    <th><?php echo e(__('Destination')); ?></th>
                    <th><?php echo e(__('DTA Date')); ?></th>
                    <th><?php echo e(__('DTA Days')); ?></th>
                    <th><?php echo e(__('Estimated cost')); ?></th>
                    <th><?php echo e(__('DTA Purpose')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $dtaData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        
                        <td><?php echo e($dta->destination); ?></td>
                        <td>
                            <?php echo e(date('d-M-Y', strtotime($dta->travel_date)). 'to '.date('d-M-Y', strtotime($dta->arrival_date))); ?>

                        </td>
                        <td>
                            <?php echo e(round(strtotime($dta->arrival_date) - strtotime($dta->travel_date))/ 86400); ?> Days
                        </td>
                        <td>₦ <?php echo e(number_format($dta->estimated_expense,2)); ?></td>
                        <td style="white-space: pre-wrap"><?php echo e($dta->purpose); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center"><?php echo e(__('No Data Found.!')); ?></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/dta/dtaShow.blade.php ENDPATH**/ ?>