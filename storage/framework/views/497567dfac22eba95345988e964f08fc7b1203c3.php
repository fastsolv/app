<?php if($message = Session::get('success')): ?>
    <div class="alert alert-success bg-alert-custom alert-block alert-dismissible text-center">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?php echo e($message); ?></strong>
    </div>
<?php endif; ?>

<?php if($message = Session::get('error')): ?>
    <div class="alert alert-danger alert-block alert-dismissible text-center">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?php echo e($message); ?></strong>
    </div>
<?php endif; ?>

<?php if($message = Session::get('warning')): ?>
    <div class="alert alert-warning alert-block alert-dismissible text-center">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?php echo e($message); ?></strong>
    </div>
<?php endif; ?>

<?php if($message = Session::get('info')): ?>
    <div class="alert alert-info alert-block alert-dismissible text-center">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>2222<?php echo e($message); ?></strong>
    </div>
<?php endif; ?>
<?php /**PATH /srv/app/resources/views/common/errors.blade.php ENDPATH**/ ?>