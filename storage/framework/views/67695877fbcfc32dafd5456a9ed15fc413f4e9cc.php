<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Gateway')); ?></h1>
    <div class="section-header-breadcrumb">
        
        <div class="breadcrumb-item"><a href="<?php echo e(route('gateways.index')); ?>"><?php echo e(__('Gateway')); ?></a>
        </div>
        <div class="breadcrumb-item"><?php echo e(__('Add Details')); ?></div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Add Details')); ?></h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('gateways.update', $id)); ?>">
                        <?php echo csrf_field(); ?>
                        <input name="_method" type="hidden" value="PUT">

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Name')); ?>:*</label>
                            <div class="col-sm-12 col-md-7">
                                <input id="name" type="text"
                                    class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> text-capitalize" name="name"
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

                        <?php $__currentLoopData = $gatewayDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__($details->display_name)); ?>:*</label>
                            <div class="col-sm-12 col-md-7">
                                <input id="details" type="<?php echo e($details->type); ?>"
                                    class="form-control <?php $__errorArgs = ['details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="details[<?php echo e($details->id); ?>]"
                                    value="<?php echo e($details->value == null ? "" : "$details->value"); ?>"
                                    autocomplete="details" autofocus>
                                <?php $__errorArgs = ["details.$details->id"];
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Status')); ?>:*</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="status" id="gatewayEnable"
                                        value="enable" <?php echo e($status == true ? 'checked' : ''); ?>>
                                    <label class="custom-control-label" for="gatewayEnable">
                                        <?php echo e(__('Enable')); ?>

                                    </label>
                                </div>
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="status" id="gatewayDisable"
                                        value="disable" <?php echo e($status == false ? 'checked' : ''); ?>>
                                    <label class="custom-control-label" for="gatewayDisable">
                                        <?php echo e(__('Disable')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Test mode')); ?>:*</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="test_mode" id="testEnable"
                                        value="enable" <?php echo e($test_mode == true ? 'checked' : ''); ?>>
                                    <label class="custom-control-label" for="testEnable">
                                        <?php echo e(__('Enable')); ?>

                                    </label>
                                </div>
                                <div class="custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="test_mode" id="testDisable"
                                        value="disble" <?php echo e($test_mode == false ? 'checked' : ''); ?>>
                                    <label class="custom-control-label" for="testDisable">
                                        <?php echo e(__('Disable')); ?>

                                    </label>
                                </div>
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
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/gateway/edit.blade.php ENDPATH**/ ?>