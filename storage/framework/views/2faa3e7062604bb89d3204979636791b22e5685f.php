<div>
    <?php $__env->startSection('page-title'); ?>
        <?php echo e(ucwords($project->project_name)); ?>

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
        <li class="breadcrumb-item"><a href="<?php echo e(route('projects.index')); ?>"><?php echo e(__('Project')); ?></a></li>
        <li class="breadcrumb-item"><?php echo e(ucwords($project->project_name)); ?></li>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('action-btn'); ?>
        <div class="float-end">

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#publishAdvertModal" id="toggleOldProject"
                    data-bs-toggle="tooltip" title="<?php echo e(__('Advertise Project')); ?>" class="btn btn-sm btn-primary">
                    <i class="ti ti-share"></i>
                </a>

                <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#editProject" id="toggleOldProject"
                    data-bs-toggle="tooltip" title="<?php echo e(__('Modify Project')); ?>" class="btn btn-sm btn-primary">
                    <i class="ti ti-pencil text-white"></i>
                </a>
            <?php endif; ?>


        </div>
    <?php $__env->stopSection(); ?>

    <div class="row">

        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-danger">
                                    <i class="ti ti-report-money"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Budget')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e(\Auth::user()->priceFormat($project->budget)); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(Auth::user()->type != 'client'): ?>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mb-3 mb-sm-0">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-report-money"></i>
                                    </div>
                                    <div class="ms-3">
                                        <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                        <h6 class="m-0"><?php echo e(__('Expense')); ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto text-end">
                                <h4 class="m-0"><?php echo e(\Auth::user()->priceFormat($project_data['expense']['total'])); ?>

                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-lg-4 col-md-6"></div>
        <?php endif; ?>
        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3">
                            <img <?php echo e($project->img_image); ?> alt="" class="img-user wid-45 rounded-circle">
                        </div>
                        <div class="d-block  align-items-center justify-content-between w-100">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="mb-1"> <?php echo e($project->project_name); ?></h5>
                                <p class="mb-0 text-sm">
                                <div class="progress-wrapper">
                                    <span class="progress-percentage"><small
                                            class="font-weight-bold"><?php echo e(__('Completed:')); ?> :
                                        </small><?php echo e($project->project_progress()['percentage']); ?></span>
                                    <div class="progress progress-xs mt-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            aria-valuenow="<?php echo e($project->project_progress()['percentage']); ?>"
                                            aria-valuemin="0" aria-valuemax="100"
                                            style="width: <?php echo e($project->project_progress()['percentage']); ?>;"></div>
                                    </div>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="mt-3 mb-1"></h4>
                            <p> <?php echo $project->description; ?></p>
                        </div>
                    </div>
                    <div class="card bg-primary mb-0">
                        <div class="card-body">
                            <div class="d-block d-sm-flex align-items-center justify-content-between">
                                <div class="row align-items-center">
                                    <span class="text-white text-sm"><?php echo e(__('Start Date')); ?></span>
                                    <h5 class="text-white text-nowrap">
                                        <?php echo e(Utility::getDateFormated($project->start_date)); ?></h5>
                                </div>
                                <div class="row align-items-center">
                                    <span class="text-white text-sm"><?php echo e(__('End Date')); ?></span>
                                    <h5 class="text-white text-nowrap">
                                        <?php echo e(Utility::getDateFormated($project->end_date)); ?></h5>
                                </div>

                            </div>
                            <div class="row">
                                <span class="text-white text-sm"><?php echo e(__('Client')); ?></span>
                                <h5 class="text-white text-nowrap">
                                    <?php echo e(!empty($project->client) ? $project->client->name : '-'); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5><?php echo e(__('Bill of Quantity')); ?></h5>
                        <div class="float-end">
                            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#viewBOQModal"
                                id="toggleUploadBOQ" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                class="btn btn-sm btn-primary">
                                <i class="ti ti-eye"></i>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php if(count($project->boqs) > 0): ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('SN')); ?></th>
                                            <th><?php echo e(__('Item')); ?></th>
                                            <th><?php echo e(__('Unit Price')); ?></th>
                                            <th><?php echo e(__('QTY')); ?></th>
                                            <th><?php echo e(__('Total')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $project->boqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $boq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $totalSum = $totalSum + $boq->quantity * $boq->unit_price;
                                            ?>
                                            <tr>
                                                <td>
                                                    <p><?php echo e($key + 1); ?></p>
                                                </td>
                                                <td>
                                                    <p><?php echo e($boq->description); ?></p>
                                                </td>
                                                <td>
                                                    <p><?php echo e(number_format($boq->unit_price)); ?></p>
                                                </td>
                                                <td>
                                                    <p><?php echo e($boq->quantity); ?></p>
                                                </td>
                                                <td>
                                                    <p><?php echo e(number_format($boq->quantity * $boq->unit_price)); ?></p>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td> </td>
                                            <td> </td>
                                            <td></td>
                                            <td><b>TOTAL</b></td>
                                            <td> <b><?php echo e(number_format($totalSum)); ?></b> </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="py-5">
                                <h6 class="h6 text-center"><?php echo e(__('No Bill of Quantity Uploaded yet!')); ?></h6>
                            </div>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5><?php echo e(__('Members')); ?></h5>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                            <div class="float-end">
                                <a href="#" data-size="lg"
                                    data-url="<?php echo e(route('invite.project.member.view', $project->id)); ?>"
                                    data-ajax-popup="true" data-bs-toggle="tooltip" title=""
                                    class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Add Member')); ?>">
                                    <i class="ti ti-plus"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush list" id="project_users">
                        <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-sm-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar rounded-circle avatar-sm me-3">
                                                
                                                <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/' . $user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('uploads/user.png')); ?>" <?php endif; ?>
                                                    alt="image">

                                            </div>
                                            <div class="div">
                                                <h5 class="m-0"><?php echo e($user->name); ?></h5>
                                                <small class="text-muted"><?php echo e($user->email); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto text-sm-end d-flex align-items-center">
                                        <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['projects.user.destroy', [$project->id, $user->id]]]); ?>

                                            <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i
                                                    class="ti ti-trash text-white"></i></a>

                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5><?php echo e(__('Attachements')); ?></h5>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php if($project->project_boq != null): ?>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="div">
                                                <h6 class="m-0"><?php echo e($project->project_name); ?> Bill of Quantity</h6>
                                                <small class="text-muted"><?php echo e($project->file_size); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-sm-end d-flex align-items-center">
                                        <div class="action-btn bg-info ms-2">
                                            <a href="<?php echo e(asset(Storage::url('tasks/' . $project->file))); ?>"
                                                data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>"
                                                class="btn btn-sm" download>
                                                <i class="ti ti-download text-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php else: ?>
                            <div class="py-5">
                                <h6 class="h6 text-center"><?php echo e(__('No Milestone Found.')); ?></h6>
                            </div>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('livewire.projects.modals.edit-project', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('livewire.physical-planning.projects.modals.new-advert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('livewire.physical-planning.projects.modals.view-boq', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php $__env->startPush('script'); ?>
        <script src="https://cdn.tiny.cloud/1/cvjfkxqlo8ylwqn3xgo15h2bd4xl6n7m6k5d0avjcq93c1i7/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#message',
                setup: function(editor) {
                    editor.on('init change', function() {
                        editor.save();
                    });
                    editor.on('change', function(e) {
                        window.livewire.find('<?php echo e($_instance->id); ?>').set('description', editor.getContent());
                    });
                }
            });
        </script>
    <?php $__env->stopPush(); ?>
</div>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/livewire/projects/show-project-component.blade.php ENDPATH**/ ?>