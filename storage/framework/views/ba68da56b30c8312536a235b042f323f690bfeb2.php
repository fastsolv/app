<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Settings')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
        <div class="breadcrumb-item"><?php echo e(__('Settings')); ?></div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block"><?php echo e(__('Settings')); ?></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Value')); ?></th>
                                     <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-capitalize"><?php echo e(str_replace("_", " ", __($setting->name))); ?></td>
                                        <td>
                                        <?php if($setting->value != null): ?>
                                            <?php if($setting->type == 'radio'): ?>
                                            <?php if(($setting->value) == '1'): ?>
                                            <span class="text-success-dark"><?php echo e(__('Enabled')); ?></span>
                                            <?php elseif(($setting->value) == '0'): ?>
                                            <span class="text-danger"><?php echo e(__('Disabled')); ?></span>
                                            <?php endif; ?>
                                            <?php elseif($setting->type == 'attachment'): ?>
                                            <img src="/system_logo/<?php echo e(__($setting->value)); ?>" height="30px" width="180px" />
                                            <?php else: ?>
                                            <?php echo Str::limit(strip_tags($setting->value), 60); ?>

                                            <?php endif; ?>
                                        <?php else: ?>
                                        <i class="text-secondary"><?php echo e(__('Null')); ?></i>
                                        <?php endif; ?>
                                        </td>
                                        <td class="justify-content-center form-inline">
                                            <a href="<?php echo e(route('admin_settings.edit', [$setting->id])); ?>"
                                                class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                    aria-hidden="true" title="<?php echo e(__('Edit')); ?>"></i></a>
                                        </td>
                                    </tr>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/settings/index.blade.php ENDPATH**/ ?>