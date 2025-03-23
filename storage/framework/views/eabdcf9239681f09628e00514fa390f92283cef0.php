<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Tenants')); ?></h1>
    <div class="section-header-breadcrumb">
        
        <div class="breadcrumb-item"><a href="<?php echo e(route('tenants.index')); ?>"><?php echo e(__('Tenants')); ?></a>
        </div>
        <div class="breadcrumb-item"><?php echo e(__('List of Tenants')); ?></div>
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
                    <h4 class="inline-block"><?php echo e(__('List of Tenants')); ?></h4>

                    <div class="search-bar float-right inline-block">
                        <form action="/tenants" method="get">
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
                                    <th><?php echo e(__('Tenant Id')); ?></th>
                                    <th><?php echo e(__('Subdomain')); ?></th>
                                    <th><?php echo e(__('User')); ?></th>
                                    <th>
                                        <?php echo e(__('Status')); ?>

                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-capitalize"><?php echo e(__($tenant->tenant_id)); ?></td>
                                    <td><a href="<?php echo e($protocol); ?><?php echo e($tenant->id); ?>.<?php echo e($central); ?>" target="_blank"><?php echo e($tenant->id); ?>.<?php echo e($central); ?></a></td>
                                    <td class="text-capitalize"><?php echo e($user[$tenant->id]); ?></td>

                                    <td class="text-center">
                                        <?php if($tenant->status == true): ?>
                                        <span class="text-success-dark"><?php echo e(__('Active')); ?></span>
                                        <?php else: ?>
                                        <span class="text-danger"><?php echo e(__('Innactive')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="justify-content-center form-inline">
                                        <a href="<?php echo e(route('tenants.edit', [$tenant->id])); ?>"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="<?php echo e(__('Edit')); ?>"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <br>
                        <?php echo e($tenants->appends($request->all())->links("pagination::bootstrap-4")); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/tenant/index.blade.php ENDPATH**/ ?>