<?php if(!$availableAddress): ?>
<div class="alert alert-warning demo-alert text-center" role="alert">
    <strong><?php echo e(__('Note')); ?>: </strong><?php echo e(__('Billing address should be added')); ?>.<a
        href="<?php echo e(route('billing_address.create')); ?>" class="text-primary">
         <?php echo e(__('Click here to add')); ?>.</a>
</div>
<?php endif; ?>
<?php if(!$activeGateway): ?>
<div class="alert alert-warning demo-alert text-center" role="alert">
    <strong><?php echo e(__('Note')); ?>: </strong><?php echo e(__('At least one gateway should be activated')); ?>.<a
        href="<?php echo e(route('gateways.index')); ?>" class="text-primary">
         <?php echo e(__('Click here to activate')); ?>.</a>
</div>
<?php endif; ?><?php /**PATH /srv/app/resources/views/common/admin.blade.php ENDPATH**/ ?>