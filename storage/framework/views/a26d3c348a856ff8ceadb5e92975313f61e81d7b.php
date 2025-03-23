<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Ticket Statuses')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
        <div class="breadcrumb-item"><?php echo e(__('List of Ticket Statuses')); ?></div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block"><?php echo e(__('List of Ticket Statuses')); ?></h4>
                    <small id='main'>
                        <a href="<?php echo e(route('ticket_status.create')); ?>"
                            class="btn btn-custom float-right  add_button"><?php echo e(__('Add')); ?></a>
                    </small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if(!count($statuses)): ?>
                        <div class="empty-state pt-3" data-height="400">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2><?php echo e(__('No data found')); ?> !!</h2>
                            <p class="lead">
                                <?php echo e(__('Sorry we cant find any data, to get rid of this message, make at least 1 entry')); ?>.
                            </p>
                            <a href="<?php echo e(route('ticket_status.create')); ?>"
                                class="btn btn-custom mt-4"><?php echo e(__('Create new One')); ?></a>
                        </div>
                        <?php else: ?>
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                    <th><?php echo e(__('Status title')); ?></th>
                                    <th><?php echo e(__('Status color')); ?></th>
                                    <th><?php echo e(__('Text color')); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(__($status->title)); ?></td>
                                    <td><span class="badge text-white custom-shadow"
                                            style="background-color: <?php echo e($status->color); ?> !important;"> </span>
                                        <?php echo e(Str::upper($status->color)); ?></td>

                                    <td><span class="badge text-white custom-shadow"
                                            style="background-color: <?php echo e($status->text_color); ?> !important;"> </span>
                                        <?php echo e(Str::upper($status->text_color)); ?></td>

                                    <td class="justify-content-center form-inline">
                                        <a href="<?php echo e(route('ticket_status.edit', [$status->id])); ?>"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="<?php echo e(__('Edit')); ?>"></i></a>
                                        <?php if($status->id > 6): ?>
                                        <form action="<?php echo e(route('ticket_status.destroy', [$status->id])); ?>"
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
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                        <br>
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
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/tenant/ticket_status/index.blade.php ENDPATH**/ ?>