<?php $__env->startSection('content'); ?>

<div class="section-header shadow-none">
    <h1><?php echo e(__('Theme Settings ')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>

        <div class="breadcrumb-item"><?php echo e(__('Edit Theme Settings')); ?></div>
    </div>
</div>

<div class="section-body">
   

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
              
                <div class="card-body text-capitalize">
                <form method="POST" action="<?php echo e(route('settings.update', 9)); ?>">
                        <?php echo csrf_field(); ?>
                        <input name="_method" type="hidden" value="PUT"> <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Theme')); ?>:*</label>
                            <div class="col-sm-12 col-md-7">
                           
                        <select class="form-control selectric " id="value" name="value">
                        
                          <option value="blue" <?php if($setting->value=='blue'): ?> selected='selected' <?php endif; ?> ><?php echo e(__('Blue')); ?></option>
                          <option value="green" <?php if($setting->value=='green'): ?> selected='selected' <?php endif; ?> ><?php echo e(__('Green')); ?></option>
                          <option value="red" <?php if($setting->value=='red'): ?> selected='selected' <?php endif; ?> ><?php echo e(__('Red')); ?></option>
                          <option value="black" <?php if($setting->value=='black'): ?> selected='selected' <?php endif; ?> ><?php echo e(__('Black')); ?></option>
                          <option value="white" <?php if($setting->value=='white'): ?> selected='selected' <?php endif; ?> ><?php echo e(__('White')); ?></option>
                          <option value="yellow" <?php if($setting->value=='yellow'): ?> selected='selected' <?php endif; ?> ><?php echo e(__('yellow')); ?></option>
                     
                        </select>

                              
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
<?php echo $__env->make( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/tenant/theme/index.blade.php ENDPATH**/ ?>