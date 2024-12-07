<div>
    <?php
    $profile=\App\Models\Utility::get_file('uploads/avatar');
    ?>
 <?php $__env->startSection('page-title'); ?>
     <?php echo e(__('Manage Project Documents')); ?>

 <?php $__env->stopSection(); ?>

 <?php $__env->startPush('script-page'); ?>
 <?php $__env->stopPush(); ?>
 <?php $__env->startSection('breadcrumb'); ?>
     <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
     <li class="breadcrumb-item"><?php echo e(__('Project Documents')); ?></li>
 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('action-btn'); ?>
     <div class="float-end">
                 <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#uplodDocumentModal"   data-bs-toggle="tooltip" title="<?php echo e(__('Upload Bill of Quantity')); ?>"  class="btn btn-sm btn-primary">
                    <i class="ti ti-upload"></i>
                </a>
     </div>
 <?php $__env->stopSection(); ?>


<div class="col-xl-12">

    <div class="card mt-4">
        <div class="card-body table-border-style">
            <div class="table-responsive">

                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th><?php echo e(__('Project Name')); ?></th>
                        <th><?php echo e(__('Document Name')); ?></th>
                        <th class="text-end"><?php echo e(__('Action')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($documents)> 0): ?>
                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <td class="">
                                    <img src="<?php echo e(asset('assets/images/documents.png')); ?>" width="50" />
                                </td>

                                <td class="">
                                    
                                </td>

                                <td class="">
                                    <?php echo e($document->document_name); ?>

                                </td>
                                <td class="text-end">
                                    <span>

                                            
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="<?php echo e(asset('assets/documents/documents')); ?>/<?php echo e($document->document); ?>" target="_blank" class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-bs-toggle="tooltip" title="<?php echo e(__('View Document')); ?>" data-title="<?php echo e(__('View Document')); ?>">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-warning ms-2">
                                                
                                                <a href="#" wire:click="downloadFile('<?php echo e($document->document); ?>')" class="btn btn-primary btn-sm"><i class="ti ti-download"></i></a>
                                            </div>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <th scope="col" colspan="7"><h6 class="text-center"><?php echo e(__('No Dcoument Upload Yet.')); ?></h6></th>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('livewire.contractor.modals.upload-document', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div>
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/contractor/documents-component.blade.php ENDPATH**/ ?>