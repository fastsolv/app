<?php if(!$existPlan): ?>
<div class="alert alert-warning demo-alert text-center" role="alert">
    <strong><?php echo e(__('Note')); ?>: </strong><?php echo e(__('Please subscribe to a plan')); ?>.<a
        href="<?php echo e(route('plan_details.index')); ?>" class="text-primary">
         <?php echo e(__('Click here')); ?>.</a>
</div>
<?php endif; ?><?php /**PATH /srv/app/resources/views/common/user.blade.php ENDPATH**/ ?>