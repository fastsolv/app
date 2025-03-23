<?php $__env->startSection('content'); ?>

<div class="section-header text-capitalize shadow-none">
    <h1><?php echo e(__('Email Templates')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
        <div class="breadcrumb-item"><?php echo e(__('Email templates')); ?></div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><?php echo e(__('System Templates')); ?>

                        </div>
                        <div class="card-body">

                            <?php if(!count($system_emails)): ?>
                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon bg-danger">
                                        <i class="fas fa-question"></i>
                                    </div>
                                    <h2><?php echo e(__('No data found')); ?> !!</h2>
                                    <p class="lead">
                                        <?php echo e(__('Sorry we cant find any data, to get rid of this message, make at least 1 entry')); ?>.
                                    </p>
                                </div>
                            </div>

                            <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr class="text-center text-capitalize">
                                            <th><?php echo e(__('Name')); ?></th>
                                            <th><?php echo e(__('Status')); ?></th>
                                            <?php if($show_edit_button): ?>
                                            <th></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $system_emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="text-capitalize">
                                            <td><?php echo e(str_replace("_", " ", __($email->name))); ?></td>

                                            <?php if(($email->status) == true): ?>
                                            <td class="text-success"><?php echo e(__('enable')); ?></td>
                                            <?php else: ?>
                                            <td class="text-danger"><?php echo e(__('desable')); ?></td>
                                            <?php endif; ?>
                                            <?php if($show_edit_button): ?>
                                            <td class="justify-content-center form-inline">
                                                <a href="<?php echo e(route('email_template.edit', [$email->uuid])); ?>"
                                                    class="btn btn-sm bg-transparent"><i
                                                        class="far fa-edit text-primary" aria-hidden="true"
                                                        title="<?php echo e(__('Edit')); ?>"></i></a>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><?php echo e(__('Custom Templates')); ?>

                            <?php if($show_add_button): ?>
                                <small>
                                    <a href="<?php echo e(route('email_template.create')); ?>"
                                        class="btn btn-custom  float-right add_button"><?php echo e(__('Add')); ?></a>
                                </small>
                            <?php endif; ?></h4>
                        </div>
                        <div class="card-body">

                            <?php if(!count($custom_emails)): ?>
                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon bg-danger">
                                        <i class="fas fa-question"></i>
                                    </div>
                                    <h2><?php echo e(__('No data found')); ?> !!</h2>
                                    <p class="lead">
                                        <?php echo e(__('Sorry we cant find any data, to get rid of this message, make at least 1 entry')); ?>.
                                    </p>
                                    <a href="<?php echo e(route('email_template.create')); ?>"
                                        class="btn btn-custom mt-4"><?php echo e(__('Create new One')); ?></a>
                                </div>
                            </div>

                            <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr class="text-center text-capitalize">
                                            <th><?php echo e(__('Name')); ?></th>
                                            <th><?php echo e(__('Status')); ?></th>
                                            <?php if($show_edit_button || $show_delete_button): ?>
                                            <th></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $custom_emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="text-capitalize">
                                            <td><?php echo e(str_replace("_", " ", __($email->name))); ?></td>

                                            <?php if($email->status == true): ?>
                                            <td class="text-success"><?php echo e(__('enable')); ?></td>
                                            <?php else: ?>
                                            <td class="text-danger"><?php echo e(__('desable')); ?></td>
                                            <?php endif; ?>
                                            <?php if($show_edit_button || $show_delete_button): ?>
                                            <td class="justify-content-center form-inline">
                                            <?php if($show_edit_button ): ?>
                                                <a href="<?php echo e(route('email_template.edit', [$email->uuid])); ?>"
                                                    class="btn btn-sm bg-transparent"><i
                                                        class="far fa-edit text-primary" aria-hidden="true"
                                                        title="<?php echo e(__('Edit')); ?>"></i></a><?php endif; ?> 
                                                        <?php if($show_delete_button): ?>
                                                <form action="<?php echo e(route('email_template.destroy', [$email->uuid])); ?>"
                                                    method="POST">
                                                    <?php echo method_field('DELETE'); ?>
                                                    <?php echo csrf_field(); ?>
                                                    <button class="btn btn-sm bg-transparent"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="fa fa-trash text-danger" aria-hidden="true"
                                                            title="<?php echo e(__('Delete')); ?>"></i>
                                                    </button>
                                                </form>
                                                <?php endif; ?>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
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
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/tenant/email_template/index.blade.php ENDPATH**/ ?>