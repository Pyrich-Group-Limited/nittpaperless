


<div class="modal fade" id="shareFileModal" tabindex="-1" role="dialog" aria-labelledby="shareFileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareFileModalLabel">Share File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="shareFileForm" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('GET'); ?>

                <div class="modal-body">
                    <p id="fileName"></p> <!-- File name dynamically populated -->
                    <div class="form-group">
                        <label for="user_id">Select User to Share With:</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="#">---Select---</option>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Share</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php $__env->startSection('scripts'); ?>
<script>
    // Handle the share button click
    $(document).on('click', '.btn-share-file', function () {
        var fileName = $(this).data('file_name');
        var fileId = $(this).data('file-id');

        // Update the file name in the modal
        $('#fileName').text('Share file: ' + fileName);

        // Update the form action with the correct file ID
        var action = "<?php echo e(route('files.share', ':file_id')); ?>";
        action = action.replace(':file_id', fileId);
        $('#shareFileForm').attr('action', action);
    });
</script>
<?php $__env->stopSection(); ?>



<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/filemanagement/modals/share-modal.blade.php ENDPATH**/ ?>