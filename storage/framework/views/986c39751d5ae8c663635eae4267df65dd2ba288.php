<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Currencies')); ?></h1>
    <div class="section-header-breadcrumb">
        
    <div class="breadcrumb-item"><?php echo e(__('Currencies')); ?></div>
</div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('List of Currencies')); ?>

                        <a href="<?php echo e(route('currency.create')); ?>"
                            class="btn btn-custom  float-right add_button"><?php echo e(__('Add')); ?></a>
                </div>
                <div class="card-body">

                    <?php if(!count($currencies)): ?>
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
                                    <th><?php echo e(__('Prefix')); ?></th>
                                    <th><?php echo e(__('Currency')); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="text-capitalize">
                                    <td><?php echo e($currency->prefix); ?></td>
                                    <td><?php echo e($currency->currency); ?></td>

                                    <td class="justify-content-center form-inline">
                                        <a href="<?php echo e(route('currency.edit', [$currency->id])); ?>"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="<?php echo e(__('Edit')); ?>"></i></a>
                                        <form action="<?php echo e(route('currency.destroy', [$currency->id])); ?>" method="POST">
                                            <?php echo method_field('DELETE'); ?>
                                            <?php echo csrf_field(); ?>
                                            <button class="btn btn-sm bg-transparent"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"
                                                    title="<?php echo e(__('Delete')); ?>"></i>
                                            </button>
                                        </form>
                                    </td>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/currency/index.blade.php ENDPATH**/ ?>