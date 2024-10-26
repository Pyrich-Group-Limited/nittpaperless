<div>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Shared Project Comments')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e($project->projectId); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end d-flex align-items-center">
        
        <a href="<?php echo e(route('dg.projectApplicants',$project->id)); ?>"  target="_blank" class="btn btn-sm btn-primary btn-icon m-1" >
            <i class="ti ti-arrow-left text-white" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Back')); ?>"> </i> Back
        </a>
    </div>
<?php $__env->stopSection(); ?>


    <div class="row">
        
        <div class="col-xl-12">
            <div id="useradd-1">
                <div class="row">
                    <div class="col-xxl-5">
                        <div class="card report_card total_amount_card">
                            <div class="card-body pt-0" style="margin-bottom: -30px; margin-top: -10px;">
                                <address class="mb-0 text-sm">
                                    <dl class="row mt-4 align-items-center">
                                        <h5><?php echo e(__('Shared Project Detail')); ?> (<?php echo e($project->projectId); ?>)</h5>
                                        <br>
                                        <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Project Title')); ?></dt>
                                        <dd class="col-sm-8 text-sm"><?php echo e($project->project_name); ?></dd>
                                        <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Description')); ?></dt>
                                        <dd class="col-sm-8 text-sm"><?php echo e($project->description); ?></dd>
                                        <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Value')); ?></dt>
                                        <dd class="col-sm-8 text-sm"> <?php echo e(\Auth::user()->priceFormat($project->budget)); ?></dd>
                                        <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Project Category')); ?></dt>
                                        <dd class="col-sm-8 text-sm"><?php echo e($project->category->category_name); ?></dd>
                                        <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Status')); ?></dt>
                                        <dd class="col-sm-8 text-sm"><?php echo e($project->status); ?></dd>
                                        <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Start Date')); ?></dt>
                                        <dd class="col-sm-8 text-sm"><?php echo e(Auth::user()->dateFormat($project->start_date)); ?></dd>
                                        <dt class="col-sm-4 h6 text-sm"><?php echo e(__('End Date')); ?></dt>
                                        <dd class="col-sm-8 text-sm"><?php echo e(Auth::user()->dateFormat($project->end_date)); ?></dd>
                                    </dl>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id ="useradd-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><?php echo e(__('Comments')); ?></h5>
                    </div>
                    <div class="card-body">
                            
                        <div class="list-group list-group-flush mb-0" id="comments">
                            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $logo=\App\Models\Utility::get_file('uploads/avatar/');
                                ?>
                                <div class="list-group-item ">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <a href="<?php echo e(!empty($user->avatar) ? $logo . '/' . $user->avatar : $logo . '/user.png'); ?>" target="_blank">
                                                <img class="rounded-circle"  width="40" height="40" src="<?php echo e(asset('uploads/user.png')); ?>">
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                        </div>
                                        <div class="col ml-n2">
                                            <p class="d-block h4 text-sm font-weight-light mb-0 text-break"><?php echo e($comment->user->name); ?> (<?php echo e($comment->user->type .' - '. $comment->user->department->name); ?>)</p>
                                            <p class="d-block text-sm mb-0 text-break"><?php echo e($comment->content); ?></p>
                                            <small class="d-block"><?php echo e($comment->created_at->diffForHumans()); ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </div>


</div>
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/d-g/view-hods-comment-component.blade.php ENDPATH**/ ?>