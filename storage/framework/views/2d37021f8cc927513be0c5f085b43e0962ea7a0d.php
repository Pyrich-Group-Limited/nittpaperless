<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Liason office head')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="col-sm-12">
    <div class="row">
        <div class="col-xxl-6">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-hand-finger"></i>
                                        </div>
                                        <div class="ms-3">
                                            
                                            <h6 class="m-0"><?php echo e(__('Set Budget')); ?></h6>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-warning">
                                            <i class="ti ti-chart-pie"></i>
                                        </div>
                                        <div class="ms-3">
                                            <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                            <h6 class="m-0"><?php echo e(__('Leave Requests')); ?></h6>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-report-money"></i>
                                        </div>
                                        <div class="ms-3">
                                            
                                            <h6 class="m-0"><?php echo e(__('DTA')); ?></h6>
                                        </div>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-chart-bar"></i>
                                        </div>
                                        <div class="ms-3">
                                            
                                            <h6 class="m-0"><?php echo e(__(' Query')); ?></h6>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-chart-bar"></i>
                                        </div>
                                        <div class="ms-3">
                                            
                                            <h6 class="m-0"><?php echo e(__(' Memo')); ?></h6>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Calendar')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div id='calendar' class='calendar'></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ARthur\Desktop\projects\pyrich\new\nittpaperless\resources\views/dashboard/liason-dashboard.blade.php ENDPATH**/ ?>