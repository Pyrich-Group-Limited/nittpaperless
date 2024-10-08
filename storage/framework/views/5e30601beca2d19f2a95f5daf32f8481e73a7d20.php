<?php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Folders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Folders')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
                <a href="#" class="btn btn-sm btn-primary action-item" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-filter"></i>
                </a>
                <div class="dropdown-menu  dropdown-steady" id="project_sort">
                    <a class="dropdown-item <?php echo e($sortOrder == 'newest' ? 'active' : ''); ?>"
                    href="<?php echo e(route('folders.index', ['sort' => 'newest'])); ?>" data-val="created_at-desc">
                        <i class="ti ti-sort-descending"></i><?php echo e(__('Newest')); ?>

                    </a>
                    <a class="dropdown-item" <?php echo e($sortOrder == 'oldest' ? 'active' : ''); ?>

                    href="<?php echo e(route('folders.index', ['sort' => 'oldest'])); ?>" data-val="created_at-asc">
                        <i class="ti ti-sort-ascending"></i><?php echo e(__('Oldest')); ?>

                    </a>
                </div>

            
            <a href="#" data-size="lg" data-url="<?php echo e(route('folder.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create new folder')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus">New </i>
            </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="mt-2 " id="multiCollapseExample1">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="btn-box">
                                        <form action="<?php echo e(route('folders.index')); ?>" method="GET">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <input type="text" name="search" class="form-control" placeholder="Search folders by name" value="<?php echo e(request('search')); ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="submit" class="btn btn-primary form-control">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                
                <?php if($folders->count() > 0): ?>
                    <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-2 mb-4">
                        <div class="card text-center card-2">
                            <div class="card-header border-0 pb-0">
                                <div class="card-header-right">
                                    <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="#!" data-size="md" data-url="<?php echo e(route('folder.renameModal',$folder->id)); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Rename Folder')); ?>">
                                                <i class="ti ti-pencil"></i>
                                                <span><?php echo e(__('Rename')); ?></span>
                                            </a>
                                            <a href="<?php echo e(route('folder.details',$folder->id)); ?>"  class="dropdown-item">
                                                <i class="ti ti-eye"></i>
                                                <span> <?php echo e(__('View Details')); ?></span>
                                            </a>
                                            <a href="#!"  class="dropdown-item bs-pass-para">
                                                <i class="ti ti-share"></i>
                                                <span> <?php echo e(__('Share')); ?></span>
                                            </a>
                                            <a href="#!"  class="dropdown-item bs-pass-para">
                                                <i class="ti ti-archive"></i>
                                                <span> <?php echo e(__('Archive')); ?></span>
                                            </a>
                                            <?php echo Form::close(); ?>

                                            <a href="#!" data-url="" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Reset Password')); ?>">
                                                <i class="ti ti-adjustments"></i>
                                                <span>  <?php echo e(__('Restore')); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body full-card">
                                <div class="img-fluid rounded-circle card-avatar">

                                    <span class="nk-file-icon-type">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                                            <g>
                                                <rect x="32" y="16" width="28" height="15" rx="2.5" ry="2.5" style="fill:#f29611" />
                                                <path d="M59.7778,61H12.2222A6.4215,6.4215,0,0,1,6,54.3962V17.6038A6.4215,6.4215,0,0,1,12.2222,11H30.6977a4.6714,4.6714,0,0,1,4.1128,2.5644L38,24H59.7778A5.91,5.91,0,0,1,66,30V54.3962A6.4215,6.4215,0,0,1,59.7778,61Z" style="fill:#ffb32c" />
                                                <path d="M8.015,59c2.169,2.3827,4.6976,2.0161,6.195,2H58.7806a6.2768,6.2768,0,0,0,5.2061-2Z" style="fill:#f2a222" />
                                            </g>
                                        </svg>
                                    </span>
                                    <h6 class=" mt-4 text-primary"><?php echo e($folder->folder_name); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div align="center" id="norecord"><img style="margin-left:;"  width="100" src="https://img.freepik.com/free-vector/
                        no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                        alt="No results found" >
                        <p class="mt-2 text-danger">No folders created!</p>
                    </div>
                <?php endif; ?>
                <?php echo e($folders->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/filemanagement/folders.blade.php ENDPATH**/ ?>