<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Account Drilldown Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('chart-of-account.index')); ?>"><?php echo e(__('Chart of Account')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Account Drilldown Report')); ?></li>
    <li class="breadcrumb-item"><?php echo e(ucwords($account->code. ' - ' .$account->name)); ?></li>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('chart-of-account.show',$account->id),'method' => 'GET','id'=>'report_drilldown'))); ?>


                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::date('start_date',$filter['startDateRange'], array('class' => 'month-btn form-control'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('end_date', __('End Date'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::date('end_date',$filter['endDateRange'], array('class' => 'month-btn form-control'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('account', __('Account'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('account',$accounts,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control select'))); ?>                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto mt-4">
                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('report_drilldown').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                        <a href="<?php echo e(route('chart-of-account.show',$account->id)); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
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
        <div class="row mt-2">
            <div class="col-3">
                
                <div class="card p-4 mb-4">
                    <h6 class="mb-0"><?php echo e(__('Report')); ?> :</h6>
                    <h7 class="text-sm mb-0"><?php echo e(__('Account Drilldown')); ?></h7>
                </div>
            </div>

            <?php if(!empty($account)): ?>
                <div class="col-3">
                    <div class="card p-4 mb-4">
                        <h6 class="mb-0"><?php echo e(__('Account Name')); ?> :</h6>
                        <h7 class="text-sm mb-0"><?php echo e($account->name); ?></h7>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card p-4 mb-4">
                        <h6 class="mb-0"><?php echo e(__('Account Code')); ?> :</h6>
                        <h7 class="text-sm mb-0"><?php echo e($account->code); ?></h7>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-3">
                <div class="card p-4 mb-4">
                    <h6 class="mb-0"><?php echo e(__('Duration')); ?> :</h6>
                    <h7 class="text-sm mb-0"><?php echo e($filter['startDateRange'].' to '.$filter['endDateRange']); ?></h7>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th> <?php echo e(__('Account Name')); ?></th>
                                    <th> <?php echo e(__('Name')); ?></th>
                                    <th> <?php echo e(__('Transaction Type')); ?></th>
                                    <th> <?php echo e(__('Transaction Date')); ?></th>
                                    <th> <?php echo e(__('Debit')); ?></th>
                                    <th> <?php echo e(__('Credit')); ?></th>
                                    <th> <?php echo e(__('Balance')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $balance = 0;
                                    $totalDebit   = 0;
                                    $totalCredit  = 0;
                                    $chartDatas =App\Models\Utility::getAccountData($account->id,$filter['startDateRange'],$filter['endDateRange']);
                                    $accountName = \App\Models\ChartOfAccount::find($account->id);
                                ?>

                                <?php $__currentLoopData = $chartDatas['invoice']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoiceData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($accountName->name); ?></td>
                                        <?php
                                            $invoice = \App\Models\Invoice::where('id',$invoiceData->invoice_id)->first();
                                        ?>
                                        <td><?php echo e((!empty($invoice->customer)?$invoice->customer->name:'-')); ?></td>
                                        <td><?php echo e(\Auth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></td>
                                        <td><?php echo e($invoiceData->created_at->format('d-m-Y')); ?></td>
                                        <td>-</td>

                                        <?php
                                            $total= $invoiceData->price * $invoiceData->quantity;
                                            $balance +=$total;
                                            $totalCredit+=$total;
                                        ?>
                                        <td><?php echo e(\Auth::user()->priceFormat($total)); ?></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($balance)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = $chartDatas['invoicepayment']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoicePaymentData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($accountName->name); ?></td>
                                        <?php
                                            $invoice = \App\Models\Invoice::where('id',$invoicePaymentData->invoice_id)->first();
                                        ?>
                                        <td><?php echo e((!empty($invoice->customer)?$invoice->customer->name:'-')); ?></td>
                                        <td><?php echo e(\Auth::user()->invoiceNumberFormat($invoice->invoice_id)); ?> <?php echo e(__(' Manually Payment')); ?></td>
                                        <td><?php echo e($invoicePaymentData->created_at->format('d-m-Y')); ?></td>
                                        <td>-</td>
                                        <td><?php echo e(\Auth::user()->priceFormat($invoicePaymentData->amount)); ?></td>
                                        <?php
                                            $balance += $invoicePaymentData->amount;
                                            $totalCredit+=$invoicePaymentData->amount;
                                        ?>
                                        <td><?php echo e(\Auth::user()->priceFormat($balance)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = $chartDatas['revenue']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $revenueData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($accountName->name); ?></td>
                                        <td><?php echo e((!empty($revenueData->customer)?$revenueData->customer->name:'-')); ?></td>
                                        <td><?php echo e(__('Revenue')); ?></td>
                                        <td><?php echo e($revenueData->created_at->format('d-m-Y')); ?></td>
                                        <td>-</td>
                                        <td><?php echo e(\Auth::user()->priceFormat($revenueData->amount)); ?></td>
                                        <?php
                                            $balance += $revenueData->amount;
                                            $totalCredit+=$revenueData->amount;
                                        ?>
                                        <td><?php echo e(\Auth::user()->priceFormat($balance)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                <?php $__currentLoopData = $chartDatas['bill']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $billProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($accountName->name); ?></td>
                                        <?php

                                        $bill = \App\Models\Bill::find($billProduct->bill_id);
                                        $vendor = \App\Models\Vender::find(!empty($bill)?$bill->vender_id:'');
                                        ?>
                                        <td><?php echo e(!empty($vendor)?$vendor->name : '-'); ?></td>
                                        <td><?php echo e(\Auth::user()->billNumberFormat($bill->bill_id)); ?></td>
                                        <td><?php echo e($billProduct->created_at->format('d-m-Y')); ?></td>
                                        
                                        <?php
                                            $total= $billProduct->price * $billProduct->quantity;
                                            $balance +=$total;
                                            $totalCredit+=$total;
                                            ?>
                                        <td><?php echo e(\Auth::user()->priceFormat($total)); ?></td>
                                        <td>-</td>
                                        <td><?php echo e(\Auth::user()->priceFormat($balance)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = $chartDatas['billdata']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $billData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $bill = \App\Models\Bill::find($billData->ref_id);
                                        $vendor = \App\Models\Vender::find(!empty($bill)?$bill->vender_id:'');
                                    ?>
                                    <tr>
                                        <td><?php echo e($accountName->name); ?></td>
                                        <td><?php echo e(!empty($vendor)?$vendor->name : '-'); ?></td>
                                        <?php if(!empty($bill->bill_id)): ?>
                                            <td><?php echo e(\Auth::user()->billNumberFormat($bill->bill_id)); ?></td>
                                        <?php else: ?>
                                            <td>-</td>
                                        <?php endif; ?>

                                        <td><?php echo e($billData->created_at->format('d-m-Y')); ?></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($billData->price)); ?></td>
                                        <td>-</td>
                                        <?php
                                            $balance += $billData->price;
                                            $totalDebit+= $billData->price;
                                        ?>
                                        <td><?php echo e(\Auth::user()->priceFormat($totalCredit - $totalDebit)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = $chartDatas['billpayment']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $billPaymentData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $bill = \App\Models\BillPayment::where('bill_id',$billPaymentData->bill_id)->first();
                                        $billId= \App\Models\Bill::find($billPaymentData->bill_id);
                                        $vendor = \App\Models\Vender::find($billId->vender_id);
                                    ?>
                                    <tr>
                                        <td><?php echo e($accountName->name); ?></td>
                                        <td><?php echo e(!empty($vendor)?$vendor->name : '-'); ?></td>
                                        <td><?php echo e(\Auth::user()->billNumberFormat($billId->bill_id)); ?><?php echo e(__(' Manually Payment')); ?></td>
                                        <td><?php echo e($billPaymentData->created_at->format('d-m-Y')); ?></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($billPaymentData->amount)); ?></td>
                                        <td>-</td>
                                        <?php
                                            $balance += $billPaymentData->amount;
                                            $totalDebit+= $billPaymentData->amount;
                                        ?>
                                        <td><?php echo e(\Auth::user()->priceFormat($totalCredit-$totalDebit)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = $chartDatas['payment']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php
                                        $vendor = \App\Models\Vender::find($paymentData->vender_id);
                                    ?>
                                    <tr>
                                        <td><?php echo e($accountName->name); ?></td>
                                        <td><?php echo e(!empty($vendor)?$vendor->name : '-'); ?></td>
                                        <td><?php echo e(__('Payment')); ?></td>
                                        <td><?php echo e($paymentData->created_at->format('d-m-Y')); ?></td>

                                        <td><?php echo e(\Auth::user()->priceFormat($paymentData->amount)); ?></td>
                                        <td>-</td>
                                        <?php
                                            $balance += $paymentData->amount;
                                            $totalDebit += $paymentData->amount;
                                        ?>
                                        <td><?php echo e(\Auth::user()->priceFormat($totalCredit-$totalDebit)); ?></td>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nittdig\resources\views/chartOfAccount/show.blade.php ENDPATH**/ ?>