<?php $__env->startSection('content'); ?>
<div class="section-header col-md-10 offset-md-1">
    <h1><?php echo e(__('Subdomain Set Up')); ?></h1>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-md-10 offset-md-1 mb-4">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="hero align-items-center bg-custom text-white">
                <div class="hero-inner text-center">
                    <h2><?php echo e(__('Please choose your subdomain')); ?></h2>
                    <p class="lead"><?php echo e(__('You have successfully registered with our system. Next, you can register your subdomain from here')); ?>.</p>

                    <div class="mt-4">
                        <form method="POST" action="<?php echo e(route('domainRegister')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row mb-4">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-7">
                                            <input id="sub_domain" type="text"
                                                class="form-control <?php $__errorArgs = ['sub_domain'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                name="sub_domain" value="<?php echo e(old('sub_domain')); ?>"
                                                autocomplete="sub_domain" placeholder="Choose your subdomain">
                                            <?php $__errorArgs = ['sub_domain'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger pt-1 font-800"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-5">
                                            <input id="domain" type="text" name="domain" class="form-control"
                                                value=".<?php echo e($central); ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-outline-white"><i
                                            class="fas fa-sign-in-alt"></i> <?php echo e(__('Update')); ?></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('central.layouts.new_user_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/domain/register.blade.php ENDPATH**/ ?>