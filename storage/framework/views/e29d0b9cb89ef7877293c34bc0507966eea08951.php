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
    <div class="col-md-6 ">
        <div class="card emp_details">
            <div class="card-header"><h6 class="mb-0"><?php echo e(__('Company Detail')); ?></h6></div>
            <div class="card-body employee-detail-edit-body">

                <div class="row">
                    <div class="form-group col-md-12">
                        <?php echo Form::label('name', __('Company Name'),['class'=>'form-label']); ?><span class="text-danger pl-1">*</span>
                       <input type="text" wire:model="company_name" class="form-control" />
                       <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                       <small class="invalid-type_of_leave" role="alert">
                           <strong class="text-danger"><?php echo e($message); ?></strong>
                       </small>
                   <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php echo Form::label('name', __('Year of Incoperation'),['class'=>'form-label']); ?><span class="text-danger pl-1">*</span>
                       <input type="text" wire:model="year" class="form-control" />
                       <?php $__errorArgs = ['year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="invalid-type_of_leave" role="alert">
                                <strong class="text-danger"><?php echo e($message); ?></strong>
                            </small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php echo Form::label('name', __('Tin'),['class'=>'form-label']); ?><span class="text-danger pl-1">*</span>
                       <input type="text" wire:model="tin" class="form-control" />
                       <?php $__errorArgs = ['tin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="invalid-type_of_leave" role="alert">
                                <strong class="text-danger"><?php echo e($message); ?></strong>
                            </small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo Form::label('address', __('Company Address'),['class'=>'form-label']); ?><span class="text-danger pl-1">*</span>
                    <textarea class="form-control" wire:model="address"></textarea>
                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="invalid-type_of_leave" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <?php echo Form::label('name', __('Email'),['class'=>'form-label']); ?><span class="text-danger pl-1">*</span>
                       <input type="text" wire:model="email" class="form-control" />
                       <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="invalid-type_of_leave" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php echo Form::label('name', __('Phone Number'),['class'=>'form-label']); ?><span class="text-danger pl-1">*</span>
                       <input type="text" wire:model="phoneno" class="form-control" />
                       <?php $__errorArgs = ['phoneno'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                       <small class="invalid-type_of_leave" role="alert">
                           <strong class="text-danger"><?php echo e($message); ?></strong>
                       </small>
                   <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div align="center" wire:loading wire:target="updateProfile"><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
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
                <input type="button"  wire:click="updateProfile" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
            </div>
        </div>
    </div>

</div>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/livewire/contractor/contractor-profile.blade.php ENDPATH**/ ?>