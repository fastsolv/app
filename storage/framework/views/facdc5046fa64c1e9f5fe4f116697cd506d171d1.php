<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Confirm Order')); ?></h1>
    <div class="section-header-breadcrumb">
        
        <div class="breadcrumb-item"><a href="<?php echo e(route('available_plans.index')); ?>"><?php echo e(__('Pricing')); ?></a>
        </div>
        <div class="breadcrumb-item"><?php echo e(__('Checkout')); ?></div>
    </div>
</div>
<?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h3><?php echo e(__('Confirm Order')); ?></h3>
                    </div>
                    <hr>
                    <div class="row  text-capitalize">
                        <div class="col-md-6">
                            <address>
                                <strong><?php echo e(__('Billed To')); ?>:</strong><br>
                                <?php if($address !== null): ?>
                                <?php echo e($address->name); ?><br>
                                <?php echo e($address->address_1); ?><br>
                                <?php echo e($address->city); ?>, <?php echo e($address->postal_code); ?><br>
                                <?php echo e($address->states->name ?? ''); ?>, <?php echo e($address->countries->name ?? ''); ?>

                                <?php endif; ?>
                            </address>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <address>
                                <strong><?php echo e(__('Shipped To')); ?>:</strong><br>
                                <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?><br>
                                <?php echo e($user->address_1); ?><br>
                                <?php echo e($user->city); ?>, <?php echo e($user->postal_code); ?><br>
                                <?php echo e($user->states->name ?? ''); ?>, <?php echo e($user->countries->name ?? ''); ?>

                            </address>
                            <address>
                                <strong><?php echo e(__('Order Date')); ?>:</strong><br>
                                <?php echo e($order_date); ?><br><br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="section-title"><?php echo e(__('Order Summary')); ?></div>
                    <p class="section-lead"><?php echo e(__('Price is inclusive of taxes')); ?>.</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-md">
                            <tr>
                                <th data-width="40">#</th>
                                <th><?php echo e(__('Plan')); ?></th>
                                <th><?php echo e(__('Periode')); ?></th>
                                <th class="text-center"><?php echo e(__('Price')); ?></th>
                                <th class="text-right"><?php echo e(__('Totals')); ?></th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td class="text-capitalize"><?php echo e(__($plan->name)); ?></td>
                                <td class="text-capitalize"><?php echo e(__($pricing->term)); ?> <?php echo e(__($pricing->period)); ?></td>
                                <td class="text-center"><?php echo e($pricing->currencies->prefix); ?><?php echo e(number_format($pricing->price, 2)); ?></td>
                                <td class="text-right"><?php echo e($pricing->currencies->prefix); ?><?php echo e(number_format($pricing->price, 2)); ?></td>
                            </tr>
                        </table>
                    </div>

                    <form method="POST" action="<?php echo e(route('processOrder', [$pricing->id])); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row mt-2">
                            <?php if($pricing->price !== 0.00): ?>
                            <div class="col-8">
                                <div class="section-title"><?php echo e(__('Payment Method')); ?></div>
                                <p class="section-lead"><?php echo e(__('The payment method that we provide is to make it easier')); ?> <br><?php echo e(__('for you to pay invoices')); ?>.</p>
                                <div class="ml-5">
                                    <div class="custom-radio custom-control pt-2">
                                        <input class="custom-control-input" type="radio" name="gateway" id="paypal"
                                            value="paypal" checked>
                                        <label class="custom-control-label" for="paypal">
                                            <img src="/images/paypal.svg" alt="PayPal" class="gateway-logo-1" />
                                        </label>
                                    </div>
                                    <div class="custom-radio custom-control pt-4">
                                        <input class="custom-control-input" type="radio" name="gateway" id="stripe"
                                            value="stripe">
                                        <label class="custom-control-label" for="stripe">
                                            <img src="/images/stripe.svg" alt="Stripe" class="gateway-logo-1" />
                                        </label>
                                    </div>
                                    <div class="custom-radio custom-control pt-4">
                                        <input class="custom-control-input" type="radio" name="gateway" id="mollie"
                                            value="mollie">
                                        <label class="custom-control-label" for="mollie">
                                            <img src="/images/mollie.svg" alt="Mollie" class="gateway-logo-1" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-right mt-4 pr-4">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name"><?php echo e(__('Subtotal')); ?></div>
                                    <div class="invoice-detail-value"><?php echo e($pricing->currencies->prefix); ?><?php echo e(number_format($pricing->price, 2)); ?></div>
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name"><?php echo e(__('Offer applied')); ?></div>
                                    <div class="invoice-detail-value"><?php echo e($pricing->currencies->prefix); ?><?php echo e(number_format((($pricing->price)-($price)), 2)); ?></div>
                                </div>
                                <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name"><?php echo e(__('Total')); ?></div>
                                    <div class="invoice-detail-value invoice-detail-value-lg"><?php echo e($pricing->currencies->prefix); ?><?php echo e(number_format($price, 2)); ?></div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <?php if(env('APP_ENV') != 'demo'): ?>
                        <div class="text-md-right mt-4">
                            <div class="float-left ml-5">
                                <button class="btn btn-custom btn-icon icon-left"><i class="fas fa-credit-card"></i>
                                    <?php echo e(__('Process Order')); ?></button>
                            </div>

                            <a class="btn btn-danger btn-icon icon-left float-left ml-1"
                                href="<?php echo e(route('available_plans.index')); ?>"><i class="fas fa-times"></i> <?php echo e(__('Cancel')); ?></a>
                        </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>


</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_user_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/add_plan/invoice.blade.php ENDPATH**/ ?>