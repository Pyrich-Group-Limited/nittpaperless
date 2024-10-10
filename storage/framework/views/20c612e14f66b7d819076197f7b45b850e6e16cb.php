<div id="createUser">
    <div class="modal" id="newProject" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Create Project</h5>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <?php echo e(Form::label('project_name', __('Project Name'), ['class' => 'form-label'])); ?><span class="text-danger">*</span>
                                    <input type="text" wire:model="project_name" class="form-control">
                                    <?php $__errorArgs = ['project_name'];
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
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <?php echo e(Form::label('description', __('Project Description'), ['class' => 'form-label'])); ?>

                                    
                                    <textarea wire:model="description" id="" cols="50" rows="4" class="form-control"></textarea>
                                    <?php $__errorArgs = ['description'];
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
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

                                    
                                    <input type="date" class="form-control" wire:model.defer="start_date">
                                    <?php $__errorArgs = ['start_date'];
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
                                    <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

                                    
                                    <input type="date" class="form-control" wire:model.defer="end_date">
                                    <?php $__errorArgs = ['end_date'];
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
                        <!-- <div class="row"> -->
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <?php echo e(Form::label('category', __('Project Category'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                    <select wire:model="project_category_id" id="" class="form-control">
                                        <option value="">---Select---</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__errorArgs = ['project_category_id'];
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
                                    </select>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6" wire:ignore>
                                <div class="form-group">
                                    <?php echo e(Form::label('selectedStaff', __('Supervising Staff'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                    <select wire:model="selectedStaff" id="choices-multiple1" class="form-control sel_users select2 " multiple>
                                    
                                        <option value="">---Select---</option>
                                        <?php if(is_array($users) || is_object($users)): ?>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <?php $__errorArgs = ['selectedStaff'];
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
                                    <?php echo e(Form::label('budget', __('Budget'), ['class' => 'form-label'])); ?>

                                    <input type="number" wire:model="budget" class="form-control">
                                    <?php $__errorArgs = ['budget'];
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
                        

                        

                    </div>

                    <div class="modal-footer">
                        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light"
                            data-bs-dismiss="modal">
                        <input type="button" id="button" wire:click="createProject" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('script'); ?>
        <script>    
            $(document).ready(function(){
                $('.sel_users').select2();
            }).on('change', function(){
                var data = $('.sel_users').select2("val");
                window.livewire.find('<?php echo e($_instance->id); ?>').set('byproduct',data);
            });

            window.addEventListener('print',event => {
                document.getElementById("print").click();
            });
        </script>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('script'); ?>
    <script>
         $('#button').submit(function(e) {
                e.preventDefault();
                // Coding
                $('#newProject').modal('toggle'); //or  $('#IDModal').modal('hide');
                return false;
            });
    </script>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('script'); ?>
        <?php if($errors->any() || Session::has('error')): ?>
            <script>
                $(document).ready(function() {
                    document.getElementById("toggleOldProject").click();
                });
            </script>
        <?php endif; ?>
    <?php $__env->stopPush(); ?>

</div>
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
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/livewire/projects/modals/create-project.blade.php ENDPATH**/ ?>