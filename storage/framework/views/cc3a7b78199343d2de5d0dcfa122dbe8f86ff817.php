<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Billing Address')); ?></h1>
    <div class="section-header-breadcrumb">
        
        <div class="breadcrumb-item"><?php echo e(__('Billing Address')); ?></div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if($address == null): ?>
            <div class="card  bg-custom-light">
                <div class="hero align-items-center text-danger">
                    <div class="hero-inner text-center">
                        <h2><?php echo e(__('No Billing Address Found')); ?></h2>
                        <p class="lead">
                            <?php echo e(__('You can add a billing address with the below link')); ?>.
                        </p>
                        <div class="mt-4">
                            <a href="<?php echo e(route('billing_address.create')); ?>" class="btn btn-outline-custom btn-lg btn-icon icon-left"><i
                                    class="fas fa-sign-in-alt"></i> <?php echo e(__('Add Billing Address')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block"><?php echo e(__('Billing Address')); ?></h4>
                    <a href="<?php echo e(route('billing_address.create')); ?>" class="btn btn-icon btn-custom float-right inline-block"><i
                            class="far fa-edit"></i><?php echo e(__('Update')); ?></a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="frist_name"><?php echo e(__('Company name')); ?></label>
                            <input id="name" type="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="name" value="<?php echo e($address !== null ? $address->name : ''); ?>" required
                                autocomplete="name" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name"><?php echo e(__('Phone no.')); ?></label>
                            <input id="phone" type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="phone" value="<?php echo e($address !== null ? $address->phone : ''); ?>" autocomplete="phone"
                                readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="address_1"><?php echo e(__('Address line 1')); ?></label>
                            <textarea class="form-control" id="address_1" name="address_1" autocomplete="address_1"
                                autofocus readonly><?php echo e($address !== null ? $address->address_1 : ''); ?></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="address_2"><?php echo e(__('Address line 2')); ?></label>
                            <textarea class="form-control" id="address_2" name="address_2" autocomplete="address_2"
                                autofocus readonly><?php echo e($address !== null ? $address->address_2 : ''); ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label><?php echo e(__('City')); ?></label>
                            <input id="city" type="city" class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="city" value="<?php echo e($address !== null ? $address->city : ''); ?>" required
                                autocomplete="city" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label><?php echo e(__('Postal/zip code')); ?></label>
                            <input id="postal_code" type="text"
                                class="form-control <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="postal_code"
                                value="<?php echo e($address !== null ? $address->postal_code : ''); ?>" readonly
                                autocomplete="postal_code">
                        </div>
                    </div>

                    <div id="app1">
                        <div class="row">
                            <div class="form-group col-6">
                                <label><?php echo e(__('Country')); ?></label>
                                <input type="hidden" ref="country_ref" id="country_ref_id" value="" name="country" />
                                <input id="country" type="text"
                                    class="form-control <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="country"
                                    value="<?php echo e($address !== null ? $address->countries->name : ''); ?>" readonly
                                    autocomplete="country">
                            </div>
                            <div class="form-group col-6">
                                <label><?php echo e(__('State')); ?>*</label>
                                <input id="state" type="text" class="form-control <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="state" value="<?php echo e($address !== null ? $address->states->name : ''); ?>" readonly
                                    autocomplete="state">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/address/index.blade.php ENDPATH**/ ?>