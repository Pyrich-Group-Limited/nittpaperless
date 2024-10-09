<div id="uploadBOQ">
    <div class="modal" id="uploadBOQModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Project Bill of Quantity Upload
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <?php if($selProject): ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo e(Form::label('name', __('Project Name'), ['class' => 'form-label'])); ?>

                                    <input type="text" id="project_name" value="<?php echo e($selProject->project_name); ?>" disabled  class="form-control"
                                        placeholder="Project Name" />
                                    <?php $__errorArgs = ['project_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('bduget', __('Estimated Budget'), ['class' => 'form-label'])); ?>

                                    <input type="text" id="boq_file" wire:model.defer="budget" class="form-control"
                                        placeholder="Estimated Budget" />
                                    <?php $__errorArgs = ['boq_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('boq_file', __('File Upload'), ['class' => 'form-label'])); ?>

                                    <input type="file" id="boq_file" wire:model.defer="boq_file" class="form-control"
                                        placeholder="File" />
                                       <strong class="text-danger" wire:loading wire:target="boq_file">Loading...</strong>
                                    <?php $__errorArgs = ['boq_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="invalid-name" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <input type="text" <?php $__errorArgs = ['inputs.'.$key.'.item'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> style="border-color: red" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> id="input_<?php echo e($key); ?>_item" id="input_<?php echo e($key); ?>_item" placeholder="Item" wire:model.defer="inputs.<?php echo e($key); ?>.item" class="form-control" />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" <?php $__errorArgs = ['inputs.'.$key.'.description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> style="border-color: red" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> id="input_<?php echo e($key); ?>_description" id="input_<?php echo e($key); ?>_description" placeholder="Description" wire:model.defer="inputs.<?php echo e($key); ?>.description" class="form-control" />
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text"  <?php $__errorArgs = ['inputs.'.$key.'.unit_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> style="border-color: red" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> id="input_<?php echo e($key); ?>_unit_price" id="input_<?php echo e($key); ?>_unit_price" placeholder="Unit Price" wire:model.defer="inputs.<?php echo e($key); ?>.unit_price" class="form-control" />
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" <?php $__errorArgs = ['inputs.'.$key.'.quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> style="border-color: red" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> id="input_<?php echo e($key); ?>_quantity" id="input_<?php echo e($key); ?>_quantity" placeholder="Quantity" wire:model.defer="inputs.<?php echo e($key); ?>.quantity" class="form-control" />
                                    </div>
                                    <div class="col-md-1">
                                        <?php if($key > 0): ?>
                                        <a href="#" wire:click="removeInput(<?php echo e($key); ?>)"  data-bs-toggle="tooltip" title="<?php echo e(__('Add Field')); ?>" class="btn btn-sm btn-danger mt-1">
                                           X
                                        </a>
                                        <?php endif; ?>
                                    </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <a href="#" wire:click="addInput"  data-bs-toggle="tooltip" title="<?php echo e(__('Add Field')); ?>" class="btn btn-sm btn-primary mt-3">
                                <i class="ti ti-plus"></i>
                            </a>

                            <?php else: ?>
                            <label align="center" class="mb-4" style="color: red">Loading...</label>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" id="closeUplaodBOQ" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="uploadBOQ" value="<?php echo e(__('Uplaod Bill of Quantity')); ?>" class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('script'); ?>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeUplaodBOQ").click();
    })
</script>
<?php $__env->stopPush(); ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.toast-notification','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('toast-notification'); ?>
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
<?php endif; ?>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/livewire/physical-planning/projects/uploadboq.blade.php ENDPATH**/ ?>