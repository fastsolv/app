<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Plans')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href=""><?php echo e(__('Dashboard')); ?></a></div>
        <div class="breadcrumb-item"><a href=""><?php echo e(__('Plans')); ?></a></div>
        <div class="breadcrumb-item"><?php echo e(__('Plans')); ?></div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Add Plans')); ?></h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('plans.store')); ?>">
                        <?php echo csrf_field(); ?>

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
                                        value="<?php echo e(old('name')); ?>" autocomplete="name" autofocus>
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
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Description')); ?>:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea id="description"
                                        class="form-control height-auto <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('description')); ?>"
                                        name="description"><?php echo e(old('description')); ?></textarea>
                                    <?php $__errorArgs = ['description'];
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
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Department Count')); ?>:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="row">
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="departments"
                                                id="unlimited_departments" value="">
                                            <label class="custom-control-label" for="unlimited_departments">
                                                <?php echo e(__('Unlimited')); ?>

                                            </label>
                                        </div>
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="departments"
                                                id="limited_departments" value="1" checked>
                                            <label class="custom-control-label" for="limited_departments">
                                                <input type="text"
                                                    class="form-control <?php $__errorArgs = ['department_count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="department_count" value="<?php echo e(old('department_count')); ?>"
                                                    autocomplete="department_count" autofocus>
                                                <?php $__errorArgs = ['department_count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger pt-1"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </label>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Staff Count')); ?>:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="row">
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="staff"
                                                id="unlimited_staff" value="">
                                            <label class="custom-control-label" for="unlimited_staff">
                                                <?php echo e(__('Unlimited')); ?>

                                            </label>
                                        </div>
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="staff"
                                                id="limited_staff" value="1" checked>
                                            <label class="custom-control-label" for="limited_staff">
                                                <input type="text"
                                                    class="form-control <?php $__errorArgs = ['staffs_qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="staffs_qty" value="<?php echo e(old('staffs_qty')); ?>"
                                                    autocomplete="staffs_qty" autofocus>
                                            </label>
                                            <?php $__errorArgs = ['staffs_qty'];
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
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Users Count')); ?>:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="row">
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="users"
                                                id="unlimited_users" value="">
                                            <label class="custom-control-label" for="unlimited_users">
                                                <?php echo e(__('Unlimited')); ?>

                                            </label>
                                        </div>
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="users"
                                                id="limited_users" value="1" checked>
                                            <label class="custom-control-label" for="limited_users">
                                                <input type="text"
                                                    class="form-control <?php $__errorArgs = ['user_qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="user_qty" value="<?php echo e(old('user_qty')); ?>"
                                                    autocomplete="user_qty" autofocus>
                                            </label>
                                            <?php $__errorArgs = ['user_qty'];
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
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Tickets Count')); ?>:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="row">
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="tickets"
                                                id="unlimited_tickets" value="">
                                            <label class="custom-control-label" for="unlimited_tickets">
                                                <?php echo e(__('Unlimited')); ?>

                                            </label>
                                        </div>
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="tickets"
                                                id="limited_tickets" value="1" checked>
                                            <label class="custom-control-label" for="limited_tickets">
                                                <input type="text"
                                                    class="form-control <?php $__errorArgs = ['ticket_qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="ticket_qty" value="<?php echo e(old('ticket_qty')); ?>"
                                                    autocomplete="ticket_qty" autofocus>
                                            </label>
                                            <?php $__errorArgs = ['ticket_qty'];
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
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Require Payment')); ?>:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="row">
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="Requirepayment_website"
                                                id="unlimited_Requirepayment" value="1"
                                                >
                                            <label class="custom-control-label" for="unlimited_Requirepayment">
                                                <?php echo e(__('True')); ?>

                                            </label>
                                        </div>
                                        <div class="custom-radio custom-control ml-3">
                                            <input class="custom-control-input" type="radio" name="Requirepayment_website"
                                                id="limited_Requirepayment" value="0"
                                               >
                                                <label class="custom-control-label" for="limited_Requirepayment">
                                                    <?php echo e(__('False')); ?>

                                                </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="address"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Display Order')); ?>:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="display_order" type="text"
                                        class="form-control <?php $__errorArgs = ['display_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="display_order" value="<?php echo e(old('display_order')); ?>"
                                        autocomplete="display_order" autofocus>
                                    <?php $__errorArgs = ['display_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger pt-1"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <small class="text-secondary"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        <?php echo e(__('You can enter a number that represents the display order of the plan to users')); ?>

                                    </small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Status')); ?>:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="custom-radio custom-control">
                                        <input class="custom-control-input" type="radio" name="status" id="planEnable"
                                            value=1 checked>
                                        <label class="custom-control-label" for="planEnable">
                                            <?php echo e(__('Enable')); ?>

                                        </label>
                                    </div>
                                    <div class="custom-radio custom-control">
                                        <input class="custom-control-input" type="radio" name="status" id="planDisable"
                                            value=0>
                                        <label class="custom-control-label" for="planDisable">
                                            <?php echo e(__('Disable')); ?>

                                        </label>
                                    </div>
                                    <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        <?php echo e(__('Enable to activate this plan')); ?>.
                                        <br>
                                    </small>
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
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/plans/create.blade.php ENDPATH**/ ?>