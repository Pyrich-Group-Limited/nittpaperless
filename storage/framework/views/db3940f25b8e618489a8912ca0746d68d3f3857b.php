<?php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Folder Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Folder Details')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="mt-2 " id="multiCollapseExample1">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-8">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="btn-box">
                                        <input type="text" class="form-control" placeholder="Search files, folder">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto mt-2">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti ti-plus"></i> <span>Create</span></a>
                                    <div class="dropdown-menu dropdown-menu-end">

                                        <a href="#!" data-size="lg" data-url="<?php echo e(route('file.create')); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Create File')); ?>">
                                            <i class="ti ti-file-plus"></i>
                                            <span><?php echo e(__('Create File')); ?></span>
                                        </a>
                                        <a href="#!" data-url="<?php echo e(route('folder.create')); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Create Folder')); ?>">
                                            <i class="ti ti-folder-plus"></i>
                                            <span>  <?php echo e(__('Create Folder')); ?></span>
                                        </a>
                                    </div>

                                    <a href="#" class="btn btn-primary btn-sm" data-url="<?php echo e(route('file.upload')); ?>" data-ajax-popup="true"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Upload Files')); ?>"><i class="ti ti-cloud-upload"></i> Upload
                                    </a>
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
                    <h4>
                        <i class="ti ti-folder"></i>
                        <?php echo e($folder->folder_name); ?>

                    </h4>

                    <?php if($folder->files->count() > 0): ?>
                        <?php $__currentLoopData = $folder->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                    <a href="#!" data-size="lg" data-url="<?php echo e(route('file.shareModal',$file->id)); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Share File')); ?>">
                                                        <i class="ti ti-share"></i>
                                                        <span><?php echo e(__('Share')); ?></span>
                                                    </a>
                                                    <a href="#!" data-url="<?php echo e(route('file.renameModal',$file->id)); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Rename File')); ?>">
                                                        <i class="ti ti-pencil"></i>
                                                        <span><?php echo e(__('Rename')); ?></span>
                                                    </a>
                                                    <a href="<?php echo e(route('files.download',$file->id)); ?>"  class="dropdown-item">
                                                        <i class="ti ti-download"></i>
                                                        <span> <?php echo e(__('Download')); ?> </span>
                                                    </a>
                                                    <form action="<?php echo e(route('files.archive', $file->id)); ?>" method="POST" style="display:inline;">
                                                        <?php echo csrf_field(); ?>
                                                        <button type="submit" class="btn btn-white dropdown-item"><i class="ti ti-archive"></i>Archive</button>
                                                    </form>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body full-card">
                                        <div class="img-fluid rounded-circle card-avatar">
                                            <span class="nk-file-icon-type">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                                                    <g>
                                                        <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />
                                                        <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />
                                                        <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />
                                                        <rect x="27" y="31" width="18" height="2" rx="1" ry="1" style="fill:#599def" />
                                                        <rect x="27" y="36" width="18" height="2" rx="1" ry="1" style="fill:#599def" />
                                                        <rect x="27" y="41" width="18" height="2" rx="1" ry="1" style="fill:#599def" />
                                                        <rect x="27" y="46" width="12" height="2" rx="1" ry="1" style="fill:#599def" />
                                                    </g>
                                                </svg>
                                            </span>
                                            <h6 class=" mt-4 text-primary"><?php echo e($file->file_name.'.'.$file = pathinfo(storage_path().$file->path, PATHINFO_EXTENSION)); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p>No files in this folder.</p>
                    <?php endif; ?>

                    <div class="pagination">
                        <?php echo e($files->links()); ?>

                    </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/nittpaperless/resources/views/filemanagement/show-folder.blade.php ENDPATH**/ ?>