<div>
     <?php $__env->slot('title', null, []); ?> User Authentitcation <?php $__env->endSlot(); ?>
    <?php $__env->startSection('contact'); ?> active <?php $__env->stopSection(); ?>

    <!-- Page Content -->
    <div class="content-wrapper pad-none">
        <div class="content-inner">
            <!-- Contact Section -->
            <section class="contact-form-section form-with-img">
                <div class="container">
                    <div class="row">
                        <!-- col -->
                        <div class="col-lg-6 pad-none">
                            <img src="<?php echo e(asset('uploads/login.png')); ?>" width="80%" />
                        </div>
                        <div class="col-lg-6 pe-0">
                            <!-- Contact Form -->
                            <div class="contact-form-4 bg-white">
                                <!-- Form -->
                                <div class="contact-form-wrap">
                                    <h4 class="title">Authorized Access</h4><hr>
                                    <!-- form inputs -->
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.feedback-alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('feedback-alert'); ?>
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
<?php endif; ?>
                                    <form class="contact-form" wire:submit.prevent="login" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- form group -->
                                                <div class="form-group mt-2">
                                                    <input id="email" class="form-control" wire:model="email" name="email" placeholder="Email"  type="email">
                                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-1">
                                                <!-- form group -->
                                                <div class="form-group">
                                                    <input id="password" class="form-control" wire:model="password" name="password" placeholder="password"  type="password">
                                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <!-- form button -->
                                                <button  type="submit" class="btn btn-default mt-0 theme-btn">Login <div wire:loading wire:target="login"><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest-loader','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('guest-loader'); ?>
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
<?php endif; ?></div></button> Arleady have an account ? <a href="<?php echo e(route('contractor.register')); ?>"> Register</a>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- form inputs end -->
                                </div>
                                <!-- Form End-->
                            </div>
                            <!-- contact-form-1 -->
                        </div>
                        <!-- .col -->

                         <!-- Col -->
                    </div>
                </div>
            </section>
            <!-- Contact Form Section End -->
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/guest/contractor-login-component.blade.php ENDPATH**/ ?>