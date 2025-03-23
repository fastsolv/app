<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Pricing')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href=""><?php echo e(__('Dashboard')); ?></a></div>
        <div class="breadcrumb-item"><a href="<?php echo e(route('available_plans.index')); ?>"><?php echo e(__('Pricing')); ?></a>
        </div>
        <div class="breadcrumb-item"><?php echo e(__('Available Plans')); ?></div>
        <div class="breadcrumb-item">
            <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"><?php echo e($selectedCurrency); ?>

            </button>
            <div class="dropdown-menu">
                <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="dropdown-item" href=<?php echo e(route('available_plans.index', ['currency' => $currency->currency])); ?>><?php echo e($currency->currency); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="breadcrumb-item">
            <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"><?php echo e($selectedPeriod); ?>

            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item <?php echo e($selectedPeriod == 'Monthly' ? 'active' : ''); ?>" href="<?php echo e(route('available_plans.index', ['currency' => $selectedCurrency, 'period' => 'Monthly'])); ?>">Monthly</a>
                <a class="dropdown-item <?php echo e($selectedPeriod == 'Yearly' ? 'active' : ''); ?>" href="<?php echo e(route('available_plans.index', ['currency' => $selectedCurrency, 'period' => 'Yearly'])); ?>">Yearly</a>
            </div>
        </div>
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card-deck mb-3 text-center card-align">
                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card m-1 box-shadow price-width-320" >
                    <div class='pricing'>
                        <div class="pricing-title">
                            <?php echo e(__($plan->name)); ?>

                        </div>
                        <?php if($plan->require_payment != 0): ?>                           
                            <?php $__currentLoopData = $pricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($price->uuid == $plan->uuid): ?>
                                    <div class="pricing-title">
                                        <?php echo e(__($price->term)); ?> <?php echo e(__($price->period)); ?>

                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <?php if($plan->require_payment != 0): ?>                           
                        <?php $__currentLoopData = $pricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($price->uuid == $plan->uuid): ?>
                                <?php if($price->period == $selectedPeriod): ?>
                                    <h1 class="card-title pricing-card-title color-black"><?php echo e($price->price); ?> <small
                                            class="text-muted"><?php echo e($selectedCurrency); ?></small>
                                    </h1>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <div class="borderless">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                <?php echo e(__('No. of departments')); ?>

                                <span class="badge badge-purple badge-pill"><?php echo e($plan->department_count ? $plan->department_count : 'Unlimited'); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                <?php echo e(__('No. of tickets')); ?>

                                <span class="badge badge-purple badge-pill"><?php echo e($plan->ticket_qty ? $plan->ticket_qty : 'Unlimited'); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                <?php echo e(__('No. of staff')); ?>

                                <span class="badge badge-purple badge-pill"><?php echo e($plan->staffs_qty ? $plan->staffs_qty : 'Unlimited'); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                <?php echo e(__('No. of users')); ?>

                                <span class="badge badge-purple badge-pill"><?php echo e($plan->user_qty ? $plan->user_qty : 'Unlimited'); ?></span>
                            </li>
                        </div>

                    </div>
                    <?php if(env('APP_ENV') != 'demo'): ?>
                    <?php $__currentLoopData = $pricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($price->uuid == $plan->uuid): ?>  
                            <?php if($price->period == $selectedPeriod): ?>                      
                            <div class="card-footer bg-transparent border-success text-center">
                                <a href="<?php echo e(route('invoice', $price->id)); ?>" class="btn btn-custom btn-block pricing-button-new" role="button"
                                    aria-disabled="true">
                                    <?php echo e(__('Subscribe')); ?> <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.public_white', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/add_plan/index.blade.php ENDPATH**/ ?>