<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Memos')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Memos')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-size="lg" data-url="<?php echo e(route('memos.create')); ?>" data-ajax-popup="true"
            data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Raise Memo')); ?>"
            class="btn btn-sm btn-primary">Raise Memo
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div id="printableArea">
            <div class="col-12" id="invoice-container">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between w-100">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="profile-tab3" data-bs-toggle="pill" href="#memos" role="tab" aria-controls="pills-summary" aria-selected="true"><?php echo e(__('Memos')); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab3" data-bs-toggle="pill" href="#incoming" role="tab" aria-controls="pills-summary" aria-selected="true"><?php echo e(__('Incoming Memos')); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab4" data-bs-toggle="pill" href="#outgoing" role="tab" aria-controls="pills-invoice" aria-selected="false"><?php echo e(__('Outgoing Memos')); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="tab-content" id="myTabContent2">
                                        <div class="tab-pane fade fade table-responsive" id="memos" role="tabpanel" aria-labelledby="profile-tab3">
                                            <table class="table table-flush table datatable" id="report-dataTable">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('Creator Name')); ?></th>
                                                        <th><?php echo e(__('Department')); ?></th>
                                                        <th><?php echo e(__('Memo Title')); ?></th>
                                                        <th><?php echo e(__('Description')); ?></th>
                                                        <th><?php echo e(__('Date')); ?></th>
                                                        <th><?php echo e(__('Action')); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $memos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $memo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr class="font-style">
                                                                <td><?php echo e($memo->creator->name); ?></td>
                                                                <td><?php echo e($memo->creator->department->name); ?></td>
                                                                <td><?php echo e($memo->title); ?></td>
                                                                <td><?php echo e(Str::limit($memo->description, 20, '...')); ?></td>
                                                                <td><?php echo e($memo->created_at->format('d-M-Y')); ?></td>
                                                                <td class="Action">
                                                                    <div class="action-btn bg-success ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('memos.show', $memo->id)); ?>"
                                                                            data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('View Memo')); ?>" data-title="<?php echo e(__('View Memo')); ?>">
                                                                            <i class="ti ti-eye text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-info ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="<?php echo e(route('memos.shareModal', $memo->id)); ?>" data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Share Memo')); ?>"  data-title="<?php echo e(__('Share Memo')); ?>">
                                                                            <i class="ti ti-share text-white"></i>
                                                                        </a>
                                                                    </div>

                                                                    <div class="action-btn bg-primary ms-2">
                                                                        <a href="<?php echo e(route('memos.download',$memo->id)); ?>" download class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="false"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('Download Memo')); ?>"  data-title="<?php echo e(__('Download Memo')); ?>">
                                                                            <i class="ti ti-download text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane fade fade table-responsive" id="incoming" role="tabpanel" aria-labelledby="profile-tab3">
                                            <table class="table table-flush table datatable" id="report-dataTable">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('Shared By')); ?></th>
                                                        <th><?php echo e(__('Department')); ?></th>
                                                        <th><?php echo e(__('Memo Title')); ?></th>
                                                        <th><?php echo e(__('Date Shared')); ?></th>
                                                        <th><?php echo e(__('Action')); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $incomingMemos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incomingMemo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr class="font-style">
                                                                <td><?php echo e($incomingMemo->sharedBy->name); ?></td>
                                                                <td><?php echo e($incomingMemo->sharedBy->department->name); ?></td>
                                                                <td><?php echo e($incomingMemo->memo->title); ?></td>
                                                                <td><?php echo e($incomingMemo->created_at->format('d-M-Y')); ?></td>
                                                                <td class="Action">
                                                                    <div class="action-btn bg-success ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('memos.show', $incomingMemo->memo_id)); ?>"
                                                                            data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('View Memo')); ?>" data-title="<?php echo e(__('View Memo')); ?>">
                                                                            <i class="ti ti-eye text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    
                                                                    <div class="action-btn bg-primary ms-2">
                                                                        <a href="<?php echo e(route('memos.download',$incomingMemo->memo_id)); ?>" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="false"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('Download Memo')); ?>"  data-title="<?php echo e(__('Download Memo')); ?>">
                                                                            <i class="ti ti-download text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane fade fade table-responsive" id="outgoing" role="tabpanel" aria-labelledby="profile-tab3">
                                            <table class="table table-flush table datatable" id="report-dataTable">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('Shared With')); ?></th>
                                                        <th><?php echo e(__('Department')); ?></th>
                                                        <th><?php echo e(__('Memo Title')); ?></th>
                                                        <th><?php echo e(__('Date Shared')); ?></th>
                                                        <th><?php echo e(__('Action')); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $outgoingMemos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outgoingMemo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr class="font-style">
                                                                <td><?php echo e($outgoingMemo->sharedWith->name); ?></td>
                                                                <td><?php echo e($outgoingMemo->sharedWith->department->name); ?></td>
                                                                <td><?php echo e($outgoingMemo->memo->title); ?></td>
                                                                <td><?php echo e($outgoingMemo->created_at->format('d-M-Y')); ?></td>
                                                                <td class="Action">
                                                                    <div class="action-btn bg-success ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('memos.show', $outgoingMemo->memo_id)); ?>"
                                                                            data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('View Memo')); ?>" data-title="<?php echo e(__('View Memo')); ?>">
                                                                            <i class="ti ti-eye text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    
                                                                    <div class="action-btn bg-primary ms-2">
                                                                        <a href="<?php echo e(route('memos.download',$outgoingMemo->memo_id)); ?>" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="false"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('Download Memo')); ?>"  data-title="<?php echo e(__('Download Memo')); ?>">
                                                                            <i class="ti ti-download text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/memos/index.blade.php ENDPATH**/ ?>