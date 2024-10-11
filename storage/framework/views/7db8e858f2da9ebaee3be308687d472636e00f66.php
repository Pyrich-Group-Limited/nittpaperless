<div>
    <?php $__env->startSection('advert'); ?>
        active
    <?php $__env->stopSection(); ?>

     <?php $__env->slot('title', null, []); ?> What we do <?php $__env->endSlot(); ?>
     <?php $__env->slot('logo', null, []); ?> <?php if($advert->image): ?><?php echo e(asset('guest/images/uploads/'.$advert->image)); ?> <?php else: ?> <?php echo e(asset('uploads/procurement.png')); ?> <?php endif; ?> <?php $__env->endSlot(); ?>
     <?php $__env->slot('description', null, []); ?> <?php echo Str::limit(strip_tags($advert->description), 100); ?> <?php $__env->endSlot(); ?>
     <?php $__env->slot('title', null, []); ?> <?php echo e($advert->service_title); ?> <?php $__env->endSlot(); ?>

    <div class="page-title-wrap typo-white">
        <div class="page-title-wrap-inner section-bg-img" data-bg="<?php if($advert->image): ?><?php echo e(asset('guest/images/uploads/'.$advert->image)); ?> <?php else: ?> <?php echo e(asset('uploads/procurement.png')); ?> <?php endif; ?>">
            <span class="theme-overlay"></span>
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="page-title-inner">
                            <div id="breadcrumb" class="breadcrumb margin-bottom-10">
                                <a href="<?php echo e(route('welcome')); ?>" class="theme-color">Home</a>
                                <span class="current">Contract Advert</span>
                            </div>
                            <h1 class="page-title mb-0"><?php echo e($advert->project->project_name); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-header -->
    <!-- Page Content -->
    <div class="content-wrapper pad-none">
        <div class="content-inner">
            <section id="ministries-section" class="ministries-section pad-bottom-70">
                <div class="container">
                    <!-- Sermon Main Wrap -->
                    <div class="ministries-main-wrap ministries-grid">
                        <!-- Row -->
                        <div class="row">
                            <!-- Col -->
                            <div class="col-lg-8">
                                <!-- Row -->
                                <div class="row">
                                    <!-- Col -->
                                    <div class="col-md-12">
                                        <!-- sermon img -->
                                        <div class="zoom-gallery">
                                            <div class="ministries-thumb relative margin-bottom-35">
                                                <img src="<?php if($advert->image): ?><?php echo e(asset('guest/images/uploads/'.$advert->image)); ?> <?php else: ?> <?php echo e(asset('uploads/procurement.png')); ?> <?php endif; ?>"
                                                    class="img-fluid single-sermon-img b-radius-10" width="1170"
                                                    height="694" alt="ministries-img">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Col -->
                                </div>
                                <!-- Row -->
                                <!-- Row 2 -->
                                <div class="row">
                                    <!-- Col -->
                                    <div class="col-md-12">
                                        <p class="margin-bottom-15"><?php echo $advert->description; ?>.</p>
                                    </div>
                                        <div class="header-navbar-text-1"><a href="<?php echo e(route('contractor.register')); ?>" class="h-donate-btn">Apply</a></div>
                                    <!-- Col -->
                                </div>

                            </div>
                            <!-- Col -->
                            
                            <!-- Col -->
                        </div>
                        <!-- Row -->
                    </div>
                    <!-- Sermon Main Wrap -->
                </div>
                <!-- Container -->
            </section>
        </div>
    </div>
</div>
<!-- .page-wrapper-inner -->
<!--page-wrapper-->
<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/livewire/guest/service/service-details-component.blade.php ENDPATH**/ ?>