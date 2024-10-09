<div id="uploadBOQ">
    <div class="modal" id="uploadBOQModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Project Bill of Quantity Upload
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('name', __('Project Name'), ['class' => 'form-label'])); ?>

                                    <input type="text" id="project_name" disabled wire:model.defer="project_name" class="form-control"
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
                                    <?php echo e(Form::label('boq_file', __('File Upload'), ['class' => 'form-label'])); ?>

                                    <input type="date" id="boq_file" wire:model.defer="boq_file" class="form-control"
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
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" id="closeAdvertPublishModal" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" wire:click="registerUser" value="<?php echo e(__('Publish Advert')); ?>" class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('script'); ?>
        <?php if($errors->any() || Session::has('error')): ?>
            <script>
                $(document).ready(function() {
                    document.getElementById("toggleOldUser").click();
                });
            </script>
        <?php endif; ?>
    <?php $__env->stopPush(); ?>

</div>
<?php $__env->startPush('script'); ?>
    <script src="https://cdn.tiny.cloud/1/cvjfkxqlo8ylwqn3xgo15h2bd4xl6n7m6k5d0avjcq93c1i7/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#description',
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
                editor.on('change', function(e) {
                    window.livewire.find('<?php echo e($_instance->id); ?>').set('description', editor.getContent());
                });
            }
        });


        window.addEventListener('feedback', event => {
            tinyMCE.activeEditor.setContent("");
        });
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