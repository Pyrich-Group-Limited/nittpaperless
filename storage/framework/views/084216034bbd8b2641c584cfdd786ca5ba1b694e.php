<div id="publishAdvert">
    <div class="modal" id="publishAdvertModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Project Advert Publish
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <?php if($project): ?>
                                <div class="form-group col-md-12">
                                    <label for="type_of_advert" class="form-label">Type of Advert</label>
                                    <select wire:model="type_of_advert" id="type_of_advert" class="form-control">
                                        <option value="" selected>-- Select Type of Advert --</option>
                                        <option value="Internal">Internal</option>
                                        <option value="External">External</option>
                                    </select>
                                    <?php $__errorArgs = ['type_of_advert'];
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php echo e(Form::label('name', __('Project Name'), ['class' => 'form-label'])); ?>

                                        <input type="text" id="project_name" disabled value="<?php echo e($project->project_name); ?>"
                                            class="form-control" placeholder="Project Name" />
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
                                <div class="mb-3" >
                                    <label class="form-label" for="description">Blog Description</label>
                                    <div wire:ignore>
                                        <textarea id="message" wire:model="ad_description" class="form-control tinymce-basic" name="description"></textarea>
                                    </div>
                                    <?php $__errorArgs = ['ad_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

                                        <input type="date" id="start_date" wire:model.defer="ad_start_date"
                                            class="form-control" placeholder="Project Start Date" />
                                        <?php $__errorArgs = ['ad_start_date'];
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
                                        <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

                                        <input type="date" id="end_date" wire:model.defer="ad_end_date"
                                            class="form-control" placeholder="Project End Date" />
                                        <?php $__errorArgs = ['ad_end_date'];
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
                            <?php else: ?>
                                <label align="center">Loading...</label>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" id="closeAdvertiseProject" value="<?php echo e(__('Cancel')); ?>"
                            class="btn  btn-light" data-bs-dismiss="modal">
                        <input type="button" wire:click="advertiseProject" value="<?php echo e(__('Publish Advert')); ?>"
                            class="btn  btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeAdvertiseProject").click();
        })
    </script>

</div>
<?php $__env->startPush('script'); ?>
        <script>
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
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/livewire/physical-planning/projects/modals/new-advert.blade.php ENDPATH**/ ?>