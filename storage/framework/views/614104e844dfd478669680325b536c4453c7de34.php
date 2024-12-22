<div class="modal" id="newfile" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newfile">Create New Document</h5>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('files.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                                        
                            <!-- Document Name -->
                            <div class="form-group">
                                <label for="filename">Document Name</label>
                                <input type="text" name="filename" value="<?php echo e(old('filename')); ?>" class="form-control">
                                <?php $__errorArgs = ['filename'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Radio Buttons to Choose Upload or Type -->
                            <div class="form-group">
                                <label><b>Choose Document Input Method</b></label>
                                <div>
                                    <label>
                                        <input type="radio" name="input_method" value="upload" checked onchange="toggleInputMethod()"> Upload Document
                                    </label>
                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                    <label>
                                        <input type="radio" name="input_method" value="type" onchange="toggleInputMethod()"> Type Content
                                    </label>
                                </div>
                            </div>
            
                            <!-- Upload Document Field -->
                            <div class="form-group upload-field">
                                <label for="file">Document Upload</label>
                                <input type="file" name="file" aria-multiselectable="" value="<?php echo e(old('file')); ?>" class="form-control">
                                <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
            
                            <!-- Type Content Fields -->
                            <div class="type-content-field" style="display: none;">
                                <div class="form-group">
                                    <label for="content"><b>Enter Document Content</b></label>
                                    <textarea name="content" id="content" rows="5" placeholder="Type in your content" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="format"><b>Save As</b></label>
                                    <select name="format" id="format" class="form-control">
                                        <option value="pdf">PDF</option>
                                        <option value="docx">DOCX</option>
                                    </select>
                                </div>
                            </div>
            
                            <!-- Document Folder -->
                            <div class="form-group">
                                <label for="folder_id">Document Folder</label>
                                <select name="folder_id" id="folder_id" class="form-control">
                                    <option value="">Select folder (optional)</option>
                                    <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($folder->id); ?>"><?php echo e($folder->folder_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['folder_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
            
                    <div class="modal-footer">
                        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
                        <input type="submit" value="<?php echo e(__('Upload Document')); ?>" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to toggle visibility of fields
    function toggleInputMethod() {
        const uploadField = document.querySelector('.upload-field');
        const typeContentField = document.querySelector('.type-content-field');
        const selectedMethod = document.querySelector('input[name="input_method"]:checked').value;

        if (selectedMethod === 'upload') {
            uploadField.style.display = 'block';
            typeContentField.style.display = 'none';
        } else {
            uploadField.style.display = 'none';
            typeContentField.style.display = 'block';
        }
    }
</script>



<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/filemanagement/modals/create-file.blade.php ENDPATH**/ ?>