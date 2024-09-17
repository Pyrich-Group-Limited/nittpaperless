<?php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Files')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Files')); ?></li>
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
                                        <a href="#!" data-size="lg" data-url="<?php echo e(route('file.upload')); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Upload File')); ?>">
                                            <i class="ti ti-upload"></i>
                                            <span><?php echo e(__('Upload File')); ?></span>
                                        </a>
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
                                            <a href="#!" data-size="lg" data-url="" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                                <i class="ti ti-pencil"></i>
                                                <span><?php echo e(__('Edit')); ?></span>
                                            </a>
                                            <a href="#!"  class="dropdown-item bs-pass-para">
                                                <i class="ti ti-archive"></i>
                                                <span> <?php echo e(__('Delete')); ?></span>
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
                                    <h6 class=" mt-4 text-primary">Folder 1</h6>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <a href="#!" data-size="lg" data-url="" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                                <i class="ti ti-pencil"></i>
                                                <span><?php echo e(__('Edit')); ?></span>
                                            </a>
                                            <a href="#!"  class="dropdown-item bs-pass-para">
                                                <i class="ti ti-archive"></i>
                                                <span> <?php echo e(__('Delete')); ?> </span>
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
                                    <h6 class=" mt-4 text-primary">Folder 2</h6>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <a href="#!" data-size="lg" data-url="" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                                <i class="ti ti-pencil"></i>
                                                <span><?php echo e(__('Edit')); ?></span>
                                            </a>
                                            <a href="#!"  class="dropdown-item bs-pass-para">
                                                <i class="ti ti-archive"></i>
                                                <span> <?php echo e(__('Delete')); ?> </span>
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
                                                <rect x="18" y="16" width="36" height="40" rx="5" ry="5" style="fill:#e3edfc" />
                                                <path d="M19.03,54A4.9835,4.9835,0,0,0,23,56H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />
                                                <rect x="32" y="20" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                                <rect x="32" y="25" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                                <rect x="32" y="30" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                                <rect x="32" y="35" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                                <path d="M35,16.0594h2a0,0,0,0,1,0,0V41a1,1,0,0,1-1,1h0a1,1,0,0,1-1-1V16.0594A0,0,0,0,1,35,16.0594Z" style="fill:#7e95c4" />
                                                <path d="M38.0024,40H33.9976A1.9976,1.9976,0,0,0,32,41.9976v2.0047A1.9976,1.9976,0,0,0,33.9976,46h4.0047A1.9976,1.9976,0,0,0,40,44.0024V41.9976A1.9976,1.9976,0,0,0,38.0024,40Zm-.0053,4H34V42h4Z" style="fill:#7e95c4" />
                                            </g>
                                        </svg>
                                    </span>
                                    <h6 class=" mt-4 text-primary">work.zip</h6>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <a href="#!" data-size="lg" data-url="" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                                <i class="ti ti-pencil"></i>
                                                <span><?php echo e(__('Edit')); ?></span>
                                            </a>
                                            <a href="#!"  class="dropdown-item bs-pass-para">
                                                <i class="ti ti-archive"></i>
                                                <span> <?php echo e(__('Delete')); ?> </span>
                                            </a>
                                            <a href="#!"  class="dropdown-item bs-pass-para">
                                                <i class="ti ti-archive"></i>
                                                <span><?php echo e(__('Restore')); ?> </span>
                                            </a>
                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body full-card">
                                <div class="img-fluid rounded-circle card-avatar">

                                    <span class="nk-file-icon-type">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                                            <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />
                                            <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />
                                            <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />
                                            <path d="M42,31H30a3.0033,3.0033,0,0,0-3,3V45a3.0033,3.0033,0,0,0,3,3H42a3.0033,3.0033,0,0,0,3-3V34A3.0033,3.0033,0,0,0,42,31ZM29,38h6v3H29Zm8,0h6v3H37Zm6-4v2H37V33h5A1.001,1.001,0,0,1,43,34ZM30,33h5v3H29V34A1.001,1.001,0,0,1,30,33ZM29,45V43h6v3H30A1.001,1.001,0,0,1,29,45Zm13,1H37V43h6v2A1.001,1.001,0,0,1,42,46Z" style="fill:#36c684" />
                                        </svg>
                                    </span>
                                    <h6 class=" mt-4 text-primary">Reports.xlsx</h6>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <a href="#!" data-size="lg" data-url="" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                                <i class="ti ti-pencil"></i>
                                                <span><?php echo e(__('Edit')); ?></span>
                                            </a>
                                            <a href="#!"  class="dropdown-item bs-pass-para">
                                                <i class="ti ti-archive"></i>
                                                <span> <?php echo e(__('Delete')); ?> </span>
                                            </a>
                                            <a href="#!"  class="dropdown-item bs-pass-para">
                                                <i class="ti ti-archive"></i>
                                                <span><?php echo e(__('Restore')); ?> </span>
                                            </a>
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
                                    <h6 class=" mt-4 text-primary">Quotation.doc</h6>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <a href="#!" data-size="lg" data-url="" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                                <i class="ti ti-pencil"></i>
                                                <span><?php echo e(__('Edit')); ?></span>
                                            </a>
                                            <a href="#!"  class="dropdown-item bs-pass-para">
                                                <i class="ti ti-archive"></i>
                                                <span> <?php echo e(__('Delete')); ?> </span>
                                            </a>
                                            <a href="#!"  class="dropdown-item bs-pass-para">
                                                <i class="ti ti-archive"></i>
                                                <span><?php echo e(__('Restore')); ?> </span>
                                            </a>
                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body full-card">
                                <div class="img-fluid rounded-circle card-avatar">
                                    <span class="nk-file-icon-type">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                                            <path d="M49,61H23a5.0147,5.0147,0,0,1-5-5V16a5.0147,5.0147,0,0,1,5-5H40.9091L54,22.1111V56A5.0147,5.0147,0,0,1,49,61Z" style="fill:#e3edfc" />
                                            <path d="M54,22.1111H44.1818a3.3034,3.3034,0,0,1-3.2727-3.3333V11s1.8409.2083,6.9545,4.5833C52.8409,20.0972,54,22.1111,54,22.1111Z" style="fill:#b7d0ea" />
                                            <path d="M19.03,59A4.9835,4.9835,0,0,0,23,61H49a4.9835,4.9835,0,0,0,3.97-2Z" style="fill:#c4dbf2" />
                                            <rect x="27" y="31" width="18" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                            <rect x="27" y="35" width="18" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                            <rect x="27" y="39" width="18" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                            <rect x="27" y="43" width="14" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                            <rect x="27" y="47" width="8" height="2" rx="1" ry="1" style="fill:#7e95c4" />
                                        </svg>
                                    </span>
                                    <h6 class=" mt-4 text-primary">work.txt</h6>
                                </div>
                            </div>
                        </div>
                    </div>


                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-server\htdocs\e-NITT\resources\views/filemanagement/index.blade.php ENDPATH**/ ?>