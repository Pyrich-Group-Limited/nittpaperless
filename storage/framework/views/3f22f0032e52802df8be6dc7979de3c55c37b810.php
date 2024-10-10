<div class="modal-body">
    <div class="card ">
        <div class="card-body table-border-style full-card">
            <div class="table-responsive">
                
                <table class="table">
                    <thead>
                    <tr>
                        <th>Warehouse</th>
                        <th>Quantity</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php $__currentLoopData = $productservices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       
                            <tr>

                                <td>SN</td>
                                <td><?php echo e($product->sn); ?></td>


                            </tr>
                            <tr>

                                <td>SN</td>
                                <td><?php echo e($product->sn); ?></td>


                            </tr>
                            <tr>

                                <td>SN</td>
                                <td><?php echo e($product->sn); ?></td>


                            </tr>
                            <tr>

                                <td>SN</td>
                                <td><?php echo e($product->sn); ?></td>


                            </tr>
                            <tr>

                                <td>SN</td>
                                <td><?php echo e($product->sn); ?></td>


                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                
                
                
                
                
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\ENIT\nittpaperless\resources\views/productservice/detail.blade.php ENDPATH**/ ?>