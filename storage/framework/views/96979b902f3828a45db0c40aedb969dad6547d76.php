<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Pricing')); ?></h1>
    <div class="section-header-breadcrumb">
        
    <div class="breadcrumb-item"><a href="<?php echo e(route('pricing.index')); ?>"><?php echo e(__('Pricing')); ?></a></div>
    <div class="breadcrumb-item"><?php echo e(__('Edit Pricing')); ?></div>
</div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Edit Pricing')); ?></h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?php echo e(route('plans.edit', [$plan_id])); ?>"></i><span><?php echo e(__('Edit')); ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active"
                                href="<?php echo e(route('pricing_index', [$plan_id])); ?>"><span><?php echo e(__('Pricing')); ?></span></a>
                        </li>
                    </ul>
                    <div class="user-ticket-divider"></div>
                    <div class="tab-content pt-3" id="myTabContent">
                        <form method="POST" action="<?php echo e(route('pricing.update', [$price->id])); ?>">
                            <?php echo csrf_field(); ?>
                            <input name="_method" type="hidden" value="PUT">
                            <div>
                                <div class="form-group row mb-4">
                                    <label for="address"
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Price in ' )); ?> <?php echo e($price->period); ?> (<?php echo e($price->currencies->currency); ?>):*</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="price" type="text"
                                            class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="price"
                                            value="<?php echo e(old('price', $price->price)); ?>" autocomplete="price" autofocus>
                                        <?php $__errorArgs = ['price'];
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
                                        <button type="submit" class="btn btn-custom"> <?php echo e(__('Update')); ?></button>
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
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/pricing/edit.blade.php ENDPATH**/ ?>