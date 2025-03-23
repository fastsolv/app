<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Orders')); ?></h1>
    <div class="section-header-breadcrumb">
        
        <div class="breadcrumb-item"><a href="<?php echo e(route('orders.index')); ?>"><?php echo e(__('Orders')); ?></a>
        </div>
        <div class="breadcrumb-item"><?php echo e(__('List of Orders')); ?></div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block"><?php echo e(__('List of Orders')); ?></h4>

                    <div class="search-bar float-right inline-block">
                        <form action="/orders" method="get">
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
                                        <?php echo e(__('Gateway')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(__('Status')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(__('Date')); ?>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-capitalize"><?php echo e(__($order->order_id)); ?></td>
                                    <td class="text-capitalize"><a
                                            href="<?php echo e(route('users.edit', [$order->user_id])); ?>"><?php echo e($order->user->first_name); ?></a>
                                    </td>
                                    <td class="text-right">$<?php echo e(number_format($order->amount, 2)); ?> <?php echo e($order->currency); ?></td>
                                    <td class="text-capitalize"><?php echo e($order->gateway); ?></td>

                                    <td class="text-center">
                                        <?php if($order->status == 'pending'): ?>
                                        <form action="<?php echo e(route('orders.update', [$order->uuid])); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input name="_method" type="hidden" value="PUT">
                                            <button class="btn btn-success bg-success-dark btn-sm">
                                                <?php echo e(__('Accept')); ?>

                                            </button>
                                        </form>
                                        <?php elseif($order->status == 'fresh'): ?>
                                        <span class="text-danger"><?php echo e(__('Fresh')); ?></span>
                                        <?php else: ?>
                                        <span class="text-success-dark"><?php echo e(__('Accepted')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(\Carbon\Carbon::parse($order->created_at)->format('d/m/Y')); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <br>
                        <?php echo e($orders->appends($request->all())->links("pagination::bootstrap-4")); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/orders/index.blade.php ENDPATH**/ ?>