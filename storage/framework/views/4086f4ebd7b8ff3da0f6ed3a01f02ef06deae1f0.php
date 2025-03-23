<?php $__env->startSection('content'); ?>
    <div id="tenant.layoutsidenav_content">
        <main>
            <div class="container-fluid p-3">
                <div class="col-md-8 offset-2">
                    <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="card card-custom">
                        <div class="card-header"><?php echo e(__('Verify Your Email Address')); ?></div>

                        <div class="card-body">
                            <?php if(session('resent')): ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo e(__('A fresh verification link has been sent to your email address.')); ?>

                                </div>
                            <?php endif; ?>

                            <?php echo e(__('Before proceeding, please check your email for a verification link.')); ?>

                            <?php echo e(__('If you did not receive the email')); ?>,
                            <form class="d-inline" method="POST" action="<?php echo e(route('verification.resend')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                    class="btn btn-link text-primary p-0 m-0 align-baseline"><?php echo e(__('click here to request another')); ?></button>.
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make( 
        ($theme =="white") ? 'tenant.layouts.public_white':
     ( ($theme =="red") ? 'tenant.layouts.public_red':
    (($theme =="green") ? 'tenant.layouts.public_green':
    (($theme =="black") ? 'tenant.layouts.public_black':
    (($theme =="blue") ?'tenant.layouts.public_blue':'tenant.layouts.public_yellow' ))))
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/tenant/auth/verify.blade.php ENDPATH**/ ?>