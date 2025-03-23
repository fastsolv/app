<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Currencies')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href=""><?php echo e(__('Dashboard')); ?></a></div>
        <div class="breadcrumb-item"><a href=""><?php echo e(__('Currencies')); ?></a></div>
        <div class="breadcrumb-item"><?php echo e(__('Edit Currency')); ?></div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Edit Currency')); ?></h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('currency.update', [$currency->id])); ?>">
                        <?php echo csrf_field(); ?>
                        <input name="_method" type="hidden" value="PUT">

                        <div>

                            <div class="form-group row mb-4">
                                <label for="address"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Currency')); ?>:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="currency" type="text"
                                        class="form-control <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="currency"
                                        value="<?php echo e(old('currency', $currency->currency)); ?>" autocomplete="currency" autofocus>
                                    <?php $__errorArgs = ['currency'];
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
                                <label for="prefix"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Prefix')); ?>:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="prefix" type="text"
                                        class="form-control <?php $__errorArgs = ['prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="prefix"
                                        value="<?php echo e(old('currency', $currency->currency)); ?>" autocomplete="prefix">
                                    <?php $__errorArgs = ['prefix'];
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

                            <?php if(env('APP_ENV') != 'demo'): ?>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-custom"> <?php echo e(__('Add')); ?></button>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/currency/edit.blade.php ENDPATH**/ ?>