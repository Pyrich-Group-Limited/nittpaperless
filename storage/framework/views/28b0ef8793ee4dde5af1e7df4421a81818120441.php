<div id="createUser">
    <div class="modal" id="shareProjectDetails" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">Share Project Details with HoDs</h5>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="shareProjectDetails">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12" wire:ignore>
                                        <div class="form-group" >
                                            <label for="">Share with: (<span class="text-xs text-muted"><?php echo e(__('You can select one or more users to share file with')); ?></span>) </label>
                                            <select wire:model="selectedHods" id="choices-multiple1" class="form-control sel_users select2" multiple>
                                                <?php if(is_array($users) || is_object($users)): ?>
                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?> &nbsp; (<?php echo e($user->type); ?>)</option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php $__errorArgs = ['selectedHods'];
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
                                <div wire:loading wire:target="shareProjectDetails"><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
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
                                <input type="button" id="closeModal" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
                                <input type="submit" value="<?php echo e(__('Share')); ?>" class="btn  btn-primary">
                            </div>
                        </form>
                </div>
            </div>
        </div>

    </div>

    <?php $__env->startPush('script'); ?>
        <script>
            $(document).ready(function(){
                $('.sel_users').select2();
            }).on('change', function(){
                var data = $('.sel_users').val();
                window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedHods',data);
            });

            window.addEventListener('print',event => {
                document.getElementById("print").click();
            });
        </script>
    <?php $__env->stopPush(); ?>
</div>
<script>
    window.addEventListener('success', event => {
        document.getElementById("closeModal").click();
    })
</script>



<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/d-g/modals/share-project.blade.php ENDPATH**/ ?>