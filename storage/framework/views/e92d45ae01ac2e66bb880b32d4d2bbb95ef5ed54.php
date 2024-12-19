<div class="modal" id="raisememo" tabindex="-1" role="dialog" wire:ignore>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="raisememo">Raise a Memo
                </h5>
            </div>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="modal-body">
                <form action="<?php echo e(route('memos.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Memo Title</label>
                                <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="form-control">
                                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-password" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Memo Priority</label>
                                <select name="priority" id="" class="form-control">
                                    <option value="0">Low</option>
                                    <option value="1">Medium</option>
                                    <option value="2">High</option>
                                    <option value="3">Critical</option>
                                </select>
                                <?php $__errorArgs = ['priority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-password" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Memo Description</label>
                                <textarea name="description" value="<?php echo e(old('description')); ?>" class="form-control" cols="30"></textarea>
                                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-password" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content_type" class="form-label"><b>Memo Content Type</b></label>
                            <div>
                                <input type="radio" name="content_type" value="typed" id="typed_content" checked>
                                <label for="typed_content">Type Memo Content</label>
                                &nbsp; &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="content_type" value="uploaded" id="uploaded_file">
                                <label for="uploaded_file">Upload Memo Document</label>
                            </div>
                        </div>

                        <!-- Text Editor for Typed Content -->
                        <div id="typedContentSection">
                            <label for="file_content" class="form-label">Type Memo Content</label>
                            <textarea name="file_content" id="file_content" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="col-md-12" id="fileUploadSection" style="display: none;">
                            <div class="form-group">
                                <label for="">Attach Memo Document</label>
                                <input type="file" name="memofile" id="memofile" aria-multiselectable="" class="form-control" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
                                <?php $__errorArgs = ['memofile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="invalid-password" role="alert">
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
                    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
                    <input type="submit" value="<?php echo e(__('Save Memo')); ?>" class="btn  btn-primary">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typedRadio = document.getElementById('typed_content');
        const uploadedRadio = document.getElementById('uploaded_file');
        const typedSection = document.getElementById('typedContentSection');
        const uploadSection = document.getElementById('fileUploadSection');

        typedRadio.addEventListener('change', () => {
            typedSection.style.display = 'block';
            uploadSection.style.display = 'none';
        });

        uploadedRadio.addEventListener('change', () => {
            typedSection.style.display = 'none';
            uploadSection.style.display = 'block';
        });
    });
</script>

<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/memos/create.blade.php ENDPATH**/ ?>