<?php $__env->startSection('content'); ?>

<div class="section-header col-12 col-md-10 offset-md-1">
    <h1><?php echo e(__('Privacy Policy')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><?php echo e(__("Updated")); ?> <?php echo e(\Carbon\Carbon::parse($updated_at)->diffForHumans()); ?>

        </div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="card">
                <div class="card-body mt-4">
                    <div class="tab-content no-padding" id="myTab2Content">
                        <div class="tab-pane show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                            <?php echo $value; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/footer/privacy_policy.blade.php ENDPATH**/ ?>