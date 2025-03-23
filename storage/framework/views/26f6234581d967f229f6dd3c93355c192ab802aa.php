<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Invoices')); ?></h1>
    <div class="section-header-breadcrumb">
        
        <div class="breadcrumb-item"><a href="<?php echo e(route('invoices.index')); ?>"><?php echo e(__('Invoices')); ?></a>
        </div>
        <div class="breadcrumb-item"><?php echo e(__('Invoice Details')); ?></div>
    </div>
</div>
<?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h3><?php echo e(__('Invoice Details')); ?></h3>
                        <div class="invoice-number"><?php echo e(__('Order')); ?> #<?php echo e($invoice->orders->order_id); ?></div>
                    </div>
                    <hr>
                    <div class="card card-invoice">
                        <div class="row  text-capitalize">
                            <div class="col-md-6">
                                <div class="card margin-0">
                                    <div class="card-body">
                                        <div class="form-group row margin-0">
                                            <label class="col-form-label text-md-right col-3"><?php echo e(__('Date')); ?></label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2"><?php echo e($invoice->created_at); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row margin-0">
                                            <label class="col-form-label text-md-right col-3"><?php echo e(__('Order')); ?>

                                                #</label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2"><?php echo e($invoice->orders->order_id); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row margin-0">
                                            <label class="col-form-label text-md-right col-3"><?php echo e(__('Client')); ?></label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?><br>
                                                        <?php echo e($user->address_1); ?>,<br><?php echo e($user->city); ?>,
                                                        <?php echo e($user->postal_code); ?>,<br><?php echo e($user->states->name); ?>,
                                                        <?php echo e($user->countries->name); ?><br></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row margin-0">
                                            <label
                                                class="col-form-label text-md-right col-3"><?php echo e(__('Payment Method')); ?></label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2"><?php echo e($invoice->gateway !== null ? $invoice->gateway : 'NA'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row margin-0">
                                            <label class="col-form-label text-md-right col-3"><?php echo e(__('Amount')); ?></label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2">$<?php echo e($invoice->amount !== null ? number_format($invoice->amount, 2) : 'NA'); ?>

                                                        <?php echo e($invoice->currency); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row margin-0">
                                            <label class="col-form-label text-md-right col-3"><?php echo e(__('Invoice')); ?>

                                                #</label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2"><?php echo e($invoice->uuid !== null ? $invoice->uuid : 'NA'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row margin-0">
                                            <label
                                                class="col-form-label text-md-right col-3"><?php echo e(__('Transaction ID')); ?></label>
                                            <div class="col-9">
                                                <div class="card invoice-details"><span
                                                        class="m-2"><?php echo e($invoice->transaction_id !== null ? $invoice->transaction_id : 'NA'); ?></span>
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
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title"><?php echo e(__('Order Summary')); ?></div>
                    <p class="section-lead"><?php echo e(__('Order details are listed here')); ?>.</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-md">
                            <tr class="text-center bg-custom-light">
                                <th data-width="40">#</th>
                                <th><?php echo e(__('Plan')); ?></th>
                                <th><?php echo e(__('Billing cycle')); ?></th>
                                <th><?php echo e(__('Price')); ?></th>
                                <th><?php echo e(__('Paid amount')); ?></th>
                                <th><?php echo e(__('Payment status')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <?php if($invoice->refund_date): ?>
                                <th><?php echo e(__('Refund date')); ?></th>
                                <?php endif; ?>
                            </tr>
                            <tr class="text-center">
                                <td>1</td>
                                <td class="text-capitalize"><?php echo e(__($plan->name)); ?></td>
                                <td><?php echo e($validity); ?></td>
                                <td>$<?php echo e(number_format($pricing->price, 2)); ?> <?php echo e($invoice->currency); ?></td>
                                <td>$<?php echo e($invoice->amount !== null ? number_format($invoice->amount, 2) : 'NA'); ?> <?php echo e($invoice->currency); ?>

                                </td>
                                <td class="text-capitalize"><?php echo e(__($invoice->payment_status)); ?></td>
                                <td class="text-capitalize"><?php echo e($invoice->created_at); ?></td>
                                <?php if($invoice->refund_date): ?>
                                <td><?php echo e($invoice->refund_date); ?></td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </div>

                    <?php if((env('APP_ENV') !== 'demo') && $invoice->payment_status == "paid"): ?>
                    <div class="text-md-right mt-4">
                        
                    <?php if($invoice->transaction_id !== null): ?>
                    <a class="btn btn-custom btn-icon icon-left float-right ml-1"
                        onclick="return confirm('Are you sure?')" href="<?php echo e(route('refund', $invoice->uuid)); ?>"><i
                            class="fas fa-times"></i> <?php echo e(__('Refund Order')); ?></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<br>


</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/invoices/show.blade.php ENDPATH**/ ?>