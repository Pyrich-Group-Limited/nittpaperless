<script>
    window.addEventListener('error',event => {
        show_toastr('error', event.detail.error);
    });
</script>

<script>
    window.addEventListener('success',event => {
        show_toastr('success',  event.detail.success);
    });
</script>
<?php /**PATH C:\laragon\www\nittdig\resources\views/components/toast-notification.blade.php ENDPATH**/ ?>