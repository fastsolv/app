<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Settings')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
        <div class="breadcrumb-item"><a href="<?php echo e(route('admin_settings.index')); ?>"><?php echo e(__('Settings')); ?></a>
        </div>
        <div class="breadcrumb-item text-capitalize"><?php echo e(__('Add')); ?> <?php echo e(str_replace("_", " ", __("$name"))); ?></div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="text-capitalize"><?php echo e(__('Add')); ?> <?php echo e(str_replace("_", " ", __("$name"))); ?></h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('admin_settings.update', $id)); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input name="_method" type="hidden" value="PUT">

                        <div>
                            <div class="form-group row mb-4">
                                <label for="address"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Name')); ?>*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="name" type="text"
                                        class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name"
                                        value="<?php echo e(__($name)); ?>" autocomplete="name" autofocus readonly>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger pt-1"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3 text-capitalize"><?php echo e(str_replace("_", " ", __("$name"))); ?>:</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="icon" name="attachment" type="file" class="form-control file"
                                        data-show-caption="true" value="<?php echo e(__($value)); ?>" autocomplete="value"
                                        autofocus>
                                    <?php $__errorArgs = ['attachment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger pt-1"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        <?php echo e(__($description)); ?>.
                                        <br>
                                    </small>
                                </div>
                            </div>

                            <?php if(env('APP_ENV') != 'demo'): ?>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-custom"><?php echo e(__('Update')); ?></button>
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
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/settings/attachment.blade.php ENDPATH**/ ?>