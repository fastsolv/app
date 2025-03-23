<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Billing Address')); ?></h1>
    <div class="section-header-breadcrumb">
        
        <div class="breadcrumb-item active"><a
                href="<?php echo e(route('billing_address.index')); ?>"><?php echo e(__('Billing Address')); ?></a></div>
        <div class="breadcrumb-item"><?php echo e(__('Update Address')); ?></div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block"><?php echo e(__('Update Billing Address')); ?></h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('billing_address.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="frist_name"><?php echo e(__('Company name')); ?>*</label>
                                <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="name" value="<?php echo e(old('name', $address !== null ? $address->name : '')); ?>"
                                    autocomplete="name">

                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                    name="phone" value="<?php echo e(old('phone', $address !== null ? $address->phone : '')); ?>"
                                    autocomplete="phone">

                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address_1"><?php echo e(__('Address line 1')); ?>*</label>
                                <textarea class="form-control <?php $__errorArgs = ['address_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="address_1"
                                    name="address_1"
                                    autocomplete="address_1"><?php echo e(old('address_1', $address !== null ? $address->address_1 : '')); ?></textarea>

                                <?php $__errorArgs = ['address_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="address_2"><?php echo e(__('Address line 2')); ?></label>
                                <textarea class="form-control <?php $__errorArgs = ['address_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="address_2"
                                    name="address_2"
                                    autocomplete="address_2"><?php echo e(old('address_2', $address !== null ? $address->address_2 : '')); ?></textarea>

                                <?php $__errorArgs = ['address_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label><?php echo e(__('City')); ?>*</label>
                                <input id="city" type="city" class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="city" value="<?php echo e(old('city', $address !== null ? $address->city : '')); ?>"
                                    required autocomplete="city">

                                <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group col-6">
                                <label><?php echo e(__('Postal/zip code')); ?>*</label>
                                <input id="postal_code" type="text"
                                    class="form-control <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="postal_code"
                                    value="<?php echo e(old('postal_code', $address !== null ? $address->postal_code : '')); ?>"
                                    required autocomplete="postal_code">

                                <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div id="app1">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label><?php echo e(__('Country')); ?>*</label>
                                    <input type="hidden" class="form-control <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        ref="country_ref" id="country_ref_id" value="" name="country" />
                                    <v-select :options="options" @search="onSearch" v-model="selected_country"
                                        :reduce="country => country.id" @input="chooseMe" label="name">
                                    </v-select>
                                    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <small id="port_help1" class="form-text text-muted"><i
                                            class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        <?php echo e(__('Country should be outside india for non-INR transactions')); ?>

                                    </small>
                                </div>
                                <div class="form-group col-6">
                                    <label><?php echo e(__('State')); ?>*</label>
                                    <input type="hidden" class="form-control <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        ref="state_ref" id="state_ref_id" value="" name="state" />
                                    <v-select :options="stateOptions" @search="onSearchState" v-model="selected_state"
                                        @input="chooseMeState" label="name" :reduce="state => state.id">
                                    </v-select>
                                    <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-2 row float-right">
                            <div>
                                <button type="submit" class="btn btn-custom"><?php echo e(__('Update')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($address !== null): ?>
<script>
    var country_id = "<?php echo e($address->country_id); ?>";
    var state_id = "<?php echo e($address->state_id); ?>";
    var country_name = "<?php echo e($address->countries->name); ?>";
    var state_state = "<?php echo e($address->states->name); ?>";
    var country_api_url = '<?php echo url("/countries"); ?>';
    var state_api_url = '<?php echo url("/states"); ?>';
</script>
<?php else: ?>
<script>
    var country_id = null;
    var state_id = null;
    var country_name = null;
    var state_state = null;
    var country_api_url = '<?php echo url("/countries"); ?>';
    var state_api_url = '<?php echo url("/states"); ?>';
</script>
<?php endif; ?>
<script src="<?php echo e(asset('js/country-state.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/address/create.blade.php ENDPATH**/ ?>