<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Users')); ?></h1>
    <div class="section-header-breadcrumb">
        
        <div class="breadcrumb-item"><a href="<?php echo e(route('users.index')); ?>"><?php echo e(__('Users')); ?></a>
        </div>
        <div class="breadcrumb-item"><?php echo e(__('List of Users')); ?></div>
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
                    <h4 class="inline-block"><?php echo e(__('List of Users')); ?></h4>
                    <a href="<?php echo e(route('users.create')); ?>" class="btn btn-icon btn-custom float-right inline-block"><i
                            class="far fa-edit"></i><?php echo e(__('Add User')); ?></a>
                </div>
                <div class="card-body">

                    <div class="search-bar">
                        <form action="/users" method="get">
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

                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-capitalize"><?php echo e(__($user->first_name)); ?> <?php echo e(__($user->last_name)); ?>

                                    </td>
                                    <td><?php echo e(__($user->email)); ?></td>
                                    <td class="text-capitalize"><?php echo e(__($user->statuses->name)); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($user->created_at)->format('d/m/Y')); ?></td>
                                    <td class="justify-content-center form-inline">
                                        <?php if(env('APP_ENV') != 'demo'): ?>
                                        <a href="<?php echo e(route('users.edit', [$user->id])); ?>"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="<?php echo e(__('Edit')); ?>"></i></a>
                                        <form action="<?php echo e(route('users.destroy', [$user->id])); ?>" method="POST">
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
                        <br>
                        <?php echo e($users->appends($request->all())->links("pagination::bootstrap-4")); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/users/index.blade.php ENDPATH**/ ?>