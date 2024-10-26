<?php if(Session::has('errorfeedback')): ?>
    <div class="example-alert">
        <div class="alert alert-danger alert-icon">
            <em class="icon ni ni-cross-circle"></em> <strong>Error</strong>! <?php echo e(Session::get('errorfeedback')); ?>.
        </div>
    </div>
<?php endif; ?>

<?php if(Session::has('feedback')): ?>
<div class="example-alert">
    <div class="alert alert-success alert-icon">
        <em class="icon ni ni-check-circle"></em> <strong>Success</strong>!  <?php echo e(Session::get('feedback')); ?>.
    </div>
</div>
<?php endif; ?>


<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/components/feedback-alert.blade.php ENDPATH**/ ?>