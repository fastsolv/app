<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Invoices')); ?></h1>
    <div class="section-header-breadcrumb">
        
        <div class="breadcrumb-item"><a href="<?php echo e(route('invoices.index')); ?>"><?php echo e(__('Invoices')); ?></a>
        </div>
        <div class="breadcrumb-item"><?php echo e(__('List of Invoices')); ?></div>
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
                    <h4 class="inline-block"><?php echo e(__('List of Invoices')); ?></h4>

                    <div class="search-bar float-right inline-block">
                        <form action="/invoices" method="get">
                            <div class="input-group mb-2 ">
                                <input type="text" name="search" class="form-control search-bar-input"
                                    placeholder="Search" value="<?php echo e(request()->input('search')); ?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-custom search-bar-button"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                    <th><?php echo e(__('Order Id')); ?></th>
                                    <th><?php echo e(__('User')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th>
                                        <?php echo e(__('Payment Status')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(__('Status')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(__('Invoice Date')); ?>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a href="<?php echo e(route('invoices.show', $invoice->uuid)); ?>"><?php echo e($invoice->orders->order_id); ?></a></td>
                                    <td class="text-capitalize"><?php echo e($invoice->user->first_name); ?></td>
                                    <td class="text-right">$<?php echo e(number_format($invoice->amount, 2)); ?> <?php echo e($invoice->currency); ?></td>
                                    <td class="text-capitalize"><?php echo e(__($invoice->payment_status)); ?></td>
                                    <?php if($invoice->is_renew == true): ?>
                                    <td><?php echo e(__('Renew')); ?></td>
                                    <?php else: ?>
                                    <td><?php echo e(__('Normal')); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(\Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y g:i A')); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <br>
                        <?php echo e($invoices->appends($request->all())->links("pagination::bootstrap-4")); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/invoices/index.blade.php ENDPATH**/ ?>