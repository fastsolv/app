<?php $__env->startSection('content'); ?>

<div class="col-lg-10 offset-lg-1">
<div class="section-header">
    <h1><a href="<?php echo e(route('get_tickets')); ?>"><i class="fas fa-arrow-circle-left custom-back"></i></a>
        <?php echo e(__('Open Ticket')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo e(route('get_tickets')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
        <div class="breadcrumb-item"><?php echo e(__('Open ticket')); ?></div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Open Ticket')); ?></h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('ticket.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div>
                            <?php if(Auth::check()): ?>
                             <?php if($products): ?>
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Product')); ?>:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" id="product_id" name="product_id">
                                    <option value=""><?php echo e(__('None')); ?></option>
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(old('product_id') == $product->uuid): ?>
                                        <option  value="<?php echo e($product->uuid); ?>">
                                            <?php echo e(__($product->product_name)); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo e($product->uuid); ?>"><?php echo e(__($product->product_name)); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <!-- <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        <?php echo e(__('Here you need to select the department to wich the ticket should be assigned')); ?>.
                                        <br>
                                    </small> -->
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Department')); ?>:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" id="department" name="department_id">
                                        <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(old('department_id') == $department->id): ?>
                                        <option selected value="<?php echo e($department->id); ?>">
                                            <?php echo e(__($department->name)); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo e($department->id); ?>"><?php echo e(__($department->name)); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        <?php echo e(__('Here you need to select the department to wich the ticket should be assigned')); ?>.
                                        <br>
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Priority')); ?>:*</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric" id="urgency" name="ticket_urgency_id">
                                        <?php $__currentLoopData = $ticketUrgency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urgency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(old('ticket_urgency_id') == $urgency->id): ?>
                                        <option selected value="<?php echo e($urgency->id); ?>"><?php echo e(__($urgency->name)); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo e($urgency->id); ?>"><?php echo e(__($urgency->name)); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <small class="form-text text-muted"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        <?php echo e(__('Here you need to select the priority of your ticket')); ?>.
                                        <br>
                                    </small>
                                </div>
                            </div>

                            <input type="hidden" name="opened_user_id" value="<?php echo e($user_id); ?>" />

                            <input type="hidden" name="ticket_user_id" value="<?php echo e($user_id); ?>" />
                            <input type="hidden" name="opened_user_id" value="<?php echo e($user_id); ?>" />
                            <input type="hidden" name="opened_by" value="user" />
                            <?php endif; ?>
                            
                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Subject')); ?>:</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="title" type="text"
                                        class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="title"
                                        value="<?php echo e(old('title')); ?>" autocomplete="title" autofocus>
                                    <?php $__errorArgs = ['title'];
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
                                    <textarea id="ticket_message"
                                        class="summernote <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="message"><?php echo e(old('message')); ?></textarea>
                                    <?php $__errorArgs = ['message'];
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

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('(Attach multiple files.)')); ?>:</label>
                            <div class="col-sm-12 col-md-7">
                                <input id="input-2" name="attachments[]" type="file" class="form-control file" multiple
                                    data-show-upload="true" data-show-caption="true">
                                <?php $__errorArgs = ['attachments.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger pt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <small class="text-success"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                    <?php echo e(__('The attachments must be a file of type: ')); ?><?php echo e($extension); ?>.
                                </small>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="submit" class="btn btn-custom"><?php echo e(__('Add')); ?></button>
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
<?php echo $__env->make( 
        ($theme =="white") ? 'tenant.layouts.white_user_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_user_theme':
    (($theme =="green") ? 'tenant.layouts.green_user_theme':
    (($theme =="black") ? 'tenant.layouts.black_user_theme':
    (($theme =="blue") ?'tenant.layouts.blue_user_theme' :   'tenant.layouts.yellow_user_theme'))))
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/tenant/ticket/user/create.blade.php ENDPATH**/ ?>