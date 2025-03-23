<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Gateway')); ?></h1>
    <div class="section-header-breadcrumb">
        
        <div class="breadcrumb-item"><a href="<?php echo e(route('gateways.index')); ?>"><?php echo e(__('Gateway')); ?></a>
        </div>
        <div class="breadcrumb-item"><?php echo e(__('Available Gateways')); ?></div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block"><?php echo e(__('Available Gateways')); ?></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                    <th><?php echo e(__('Gateway')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="gateway-table">


                                    <td class="text-center">
                                        <?php if($gateway->name == 'paypal'): ?>
                                        <img src="/images/paypal.svg" alt="PayPal" class="gateway-logo" />
                                        <?php elseif($gateway->name == 'stripe'): ?>
                                        <img src="/images/stripe.svg" alt="Stripe" class="gateway-logo" />
                                        <?php elseif($gateway->name == 'mollie'): ?>
                                        <img src="/images/mollie.svg" alt="Mollie" class="gateway-logo" />
                                    </td>
                                    <?php endif; ?>

                                    <td class="text-center">
                                        <?php if($gateway->status == true): ?>
                                        <i class="fa fa-check fa-2x text-success-dark" title="<?php echo e(__('Active')); ?>"></i>
                                        <?php else: ?>
                                        <i class="fa fa-times fa-2x text-danger" title="<?php echo e(__('Inactive')); ?>"></i>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center">
                                        <a href="<?php echo e(route('gateways.edit', [$gateway->id])); ?>">
                                            <?php echo e(__('View and Edit')); ?></a>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/gateway/index.blade.php ENDPATH**/ ?>