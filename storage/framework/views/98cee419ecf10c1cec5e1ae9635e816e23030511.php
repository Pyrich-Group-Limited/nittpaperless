<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Assets/Store')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Product & Services')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="<?php echo e(__('Import')); ?>" data-url="<?php echo e(route('productservice.file.import')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Import product CSV file')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
        <a href="<?php echo e(route('productservice.export')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>

        <a href="#" data-size="lg" data-url="<?php echo e(route('productservice.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Product')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class=" mt-2 <?php echo e(isset($_GET['category'])?'show':''); ?>" id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service'])); ?>

                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="">Filter</label>
                                <select name="" id="" class="form-control">
                                    <option value="">--Select Filter--</option>
                                    <option value="">Asset Type</option>
                                    <option value="">Asset Code</option>
                                    <option value="">Model Number</option>
                                    <option value="">Location</option>
                                    <option value="">Year</option>
                                </select>
                                
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="<?php echo e(__('apply')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('SN')); ?></th>
                                <th><?php echo e(__('Asset Identification Code')); ?></th>
                                <th><?php echo e(__('Asset Type')); ?></th>
                                <th><?php echo e(__('Asset Description')); ?></th>
                                <th><?php echo e(__('Location')); ?></th>
                                <th><?php echo e(__('No. of Units')); ?></th>
                                <th><?php echo e(__('Model Number')); ?></th>
                                <th><?php echo e(__('Year of Manufacture')); ?></th>
                                <th><?php echo e(__('Serial No./Other')); ?></th>
                                <th><?php echo e(__('Date of Purchase')); ?></th>
                                <th><?php echo e(__('Initial Cost (₦)')); ?></th>
                                <th><?php echo e(__('Measure improvement of asset (if any)')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e($productService->sn); ?></td>
                                    <td><?php echo e($productService->asset_identification_code); ?></td>
                                    <td><?php echo e($productService->asset_type); ?></td>
                                    <td><?php echo e($productService->asset_description); ?></td>
                                    <td><?php echo e($productService->location); ?></td>
                                    <td><?php echo e($productService->no_of_unit); ?></td>
                                    <td><?php echo e($productService->model_number); ?></td>
                                    <td><?php echo e($productService->year_of_manufacture); ?></td>
                                    <td><?php echo e($productService->serial_no_other); ?></td>
                                    <td><?php echo e($productService->date_of_purchase); ?></td>
                                    <td><?php echo e($productService->initial_cost); ?></td>
                                    <td><?php echo e($productService->measure_improvement_of_asset); ?></td>
                                    

                                    <?php if(Gate::check('edit product & service') || Gate::check('delete product & service')): ?>
                                        <td class="Action">

                                            <div class="action-btn bg-warning ms-2">
                                                <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('productservice.detail',$productService->id)); ?>"
                                                   data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Warehouse Details')); ?>" data-title="<?php echo e(__('Warehouse Details')); ?>">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit product & service')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="<?php echo e(route('productservice.edit',$productService->id)); ?>" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"  data-title="<?php echo e(__('Edit Product')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete product & service')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['productservice.destroy', $productService->id],'id'=>'delete-form-'.$productService->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" ><i class="ti ti-trash text-white"></i></a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ENIT\nittpaperless\resources\views/productservice/index.blade.php ENDPATH**/ ?>