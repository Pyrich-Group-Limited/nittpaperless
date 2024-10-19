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
        <?php $__currentLoopData = $adverts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 ">
            <div class="card emp_details">
                <div class="card-body employee-detail-edit-body">
                    <img src="<?php if($advert->image): ?><?php echo e(asset('guest/images/uploads/'.$advert->image)); ?> <?php else: ?> <?php echo e(asset('uploads/procurement.png')); ?> <?php endif; ?>" class="img-fluid thumb w-100" width="768" height="456" alt="<?php echo e($advert->project->project_title); ?>">
                </div><hr>
                <div class="card-header"><h6 class="mb-0"><?php echo e($advert->project->project_name); ?></h6></div>
                <p style="padding: 20px; font-weight:500"><?php echo Str::limit(strip_tags($advert->description),150); ?></p>
                <div class="col-md-6" style="padding-left: 20px; padding-bottom: 20px">
                    <a href="<?php echo e(route('contractor.advert.show',$advert->id)); ?>"><input type="button"   value="<?php echo e(__('View Details')); ?>" class="btn  btn-primary"></a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/contractor/advert-component.blade.php ENDPATH**/ ?>