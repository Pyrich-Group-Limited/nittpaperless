<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><b>Welcome </b><?php echo e(Ucfirst(Auth::user()->name). "(" .Auth::user()->department->name. ")"); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xxl-7">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto mb-3 mb-sm-0">
                                                <a href="#">
                                                    <div class="d-flex align-items-center">
                                                        <div class="theme-avtar bg-primary">
                                                            <i class="ti ti-cast"></i>
                                                        </div>
                                                        <div class="ms-3">

                                                            <h6 class="m-0"><?php echo e(__('Purchase Requisition')); ?></h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto mb-3 mb-sm-0">
                                                <a href="#">
                                                    <div class="d-flex align-items-center">
                                                        <div class="theme-avtar bg-primary">
                                                            <i class="ti ti-cast"></i>
                                                        </div>
                                                        <div class="ms-3">
                                                            <h6 class="m-0"><?php echo e(__('Store Requisition Note')); ?></h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto mb-3 mb-sm-0">
                                                <a href="#">
                                                    <div class="d-flex align-items-center">
                                                        <div class="theme-avtar bg-primary">
                                                            <i class="ti ti-cast"></i>
                                                        </div>
                                                        <div class="ms-3">
                                                            <h6 class="m-0"><?php echo e(__('Goods Recieved')); ?></h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto mb-3 mb-sm-0">
                                                <a href="#">
                                                    <div class="d-flex align-items-center">
                                                        <div class="theme-avtar bg-primary">
                                                            <i class="ti ti-cast"></i>
                                                        </div>
                                                        <div class="ms-3">
                                                            <h6 class="m-0"><?php echo e(__('Inventory/Assets')); ?></h6>
                                                        </div>
                                                    </div>
                                                </a>
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
    </div>
</div>

    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('report.invoice.summary'),'method' => 'GET','id'=>'report_invoice_summary'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto mt-4">

                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('report_invoice_summary').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>

                                        <a href="<?php echo e(route('report.invoice.summary')); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

    <div id="printableArea">
        <div class="col-12" id="invoice-container">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab3" data-bs-toggle="pill" href="#purchase" role="tab" aria-controls="pills-summary" aria-selected="true"><?php echo e(__('Purchase Requisition')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab4" data-bs-toggle="pill" href="#requisition" role="tab" aria-controls="pills-invoice" aria-selected="false"><?php echo e(__('Store Requisition Note')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab5" data-bs-toggle="pill" href="#goods" role="tab" aria-controls="pills-invoice" aria-selected="false"><?php echo e(__('Goods Received')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab6" data-bs-toggle="pill" href="#inventory" role="tab" aria-controls="pills-invoice" aria-selected="false"><?php echo e(__('Inventory/Assets')); ?></a>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade fade" id="purchase" role="tabpanel" aria-labelledby="profile-tab3">
                                        <table class="table table-flush table datatable" id="report-dataTable">
                                            <thead>
                                            <tr>
                                                <th> <?php echo e(__('Invoice')); ?></th>
                                                <th> <?php echo e(__('Date')); ?></th>
                                                <th> <?php echo e(__('Customer')); ?></th>
                                                <th> <?php echo e(__('Category')); ?></th>
                                                <th> <?php echo e(__('Status')); ?></th>
                                                <th> <?php echo e(__('	Paid Amount')); ?></th>
                                                <th> <?php echo e(__('Due Amount')); ?></th>
                                                <th> <?php echo e(__('Payment Date')); ?></th>
                                                <th> <?php echo e(__('Amount')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            
                                                <tr>
                                                    <td class="Id">
                                                        
                                                        


                                                    </td>
                                                    <td></td>
                                                    <td> </td>
                                                    <td></td>
                                                    <td>

                                                    </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td></td>
                                                    <td> </td>
                                                </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade fade" id="requisition" role="tabpanel" aria-labelledby="profile-tab3">
                                        <table class="table table-flush table datatable" id="report-dataTable">
                                            <thead>
                                            <tr>
                                                <th> <?php echo e(__('Store Requisition Note')); ?></th>
                                                <th> <?php echo e(__('Date')); ?></th>
                                                <th> <?php echo e(__('Customer')); ?></th>
                                                <th> <?php echo e(__('Category')); ?></th>
                                                <th> <?php echo e(__('Status')); ?></th>
                                                <th> <?php echo e(__('	Paid Amount')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td></td>
                                                    <td> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="tab-pane fade fade" id="goods" role="tabpanel" aria-labelledby="profile-tab3">
                                        <table class="table table-flush table datatable" id="report-dataTable">
                                            <thead>
                                            <tr>
                                                <th> <?php echo e(__('Goods')); ?></th>
                                                <th> <?php echo e(__('Date')); ?></th>
                                                <th> <?php echo e(__('Customer')); ?></th>
                                                <th> <?php echo e(__('Category')); ?></th>
                                                <th> <?php echo e(__('Status')); ?></th>
                                                <th> <?php echo e(__('	Paid Amount')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td></td>
                                                    <td> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="tab-pane fade fade" id="inventory" role="tabpanel" aria-labelledby="profile-tab3">
                                        <table class="table table-flush table datatable" id="report-dataTable">
                                            <thead>
                                            <tr>
                                                <th> <?php echo e(__('Goods')); ?></th>
                                                <th> <?php echo e(__('Date')); ?></th>
                                                <th> <?php echo e(__('Customer')); ?></th>
                                                <th> <?php echo e(__('Category')); ?></th>
                                                <th> <?php echo e(__('Status')); ?></th>
                                                <th> <?php echo e(__('	Paid Amount')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td></td>
                                                    <td> </td>
                                                </tr>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/dashboard/user-dashboard.blade.php ENDPATH**/ ?>