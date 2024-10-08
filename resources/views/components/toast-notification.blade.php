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
