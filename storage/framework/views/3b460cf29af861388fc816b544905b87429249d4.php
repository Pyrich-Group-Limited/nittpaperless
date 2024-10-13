<div id="createUser">
    <div class="modal" id="AddErgpModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Add ERGP</h5>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('code', __('ERGP Code'), ['class' => 'form-label'])); ?><span
                                        class="text-danger">*</span>
                                    <input type="text" wire:model="code" class="form-control">
                                    <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('title', __('ERGP Title'), ['class' => 'form-label'])); ?><span
                                        class="text-danger">*</span>
                                    <input type="text" wire:model="title" class="form-control">
                                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="invalid-type_of_leave" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <?php echo e(Form::label('value', __('ERGP Value'), ['class' => 'form-label'])); ?><span
                                    class="text-danger">*</span>
                                <input type="number" wire:model="value" class="form-control">
                                <?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <?php echo e(Form::label('ergp_year', __('ERGP Year'), ['class' => 'form-label'])); ?>

                                <input type="month" class="form-control" wire:model="ergp_year">
                                <?php $__errorArgs = ['ergp_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <?php echo e(Form::label('projectCat', __('Project Category'), ['class' => 'form-label'])); ?>

                                <select name="" id="" class="form-control" wire:model="projectCat">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $projectCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($projectCat->id); ?>"><?php echo e($projectCat->category_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['projectCat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="invalid-type_of_leave" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <input type="button" id="closeAddErgpModal" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="createProject" value="<?php echo e(__('Save')); ?>"
                            class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeAddErgpModal").click();
    })
</script>

<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/physical-planning/projects/modals/add-ergp.blade.php ENDPATH**/ ?>