<?php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage User')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Client')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if(\Auth::user()->type == 'super admin' || \Auth::user()->type == 'HR'): ?>
            <a href="<?php echo e(route('user.userlog')); ?>" class="btn btn-primary btn-sm <?php echo e(Request::segment(1) == 'user'); ?>"
               data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('User Logs History')); ?>"><i class="ti ti-user-check"></i>
            </a>
            <a href="#" class="btn btn-primary btn-sm <?php echo e(Request::segment(1) == 'user'); ?>" id="uploadUser"
             data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#uploadUsers" title="<?php echo e(__('Upload users')); ?>"><i class="ti ti-upload"></i>
         </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create user')): ?>
        <!--  -->
            <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#newUser" id="toggleOldUser"  data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<div>
    <div class="row">
        <div class="col-xl-12">

            <div class="card mt-4">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('SN')); ?></th>
                                    <th><?php echo e(__('Staff Name')); ?></th>
                                    <th><?php echo e(__('Branch')); ?></th>
                                    <th><?php echo e(__('Department')); ?></th>
                                    <th><?php echo e(__('Unit')); ?></th>
                                    <th><?php echo e(__('Role')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if(count($users)>0): ?>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e($user->location_type); ?></td>
                                            <td><?php if($user->department): ?><?php echo e($user->department->name ? : '-'); ?> <?php else: ?> - <?php endif; ?></td>
                                            <td><?php if($user->unit): ?><?php echo e($user->unit->name ? : '-'); ?> <?php else: ?> - <?php endif; ?></td>
                                            <td>
                                                <?php if($user->type=='client'): ?>
                                                    HR
                                                <?php else: ?>
                                                <?php echo e($user->type); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="card-header-right">
                                                    <div class="btn-group card-option">
                                                        <button type="button" class="btn dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit user')): ?>
                                                                <a href="" wire:click="selUser(<?php echo e($user->id); ?>)" data-bs-toggle="modal" data-bs-target="#editUser" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                                                    <i class="ti ti-pencil"></i>
                                                                    <span><?php echo e(__('Edit')); ?></span>
                                                                </a>
                                                                <a href="<?php echo e(route('user.permission',$user->id)); ?>" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit Permission')); ?>">
                                                                    <i class="ti ti-pencil"></i>
                                                                    <span><?php echo e(__('Edit Permission')); ?></span>
                                                                </a>
                                                            <?php endif; ?>

                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete user')): ?>
                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user['id']],'id'=>'delete-form-'.$user['id']]); ?>

                                                                <a href="#!"  class="dropdown-item bs-pass-para">
                                                                    <i class="ti ti-archive"></i>
                                                                    <span> <?php if($user->delete_status!=0): ?><?php echo e(__('Delete')); ?> <?php else: ?> <?php echo e(__('Restore')); ?><?php endif; ?></span>
                                                                </a>

                                                                <?php echo Form::close(); ?>

                                                            <?php endif; ?>
                                                            <a href="#!" data-url="<?php echo e(route('users.reset',\Crypt::encrypt($user->id))); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Reset Password')); ?>">
                                                                <i class="ti ti-adjustments"></i>
                                                                <span>  <?php echo e(__('Reset Password')); ?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <th scope="col" colspan="9">
                                            <h6 class="text-center"><?php echo e(__('No Record Found.')); ?></h6>
                                        </th>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="paginate"><?php echo e($users->links('pagination::bootstrap-5')); ?></div>
                </div>
            </div>
        </div>
    </div>

    
    <?php echo $__env->make('user.upload-users', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('livewire.users.modals.edit-user-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('livewire.users.modals.new-user-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
</div>
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/users/users-component.blade.php ENDPATH**/ ?>