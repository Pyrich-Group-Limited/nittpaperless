<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Advert')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Adverts')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>


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

    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-cast"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Advert')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e(count($totalAdverts)); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-info">
                                    <i class="ti ti-cast"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Closed')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Adverts')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e(count($totalAdverts->where('status','Pending') )); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-warning">
                                    <i class="ti ti-cast"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Open')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Adverts')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e(count($totalAdverts->where('status','Completed') )); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Project Name')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th><?php echo e(__('Start Date')); ?></th>
                                <th><?php echo e(__('End Date')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Date Advertised')); ?></th>
                                <?php if( Gate::check('edit Job') ||Gate::check('delete job') ||Gate::check('show job')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $adverts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($advert->advert_name); ?></td>
                                    <td><?php echo Str::limit(strip_tags($advert->description),120); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($advert->start_date)); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($advert->end_date)); ?></td>
                                    <td>
                                        <?php if(getAdvertStatus($advert)=="Open"): ?>
                                            <span class="status_badge badge bg-success p-2 px-3 rounded"><?php echo e($advert->status); ?></span>
                                        <?php else: ?>
                                            <span class="status_badge badge bg-danger p-2 px-3 rounded"><?php echo e($advert->status); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(\Auth::user()->dateFormat($advert->created_at)); ?></td>
                                    <?php if( Gate::check('edit job') ||Gate::check('delete job') || Gate::check('show job')): ?>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show job')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-title="<?php echo e(__('View Project')); ?>" title="<?php echo e(__('View')); ?>"  class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" data-original-title="<?php echo e(__('View Project')); ?>">
                                                        <i class="ti ti-eye text-white"></i></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit job')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-title="<?php echo e(__('Edit Project')); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit Project')); ?>">
                                                        <i class="ti ti-pencil text-white"></i></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit job')): ?>
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" data-title="<?php echo e(__('Advertise Project')); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit Project')); ?>">
                                                    <i class="ti ti-pencil text-white"></i></a>
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
<?php echo $__env->make('livewire.procurements.projects.modals.new-advert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/livewire/procurements/advert/procurement-adverts-component.blade.php ENDPATH**/ ?>