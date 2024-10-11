<?php $__env->startSection('page-title'); ?>
    <?php echo e('Dashboard' . ' - ' . ' ' . Ucfirst(Auth::user()->type)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('theme-script'); ?>
    <script src="<?php echo e(asset('assets/libs/apexcharts/dist/apexcharts.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><b>Welcome </b><?php echo e(Ucfirst(Auth::user()->name) . '(' . Auth::user()->department->name . ')'); ?>

    </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="theme-avtar bg-primary">
                                <i class="ti ti-users"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4"><?php echo e(__('Total DTA')); ?></h6>
                            </div>
                        </div>
                        <h3 class="ms-4">6</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="theme-avtar bg-warning">
                                <i class="ti ti-shopping-cart"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4"><?php echo e(__('Total Leave')); ?></h6>
                            </div>
                        </div>
                        <h3 class="ms-4">6</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="theme-avtar bg-info">
                                <i class="ti ti-trophy"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4"><?php echo e(__('Budget')); ?></h6>
                            </div>
                        </div>
                        <h3 class="ms-4">6</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="theme-avtar bg-info">
                                <i class="ti ti-trophy"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4"><?php echo e(__('Budget')); ?></h6>
                            </div>
                        </div>
                        <h3 class="ms-4">6</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="theme-avtar bg-info">
                                <i class="ti ti-trophy"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4"><?php echo e(__('Budget')); ?></h6>
                            </div>
                        </div>
                        <h3 class="ms-4">6</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="theme-avtar bg-info">
                                <i class="ti ti-trophy"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4"><?php echo e(__('Budget')); ?></h6>
                            </div>
                        </div>
                        <h3 class="ms-4">6</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/dashboard/dg-dashboard.blade.php ENDPATH**/ ?>