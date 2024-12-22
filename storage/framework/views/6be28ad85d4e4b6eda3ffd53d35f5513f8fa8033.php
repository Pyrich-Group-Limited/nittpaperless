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
        <a href="#" class="btn btn-sm btn-primary" id="raiseMemoButton" data-bs-toggle="modal" data-bs-target="#raisememo"   data-size="lg " data-bs-toggle="tooltip"><i class="ti ti-plus text-white"></i>Raise a Memo</a>
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
                                        <a class="nav-link active" id="profile-tab2" data-bs-toggle="pill" href="#memos" role="tab" aria-controls="pills-summary" aria-selected="true"><i class="ti ti-files"> </i> <?php echo e(__('Memos')); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab3" data-bs-toggle="pill" href="#incoming" role="tab" aria-controls="pills-summary" aria-selected="false"><i class="ti ti-download"> </i> <?php echo e(__('Incoming Memos')); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab4" data-bs-toggle="pill" href="#outgoing" role="tab" aria-controls="pills-invoice" aria-selected="false"><i class="ti ti-upload"> </i> <?php echo e(__('Outgoing Memos')); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="tab-content" id="myTabContent2">
                                        <div class="tab-pane fade fade table-responsive" id="memos" role="tabpanel" aria-labelledby="profile-tab2">
                                            <table class="table table-flush table datatable">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('Creator Name')); ?></th>
                                                        <th><?php echo e(__('Department')); ?></th>
                                                        <th><?php echo e(__('Memo Title')); ?></th>
                                                        <th><?php echo e(__('Priority')); ?></th>
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
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div class="media-body">
                                                                            <?php if($memo->priority == 0): ?>
                                                                                <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-primary p-2 px-3 rounded">   Low</span>
                                                                            <?php elseif($memo->priority == 1): ?>
                                                                                <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-info p-2 px-3 rounded">  Medium </span>
                                                                            <?php elseif($memo->priority == 2): ?>
                                                                                <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-warning p-2 px-3 rounded">   High </span>
                                                                            <?php elseif($memo->priority == 3): ?>
                                                                                <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-danger p-2 px-3 rounded">   Critical</span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
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
                                                                        <a href="<?php echo e(route('memos.download',$memo->id)); ?>" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="false"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('Download Memo')); ?>"  data-title="<?php echo e(__('Download Memo')); ?>">
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
                                                        <th scope="col"><?php echo e(__('Sender')); ?></th>
                                                        <th><?php echo e(__('Location')); ?></th>
                                                        <th><?php echo e(__('Department')); ?></th>
                                                        <th><?php echo e(__('Memo Title')); ?></th>
                                                        <th><?php echo e(__('Priority')); ?></th>
                                                        <th><?php echo e(__('Date Shared')); ?></th>
                                                        <th><?php echo e(__('Signature')); ?></th>
                                                        <th><?php echo e(__('Action')); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $incomingMemos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incomingMemo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr class="font-style">
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div>
                                                                            <div class="avatar-parent-child">
                                                                                <img alt="" class="avatar rounded-circle avatar-sm" <?php if(!empty($incomingMemo->createdBy) && !empty($incomingMemo->createdBy->avatar)): ?> src="<?php echo e(asset(Storage::url('uploads/avatar')).'/'.$incomingMemo->createdBy->avatar); ?>" <?php else: ?>  src="<?php echo e(asset(Storage::url('uploads/avatar')).'/avatar.png'); ?>" <?php endif; ?>>
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <?php echo e(!empty($incomingMemo->sharedBy->name)?$incomingMemo->sharedBy->name:''); ?>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><?php echo e($incomingMemo->sharedBy->location); ?></td>
                                                                <td><?php echo e($incomingMemo->sharedBy->department->name); ?></td>
                                                                <td><?php echo e($incomingMemo->memo->title); ?></td>
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div class="media-body">
                                                                            <?php if($incomingMemo->memo->priority == 0): ?>
                                                                                <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-primary p-2 px-3 rounded">   Low</span>
                                                                            <?php elseif($incomingMemo->memo->priority == 1): ?>
                                                                                <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-info p-2 px-3 rounded">  Medium </span>
                                                                            <?php elseif($incomingMemo->memo->priority == 2): ?>
                                                                                <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-warning p-2 px-3 rounded">   High </span>
                                                                            <?php elseif($incomingMemo->memo->priority == 3): ?>
                                                                                <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-danger p-2 px-3 rounded">   Critical</span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><?php echo e($incomingMemo->created_at->format('d-M-Y')); ?></td>
                                                                <td>
                                                                    <?php if($incomingMemo->sharedBy && $incomingMemo->sharedBy->signature): ?>
                                                                        <img src="<?php echo e(asset('storage/' . $incomingMemo->sharedBy->signature->signature_path)); ?>" alt="Signature" height="50">
                                                                    <?php else: ?>
                                                                        <strike><?php echo e($incomingMemo->sharedBy->name); ?></strike>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td class="Action">
                                                                    <div class="action-btn bg-success ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('memos.show', $incomingMemo->memo_id)); ?>"
                                                                            data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('View Memo')); ?>" data-title="<?php echo e(__('View Memo')); ?>">
                                                                            <i class="ti ti-eye text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-info ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="<?php echo e(route('memos.shareModal', $incomingMemo->memo->id)); ?>" data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Share Memo')); ?>"  data-title="<?php echo e(__('Share Memo')); ?>">
                                                                            <i class="ti ti-share text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="action-btn bg-primary ms-2">
                                                                        <a href="<?php echo e(route('memos.download',$incomingMemo->memo->id)); ?>" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="false"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('Download Memo')); ?>"  data-title="<?php echo e(__('Download Memo')); ?>">
                                                                            <i class="ti ti-download text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                            </table>
                                            <?php if($incomingMemos->isEmpty()): ?>
                                            <div align="center" id="norecord"><img style="margin-left:;"  width="100" src="https://img.freepik.com/free-vector/
                                                no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                                                alt="No results found" >
                                                <p class="mt-2 text-danger">No incoming record found!</p>
                                            </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="tab-pane fade fade table-responsive" id="outgoing" role="tabpanel" aria-labelledby="profile-tab4">
                                            <table class="table table-flush table datatable" id="report-dataTable">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('Shared With')); ?></th>
                                                        <th><?php echo e(__('Location')); ?></th>
                                                        <th><?php echo e(__('Department')); ?></th>
                                                        <th><?php echo e(__('Memo Title')); ?></th>
                                                        <th><?php echo e(__('Priority')); ?></th>
                                                        <th><?php echo e(__('Date Shared')); ?></th>
                                                        <th><?php echo e(__('Action')); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $outgoingMemos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outgoingMemo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr class="font-style">
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div>
                                                                            <div class="avatar-parent-child">
                                                                                <img alt="" class="avatar rounded-circle avatar-sm" <?php if(!empty($outgoingMemo->createdBy) && !empty($outgoingMemo->createdBy->avatar)): ?> src="<?php echo e(asset(Storage::url('uploads/avatar')).'/'.$outgoingMemo->createdBy->avatar); ?>" <?php else: ?>  src="<?php echo e(asset(Storage::url('uploads/avatar')).'/avatar.png'); ?>" <?php endif; ?>>
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <?php echo e(!empty($outgoingMemo->sharedWith->name)?$outgoingMemo->sharedWith->name:''); ?>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><?php echo e($outgoingMemo->sharedWith->location); ?></td>
                                                                <td><?php echo e($outgoingMemo->sharedWith->department->name); ?></td>
                                                                <td><?php echo e($outgoingMemo->memo->title); ?></td>
                                                                <td scope="row">
                                                                    <div class="media align-items-center">
                                                                        <div class="media-body">
                                                                            <?php if($outgoingMemo->memo->priority == 0): ?>
                                                                                <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-primary p-2 px-3 rounded">   Low</span>
                                                                            <?php elseif($outgoingMemo->memo->priority == 1): ?>
                                                                                <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-info p-2 px-3 rounded">  Medium </span>
                                                                            <?php elseif($outgoingMemo->memo->priority == 2): ?>
                                                                                <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-warning p-2 px-3 rounded">   High </span>
                                                                            <?php elseif($outgoingMemo->memo->priority == 3): ?>
                                                                                <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-danger p-2 px-3 rounded">   Critical</span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><?php echo e($outgoingMemo->created_at->format('d-M-Y')); ?></td>
                                                                <td class="Action">
                                                                    <div class="action-btn bg-success ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('memos.show', $outgoingMemo->memo_id)); ?>"
                                                                            data-ajax-popup="true" data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('View Memo')); ?>" data-title="<?php echo e(__('View Memo')); ?>">
                                                                            <i class="ti ti-eye text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                   
                                                                    <div class="action-btn bg-primary ms-2">
                                                                        <a href="<?php echo e(route('memos.download',$outgoingMemo->memo->id)); ?>" class="mx-3 btn btn-sm  align-items-center" data-url="" data-ajax-popup="false"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('Download Memo')); ?>"  data-title="<?php echo e(__('Download Memo')); ?>">
                                                                            <i class="ti ti-download text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                            </table>
                                            <?php if($outgoingMemos->isEmpty()): ?>
                                            <div align="center" id="norecord"><img style="margin-left:;"  width="100" src="https://img.freepik.com/free-vector/
                                                no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                                                alt="No results found" >
                                                <p class="mt-2 text-danger">No outgoing record found!</p>
                                            </div>
                                            <?php endif; ?>
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
    <?php echo $__env->make('memos.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if($errors->any() || Session::has('error')): ?>
    <script>
        $(document).ready(function() {
            document.getElementById("raiseMemoButton").click();
        });
    </script>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/memos/index.blade.php ENDPATH**/ ?>