<div>
    
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Shared Project Detail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    
    <script>
        // <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage contract')): ?>
        $('.summernote-simple').on('summernote.blur', function () {

            $.ajax({
                url: "<?php echo e(route('contract.contract_description.store',$project->id)); ?>",
                data: {_token: $('meta[name="csrf-token"]').attr('content'), contract_description: $(this).val()},
                type: 'POST',
                success: function (response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success,'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function (response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });
        // <?php else: ?>
        // $('.summernote-simple').summernote('disable');
        // <?php endif; ?>
    </script>
    


    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e($project->projectId); ?></li>
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
                            <div class="col-12 d-flex">
                                <div class="form-group mb-0 w-100">
                                    <form wire:submit.prevent="addComment">
                                        <textarea rows="1" class="form-control" wire:model="commentText" placeholder="<?php echo e(__('Add a comment...')); ?>"></textarea>
                                        <?php $__errorArgs = ['commentText'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </form>
                                </div>
                                <div wire:loading wire:target="addComment"><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.g-loader','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('g-loader'); ?>
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
<?php endif; ?></div>
                                <button type="submit" wire:click="addComment" class="btn btn-primary btn-sm">Comment</button>
                                
                            </div>
                        <div class="list-group list-group-flush mb-0" id="comments">
                            <?php $__currentLoopData = $project->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $user = \App\Models\User::find($comment->user_id);
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
                                        <?php if($comment->user_id===Auth::user()->id): ?>
                                            <div class="col-auto actions">
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['comment_store.destroy',  $comment->id]]); ?>

                                                    <a href="#!" class="mx-3 btn btn-sm  align-items-center bs-pass-para">
                                                        <i class="ti ti-trash text-white" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Delete')); ?>"></i>
                                                    </a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            </div>
                                        <?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/projects/shared-project-details-component.blade.php ENDPATH**/ ?>