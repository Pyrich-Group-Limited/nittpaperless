<div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">

                        <tbody>
                            <style>
                                th{
                                    width: 200px !important;
                                }
                            </style>
                            <tr>
                                <th scope="row">Memo Title</th>
                                <td><?php echo e($memo->title); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Memo Description</th>
                                <td style="white-space: pre-wrap"><?php echo e($memo->description); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Created  By:</th>
                                <td><?php echo e($memo->creator->name); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Date created</th>
                                <td><?php echo e($memo->created_at->format('d-M-Y')); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Signature</th>
                                
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        </div>

        <div class="modal-footer">
            <a href="<?php echo e(route('memos.download',$memo->id)); ?>" class="btn btn-primary btn-sm" download><i class="ti ti-download text-white"></i> Download Memo</a>
            <input type="button" value="<?php echo e(('Close')); ?>" class="btn  btn-light btn-sm" data-bs-dismiss="modal">
        </div>
    </div>
<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/memos/show.blade.php ENDPATH**/ ?>