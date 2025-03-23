<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Tenants')); ?></h1>
    <div class="section-header-breadcrumb">
        
        <div class="breadcrumb-item"><a href="<?php echo e(route('tenants.index')); ?>"><?php echo e(__('Tenants')); ?></a>
        </div>
        <div class="breadcrumb-item"><?php echo e(__('Update Tenant')); ?></div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Update Tenant')); ?></h4>
                </div>
                <form method="POST" action="<?php echo e(route('tenants.update', $id)); ?>">
                    <?php echo csrf_field(); ?>
                    <input name="_method" type="hidden" value="PUT">
                    <div class="mt-4">

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Status')); ?>:</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="status" id="active"
                                        value="1" <?php echo e(($status == 1)? "checked" : ""); ?>>
                                    <label class="custom-control-label" for="active">
                                        <?php echo e(__('Active')); ?>

                                    </label>
                                </div>
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="status" id="inactive"
                                        value="0" <?php echo e(($status == 0)? "checked" : ""); ?>>
                                    <label class="custom-control-label" for="inactive">
                                        <?php echo e(__('Inactive')); ?>

                                    </label>
                                </div>
                                <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                        aria-hidden="true"></i>
                                    <?php echo e(__('You can disable or enable a tenant from here')); ?>.
                                    <br>
                                </small>
                            </div>
                        </div>
                    </div>

                    <?php if(env('APP_ENV') != 'demo'): ?>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-custom"><?php echo e(__('Save changes')); ?></button>
                        </div>
                    </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/tenant/edit.blade.php ENDPATH**/ ?>