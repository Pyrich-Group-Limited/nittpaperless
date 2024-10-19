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
        <?php if(count(Auth::user()->projectApplications($advert->project_id))<=0): ?>
        <div class="col-md-6 ">
            <div class="card emp_details">
                <div class="card-header"><h6 class="mb-0"><?php echo e($advert->project->project_name); ?></h6></div>
                <div class="card-body employee-detail-edit-body">
                    <img src="<?php if($advert->image): ?><?php echo e(asset('guest/images/uploads/'.$advert->image)); ?> <?php else: ?> <?php echo e(asset('uploads/procurement.png')); ?> <?php endif; ?>" class="img-fluid thumb w-100" width="768" height="456" alt="<?php echo e($advert->project->project_title); ?>">
                </div><hr>
                <p style="padding: 20px; font-weight:500"><?php echo $advert->description; ?></p>
                <div class="col-md-6" style="padding-left: 20px; padding-bottom: 20px">
                    <a href="#"><input type="button"  data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>"  value="<?php echo e(__('Apply')); ?>" class="btn  btn-primary confirm-application"></a>

                    <div wire:loading wire:target="applyContract"><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.g-loader','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('g-loader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></div>
                </div>
            </div>
        </div>
        <?php else: ?>
            <div class="alert alert-success">You have successfully applied for this project, <a href=""> here</a> to view application status</div>
        <?php endif; ?>

    </div>
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/contractor/advert-details-component.blade.php ENDPATH**/ ?>