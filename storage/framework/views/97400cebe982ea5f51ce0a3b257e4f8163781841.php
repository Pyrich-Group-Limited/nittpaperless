<div>
     <?php $__env->slot('title', null, []); ?> Contract Adverts <?php $__env->endSlot(); ?>
    <?php $__env->startSection('services'); ?> active <?php $__env->stopSection(); ?>

    <div class="page-title-wrap typo-white" wire:ignore>
        <div class="page-title-wrap-inner section-bg-img" data-bg="<?php echo e(asset('/guest/rs-plugin/assets/z2-slider-1.jpg')); ?>">
            <span class="theme-overlay"></span>
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="page-title-inner">
                            <div id="breadcrumb" class="breadcrumb margin-bottom-10">
                                <a href="<?php echo e(route('welcome')); ?>" class="theme-color">Home</a>
                                <span class="current">Adverts</span>
                            </div>
                            <h1 class="page-title mb-0">Contract Adverts</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-header -->

    <section id="events-section" class="events-section pad-bottom-70">
        <!-- Screan Reader Text -->
        <h2 class="screen-reader-text">Contract Adverts</h2>
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Col -->
                <div class="col-md-12">
                    <?php if(count($adverts)>0): ?>
                    <!--events Main wrap-->
                    <div class="events-main-wrapper events-grid events-style-4">
                        <div class="row">
                            <div class="offset-md-2 col-md-8">
                                <div class="title-wrap text-center">
                                    <div class="section-title">
                                        <span class="sub-title theme-color text-uppercase">Published</span>
                                        <h2 class="section-title margin-top-5">Contract Advert</h2>
                                        <span class="border-bottom center"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Col-md -->
                            <?php $__currentLoopData = $adverts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-6">
                                <!--events Inner-->
                                <div class="events-inner margin-bottom-30">
                                    <!--events Thumb-->
                                    <div class="events-thumb mb-0 relative">
                                        <img src="<?php if($advert->image): ?><?php echo e(asset('guest/images/uploads/'.$advert->image)); ?> <?php else: ?> <?php echo e(asset('uploads/procurement.png')); ?> <?php endif; ?>" class="img-fluid thumb w-100" width="768" height="456" alt="<?php echo e($advert->project->project_title); ?>">
                                    </div>
                                    <!--events details-->
                                    <div class="events-details pad-30">

                                        <div class="event-title mb-3">
                                            <h5><a href="#"><?php echo e($advert->project->project_title); ?></a></h5>
                                        </div>
                                        <div class="event-excerpt mb-3">
                                            <p><?php echo Str::limit(strip_tags($advert->description),70); ?></p>
                                        </div>
                                        <div class="read-more">
                                            
                                        </div>
                                    </div>
                                    <!--events details-->
                                </div>
                                <!--events Inner Ends-->
                            </div>
                            <!--Col-md Ends-->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!-- events Row -->
                    </div>
                    <?php else: ?>
                    <div align="center" id="norecord"><img style="margin-left:;"  width="100" src="https://img.freepik.com/free-vector/
                        no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                        alt="No results found" >
                        <p class="mt-2 text-danger">No Contract Advert</p>
                        </div>
                    <?php endif; ?>
                    <!-- events Main wrap Ends -->
                </div>
                <!-- Col -->
            </div>
            <!-- Row -->
        </div>
    </section>
</div>
<!-- .page-wrapper-inner -->
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/livewire/guest/service/services-component.blade.php ENDPATH**/ ?>