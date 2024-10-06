<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Show Memo')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo e($memo->title); ?></h1>
    <p><?php echo e($memo->description); ?></p>

    <p><strong>Created by:</strong> <?php echo e($memo->creator->name); ?></p>

    <p><strong>Signature:</strong>
        
    </p>

    <a href="<?php echo e(asset('storage/' . $memo->file_path)); ?>" class="btn btn-primary" download>Download Memo</a>

    <hr>

    <h2>Share Memo</h2>

    
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/memos/show.blade.php ENDPATH**/ ?>