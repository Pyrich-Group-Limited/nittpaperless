<div id="viewBOQ">
    <div class="modal" id="viewApplicantModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document" wire:ignore.self>
            <div class="modal-content">
                <div class="modal-body">

                    <div class="modal-header">
                        <h5 class="modal-title" id="applyLeave">PROJECT APPLICANT DETAILS
                        </h5>
                    </div>
                    <div class="modal-body">
                        <?php if($projectApplicant): ?>
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
                                                    <th scope="row">Applicant Name</th>
                                                    <td><?php echo e($projectApplicant->contractor->name); ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Name</th>
                                                    <td><?php echo e($projectApplicant->applicant->company_name); ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Year of Incorporation</th>
                                                    <td style="white-space: pre-wrap"><?php echo e($projectApplicant->applicant->year_of_incorporation); ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company TIN</th>
                                                    <td><?php echo e($projectApplicant->applicant->company_tin); ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Address</th>
                                                    <td><?php echo e($projectApplicant->applicant->company_address); ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Email</th>
                                                    <td><?php echo e($projectApplicant->applicant->email); ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Phone</th>
                                                    <td><?php echo e($projectApplicant->applicant->phone); ?></td>
                                                </tr>
                                                 <tr>
                                                    <th scope="row">Application Status</th>
                                                    <td>
                                                        <span class="badge <?php if($projectApplicant->application_status=='pending'): ?> bg-warning
                                                            <?php elseif($projectApplicant->application_status=='on_review'): ?> bg-info
                                                            <?php elseif($projectApplicant->application_status=='selected'): ?> bg-primary
                                                            <?php elseif($projectApplicant->application_status=='rejected'): ?> bg-danger
                                                            <?php endif; ?> p-2 px-3 rounded"><?php echo e($projectApplicant->application_status); ?>

                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Application Date</th>
                                                    <td><?php echo e(date('d-M-Y', strtotime($projectApplicant->created_at))); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <hr>
                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <h5 class="text-primary"><b>Uploaded Documents</b></h5>
                                        <table class="table table-bordered mb-0">
                                            <tbody>
                                                <?php if($projectApplicant->documents->isEmpty()): ?>
                                                    <p>No documents uploaded for this application.</p>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $projectApplicant->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicationDocument): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td scope="row"><?php echo e($loop->iteration); ?></td>
                                                            <td><?php echo e($applicationDocument->document_name); ?></td>
                                                            <td class="text-end">
                                                                <a href="#" target="_blank" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>
                                                                <a href="#" class="btn btn-primary btn-sm"><i class="ti ti-download" download></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            <div class="modal-footer">
                                <input type="button" id="closeApplicantDetails" value="<?php echo e(__('Close')); ?>"
                                    class="btn  btn-light" data-bs-dismiss="modal">
                                <input type="button"  wire:click="recommendToDg('<?php echo e($projectApplicant->id); ?>')" value="<?php echo e(__('Recommend')); ?>" class="btn  btn-primary">
                            </div>
                        <?php else: ?>
                            <label align="center" class="mb-4" style="color: red">Loading...</label>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('success', event => {
            document.getElementById("closeApplicantDetails").click();
        })
    </script>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.toast-notification','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('toast-notification'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\nittpaperless-1\resources\views/livewire/projects/modals/project-applicant-details.blade.php ENDPATH**/ ?>