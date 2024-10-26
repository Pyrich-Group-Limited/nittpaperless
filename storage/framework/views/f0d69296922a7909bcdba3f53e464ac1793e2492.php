<?php $__env->startSection('page-title'); ?>
   Contractor Dashbaord
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    </script>

    
    <script>
        function copyToClipboard(element) {

            var copyText = element.id;
            navigator.clipboard.writeText(copyText);
            // document.addEventListener('copy', function (e) {
            //     e.clipboardData.setData('text/plain', copyText);
            //     e.preventDefault();
            // }, true);
            //
            // document.execCommand('copy');
            show_toastr('success', 'Url copied to clipboard', 'success');
        }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('projects.index')); ?>"><?php echo e(__('Contractor')); ?></a></li>
    <li class="breadcrumb-item">Dashboard</li>
<?php $__env->stopSection(); ?>

<div class="row">

    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-danger">
                                <i class="ti ti-report-money"></i>
                            </div>
                            <div class="ms-3">
                                <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                <h6 class="m-0"><?php echo e(__('Advert')); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-end">
                        <h4 class="m-0"><?php echo e(count(App\Models\ProjectAdvert::where('advert_type','External')->get())); ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-report-money"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Applications')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e(count(App\Models\ProjectApplication::where('user_id',Auth::user()->id)->get())); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</div>
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/contractor/contractor-dashboard.blade.php ENDPATH**/ ?>