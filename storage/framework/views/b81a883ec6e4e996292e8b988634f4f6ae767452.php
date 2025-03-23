<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Dashboard')); ?></h1>
</div>

<?php echo $__env->make('common.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo e(__('Income Statistics')); ?></h4>
            </div>
            <div class="card-body">
                <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card income-card">
                    <div class="statistic-details mt-sm-4">
                        <div class="statistic-details-item">
                            <div class="detail-value"><?php echo e($currency->prefix); ?><?php echo e(number_format($totalIncome[$currency->id], 2)); ?></div>
                            <div class="detail-name"><?php echo e(__('Total Income in')); ?> <?php echo e($currency->currency); ?></div>
                        </div>
                        <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-primary"><i class="fas fa-square"></i></span>
                                <?php echo e($totalIncome[$currency->id] !== 0 ? round($todayIncome[$currency->id]*100/$totalIncome[$currency->id], 2) : 0); ?>%</span>
                            <div class="detail-value"><?php echo e($currency->prefix); ?><?php echo e(number_format($todayIncome[$currency->id], 2)); ?></div>
                            <div class="detail-name"><?php echo e(__('Todays Sales')); ?></div>
                        </div>
                        <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-success-dark"><i
                                        class="fas fa-square"></i></span>
                                <?php echo e($totalIncome[$currency->id] !== 0 ? round($thisMonthIncome[$currency->id]*100/$totalIncome[$currency->id], 2) : 0); ?>%</span>
                            <div class="detail-value"><?php echo e($currency->prefix); ?><?php echo e(number_format($thisMonthIncome[$currency->id], 2)); ?></div>
                            <div class="detail-name"><?php echo e(__('This Months Sales')); ?></div>
                        </div>
                        <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-custom"><i class="fas fa-square"></i></span>
                                <?php echo e($totalIncome[$currency->id] !== 0 ? round($thisYearIncome[$currency->id]*100/$totalIncome[$currency->id], 2) : 0); ?>%</span>
                            <div class="detail-value"><?php echo e($currency->prefix); ?><?php echo e(number_format($thisYearIncome[$currency->id], 2)); ?></div>
                            <div class="detail-name"><?php echo e(__('This Years Sales')); ?></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div class="mb-3">
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            
            <div>
                <div class="custom-card-icon bg-card-dash-1">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4><?php echo e(__('Total Orders')); ?></h4>
                    </div>
                    <div class="card-body">
                        <?php echo e($orders_count); ?>

                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            
            <div>
                <div class="custom-card-icon bg-card-dash-2">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4><?php echo e(__('Paid Orders')); ?></h4>
                    </div>
                    <div class="card-body">
                        <?php echo e($paidOrders); ?>

                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            
            <div>
                <div class="custom-card-icon bg-card-dash-3">
                    <i class="fas fa-running"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4><?php echo e(__('Trial Orders')); ?></h4>
                    </div>
                    <div class="card-body">
                        <?php echo e($trialOrders); ?>

                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div>
                <div class="custom-card-icon bg-warning">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4><?php echo e(__('Total Tenants')); ?></h4>
                    </div>
                    <div class="card-body">
                        <?php echo e($tenants); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h4 class="inline-block"><?php echo e(__('Latest Orders')); ?></h4>
                <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-icon btn-custom float-right inline-block"><i
                        class="far fa-edit"></i><?php echo e(__('See All')); ?></a>
            </div>
            <div class="card-body">

                <div class="table-responsive pt-1">
                    <?php if(!count($orders)): ?>
                    <div class="empty-state pt-3" data-height="400">
                        <div class="empty-state-icon bg-danger">
                            <i class="fas fa-question"></i>
                        </div>
                        <h2><?php echo e(__('No orders found')); ?> !!</h2>
                        <p class="lead">
                            <?php echo e(__('Sorry we cant find any data, to get rid of this message, make at least 1 entry')); ?>.
                        </p>
                        <a href="" class="btn btn-custom mt-4"><?php echo e(__('Create new One')); ?></a>
                    </div>
                    <?php else: ?>
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
                                <td class="text-right">$<?php echo e(number_format($order->amount, 2)); ?> <?php echo e($order->currency); ?>

                                </td>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/dashboard/admin.blade.php ENDPATH**/ ?>