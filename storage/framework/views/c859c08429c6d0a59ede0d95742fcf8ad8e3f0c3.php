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
                               <td><?php echo e($rejectedDta->user->name); ?></td>
                           </tr>
                           <tr>
                               <th scope="row">Destination</th>
                               <td><?php echo e($rejectedDta->destination); ?></td>
                           </tr>
                           <tr>
                               <th scope="row">Purpose</th>
                               <td style="white-space: pre-wrap"><?php echo e($rejectedDta->purpose); ?></td>
                           </tr>
                           <tr>
                               <th scope="row">Travel Date</th>
                               <td><?php echo e(date('d-M-Y', strtotime($rejectedDta->travel_date))); ?></td>
                           </tr>
                           <tr>
                               <th scope="row">Arrival Date</th>
                               <td><?php echo e(date('d-M-Y', strtotime($rejectedDta->arrival_date))); ?></td>
                           </tr>
                           <tr>
                               <th scope="row">Estimated Expenses</th>
                               <td>₦ <?php echo e(number_format($rejectedDta->estimated_expense,2)); ?></td>
                           </tr>
                           <tr>
                               <th scope="row">Date Submitted</th>
                               <td><?php echo e($rejectedDta->created_at->format('d-M-Y')); ?></td>
                           </tr>
                           <tr>
                               <th scope="row">Status</th>
                               <td>
                                    <p class="text-danger mb-0"><?php echo e($rejectedDta->status); ?></p>
                               </td>
                           </tr>

                           <tr>
                            <th scope="row">Rejection Comment</th>
                            <td style="white-space: pre-wrap"><?php echo e($rejectedDta->rejectionComment->comment); ?></td>
                        </tr>
                       </tbody>
                   </table>
               </div>
           </div>

       </div>

       <div class="modal-footer">
           <input type="button" value="<?php echo e(('Close')); ?>" class="btn  btn-light btn-sm" data-bs-dismiss="modal">
       </div>
    </div>
<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/dta/rejected.blade.php ENDPATH**/ ?>