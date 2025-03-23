<?php $__env->startSection('content'); ?>
<div class="row text-center">
    <div class="col-sm-6 col-sm-offset-3">
        <br><br>
        <h2><i class="far fa-5x fa-check-circle text-success"></i></h2>
        <h1 class="bg-response"><?php echo e(__('Success')); ?></h1>
        <h3><?php echo e(__('Dear')); ?>, <?php echo e(Auth::user()->first_name); ?></h3>
        <?php if($order): ?>
        <h3 class="payment-success"><?php echo e(__('Your order is successfuly placed')); ?>!</h3>
        <h4 class="payment-success"><?php echo e(__('order ID')); ?> : #<?php echo e($order->order_id); ?></h4>
        <?php else: ?>
        <h3 class="payment-success"><?php echo e(__('Your order is successfuly placed')); ?>!</h3>
        <?php endif; ?>
        <br><br>
        <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-lg btn-success"><?php echo e(__('Return Home')); ?></a>
    </div>
</div>
<?php $__env->stopSection(); ?>

</html>
<?php echo $__env->make('central.layouts.gateway', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/gateway/success.blade.php ENDPATH**/ ?>