<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Dashboard')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item custom-style"><a
                href="<?php echo e($protocol); ?><?php echo e($tenant->id); ?>.<?php echo e($central); ?>" target="_blank"><?php echo e($tenant->id); ?>.<?php echo e($central); ?></a>
        </div>
    </div>
</div>

<div class="section-body">
    <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card card-statistic-1">
                
                <div>
                    <div class="custom-card-icon bg-card-dash-1">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(__('Total Tickets')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($result['ticket_count']); ?>

                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card card-statistic-1">
                
                <div>
                    <div class="custom-card-icon bg-card-dash-2">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(__('Web Tickets')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($result['web_ticket_count']); ?>

                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card card-statistic-1">
                
                <div>
                    <div class="custom-card-icon bg-card-dash-3">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(__('Email Tickets')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($result['imap_ticket_count']); ?>

                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card card-statistic-1">
                
                <div>
                    <div class="custom-card-icon bg-card-dash-1">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(__('Total Users')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($result['users_count']); ?>

                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card card-statistic-1">
                
                <div>
                    <div class="custom-card-icon bg-card-dash-2">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(__('Total Staff')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($result['staff_count']); ?>

                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card card-statistic-1">
                
                <div>
                    <div class="custom-card-icon bg-card-dash-3">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(__('Total Departments')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($result['department_count']); ?>

                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row col-12">
        <div class="col-12 col-md-7">

            <?php if($service): ?>
            <?php if($service->status_id == "1" && $service->orders->status == "active"): ?>
            <div class="card  bg-success-dark">
                <div class="hero align-items-center text-white">
                    <div class="hero-inner text-center">
                        <h2><?php echo e(__("You have activated")); ?> <?php echo e($service->plans->name); ?> <?php echo e(__('subscription for')); ?> <?php echo e($service->pricing->term); ?> <?php echo e(__($service->pricing->period)); ?>.</h2>
                        <p class="lead">
                            <?php echo e(__("Your plan will expire on")); ?>

                            <?php echo e(\Carbon\Carbon::parse($service->expiry_date)->format('d-M-Y')); ?>.
                        </p>
                    </div>
                </div>
            </div>
            <?php elseif($service->status_id == "1" && $service->orders->status !== "active"): ?>
            <div class="card  bg-danger">
                <div class="hero align-items-center text-white">
                    <div class="hero-inner text-center">
                        <h2><?php echo e(__("Your order is not confirmed")); ?>.</h2>
                        <p class="lead">
                            <?php echo e(__("Your order for")); ?> <?php echo e(__($service->plans->name)); ?>

                            <?php echo e(__('subscription is not confirmed. Please wait sometimes or contact support')); ?>.
                        </p>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="card  bg-danger">
                <div class="hero align-items-center text-white">
                    <div class="hero-inner text-center">
                        <h2><?php echo e(__("Your plan is expired")); ?>.</h2>
                        <p class="lead">
                            <?php echo e(__('Please subscribe to a plan to use our service')); ?>.<a
                                href="<?php echo e(route('plan_details.index')); ?>" class="btn bg-transparent text-primary">
                                <?php echo e(__('Click here')); ?>.</a>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php else: ?>
            <div class="card  bg-danger">
                <div class="hero align-items-center text-white">
                    <div class="hero-inner text-center">
                        <h2><?php echo e(__('You have no subscriptions yet')); ?></h2>
                        <p class="lead">
                            <?php echo e(__('Please subscribe to a plan to use our service')); ?>.<a
                                href="<?php echo e(route('plan_details.index')); ?>" class="btn bg-transparent text-primary">
                                <?php echo e(__('Click here')); ?>.</a>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-12 col-md-5">

            <?php if($tenant->MAIL_HOST && $tenant->MAIL_USERNAME): ?>
            <div class="card  bg-success-dark">
                <div class="hero align-items-center text-white">
                    <div class="hero-inner text-center">
                        <h2><?php echo e(__('SMTP details updated')); ?>.</h2>
                        <p class="lead"><a href="<?php echo e(route('smtp.create')); ?>" class="btn bg-white text-success-dark">
                                <?php echo e(__('Update')); ?></a>
                        </p>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="card  bg-danger">
                <div class="hero align-items-center text-white">
                    <div class="hero-inner text-center">
                        <h2><?php echo e(__('Update your SMTP details')); ?>.</h2>
                        <p class="lead"><a href="<?php echo e(route('smtp.create')); ?>" class="btn bg-white text-danger">
                                <?php echo e(__('Update')); ?></a>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('central.layouts.new_user_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/dashboard/user.blade.php ENDPATH**/ ?>