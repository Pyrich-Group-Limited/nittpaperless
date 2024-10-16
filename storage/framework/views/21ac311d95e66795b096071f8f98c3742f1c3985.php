<div id="viewBOQ">
    <div class="modal" id="viewBOQModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">BILL OF QUANTITY FOR  <?php echo e(strtoupper($project->project_name)); ?>

                        </h5>
                    </div>
                    <div class="modal-body">
                        <?php if($project): ?>
                            <div class="row">
                                <?php if(count($project->boqs)>0): ?>
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
                                                $totalSum = $totalSum + ($boq->quantity * $boq->unit_price);
                                            ?>
                                                <tr>
                                                    <td> <p><?php echo e($key+1); ?></p> </td>
                                                    <td> <p><?php echo e($boq->description); ?></p> </td>
                                                    <td> <p><?php echo e(number_format($boq->unit_price)); ?></p> </td>
                                                    <td> <p><?php echo e($boq->quantity); ?></p> </td>
                                                    <td> <p><?php echo e(number_format($boq->quantity * $boq->unit_price)); ?></p> </td>
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
                            </div>
                            <div class="modal-footer">
                                <input type="button" id="closeAdvertPublishModal" value="<?php echo e(__('Close')); ?>"
                                    class="btn  btn-light" data-bs-dismiss="modal">
                            </div>
                        <?php else: ?>
                            <label align="center" class="mb-4" style="color: red">Loading...</label>
                        <?php endif; ?>
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
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/livewire/physical-planning/projects/modals/view-boq.blade.php ENDPATH**/ ?>