<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Subscriptions')); ?></h1>
    <div class="section-header-breadcrumb">
        
        <div class="breadcrumb-item"><a href="<?php echo e(route('services.index')); ?>"><?php echo e(__('Subscriptions')); ?></a>
        </div>
        <div class="breadcrumb-item"><?php echo e(__('List of Subscriptions')); ?></div>
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
                    <h4 class="inline-block"><?php echo e(__('List of Subscriptions')); ?></h4>

                    <div class="search-bar float-right inline-block">
                        <form action="/services" method="get">
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
                                    <th>
                                        <?php echo e(__('Service ID')); ?>

                                    </th>
                                    <th><?php echo e(__('Order Id')); ?></th>
                                    <th><?php echo e(__('User Name')); ?></th>
                                    <th><?php echo e(__('Plan')); ?></th>
                                    <th><?php echo e(__('Period')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th>
                                        <?php echo e(__('Expiry Date')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(__('Next Invoice Date')); ?>

                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($service->service_id); ?></td>
                                    <td><?php echo e($service->orders->order_id); ?></td>
                                    <td><?php echo e($service->user->first_name); ?> <?php echo e($service->user->last_name); ?></td>
                                    <td class="text-capitalize"> <?php echo e(__($service->plans->name)); ?> </td>
                                    <td class="text-capitalize"> <?php echo e(__($service->pricing->term)); ?> <?php echo e(__($service->pricing->period)); ?></td>
                                    <td class="text-capitalize <?php echo e(($service->statuses->name == 'active') ? "text-success" : "text-danger"); ?>">
                                    <?php echo e(__($service->statuses->name)); ?>

                                    </td>
                                    <td><?php echo e(\Carbon\Carbon::parse($service->expiry_date)->format('d/m/Y g:i A')); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($service->next_invoice_date)->format('d/m/Y')); ?></td>
                                    <td><a  href="<?php echo e(route('services.edit', [$service->uuid])); ?>"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="<?php echo e(__('Edit')); ?>"></i></a></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <br>
                        <?php echo e($services->appends($request->all())->links("pagination::bootstrap-4")); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/order-service/index.blade.php ENDPATH**/ ?>