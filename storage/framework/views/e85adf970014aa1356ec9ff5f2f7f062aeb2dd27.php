<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Tickets')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
        <div class="breadcrumb-item"><?php echo e(__('Tickets')); ?></div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <a href="<?php echo e(route('ticket.index')); ?>">
                    <div>
                        <div class="custom-card-icon bg-card-dash-1">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('ALL TICKETS')); ?></h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($ticketCount['total']); ?>

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <a href="<?php echo e(route('tickets', 1)); ?>">
                    <div>
                        <div class="custom-card-icon bg-card-dash-2">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('OPEN')); ?></h4>
                            </div>
                            <div class="card-body">
                                <?php echo e(!empty($ticketCount['status'][1]) ? $ticketCount['status'][1] : "0"); ?>

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <a href="<?php echo e(route('tickets', 6)); ?>">
                    <div>
                        <div class="custom-card-icon bg-card-dash-3">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('AWAITING')); ?></h4>
                            </div>
                            <div class="card-body">
                                <?php echo e(!empty($ticketCount['status'][6]) ? $ticketCount['status'][6] : "0"); ?>

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <a href="<?php echo e(route('tickets', 4)); ?>">
                    <div>
                        <div class="custom-card-icon bg-success-dark">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('ANSWERED')); ?></h4>
                            </div>
                            <div class="card-body">
                                <?php echo e(!empty($ticketCount['status'][4]) ? $ticketCount['status'][4] : "0"); ?>

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">

                <div class="card-header">
                    <h4 class="inline-block"><?php echo e(__('List of Tickets')); ?></h4>
                    <a href="<?php echo e(route('ticket.create')); ?>" class="btn btn-icon btn-custom float-right inline-block"><i
                            class="far fa-edit"></i><?php echo e(__('Open Ticket')); ?></a>
                </div>
                <div class="card-body">
                    <div class="search-bar">
                        <form action="/ticket" method="get">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="action" value="modify_ticket" />
                            <div class="input-group mb-2">
                                <input type="text" name="search" class="form-control search-bar-input"
                                    placeholder="Search" value="<?php echo e(request()->input('search')); ?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-custom search-bar-button"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive pt-1">
                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="<?php echo e(route('ticket.index')); ?>"></i><span><?php echo e(__('All Tickets')); ?></span></a>
                            </li>
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->route('id') == $status->id ? 'active' : ''); ?>"
                                    href="<?php echo e(route('tickets', [$status->id])); ?>"><span><?php echo e(__($status->title)); ?></span></a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="user-ticket-divider"></div>
                        <?php if(!count($tickets)): ?>
                        <div class="empty-state pt-3" data-height="400">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2><?php echo e(__('No tickets found')); ?> !!</h2>
                            <p class="lead">
                                <?php echo e(__('Sorry we cant find any data, to get rid of this message, make at least 1 entry')); ?>.
                            </p>
                        </div>
                        <?php else: ?>
                        <table class="table table-striped pt-3" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                    <th><?php echo e(__('Ticket ID')); ?></th>
                                    <th><?php echo e(__('Subject')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Priority')); ?></th>
                                    <th><?php echo e(__('Department')); ?></th>
                                    <th><?php echo e(__('Last action')); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php if($ticket->ticketUnread ): ?>
                                <tr class="bg-table-custom font-weight-bold-custom">
                                    <td>#<?php echo e(($ticket->tid)); ?></td>
                                    <td><a class="font-weight-bold-custom"
                                            href="<?php echo e(route('ticket.reply', [$ticket->uuid])); ?>"><?php echo e(Str::limit($ticket->title, 30)); ?></a>
                                    </td>
                                    <td><span class="badge text-white"
                                            style="color: <?php echo e($ticket->ticketStatus->text_color); ?> !important;background-color: <?php echo e($ticket->ticketStatus->color); ?> !important;"><?php echo e(__($ticket->ticketStatus->title)); ?></span>
                                    </td>
                                    <td><?php echo e(__($ticket->ticketUrgency->name)); ?>

                                    </td>
                                    <td><?php echo e(__($ticket->department->name)); ?>

                                    </td>
                                    <td><?php echo e($ticket->last_touched_at->diffForHumans()); ?>

                                    </td>
                                    <?php if(env('APP_ENV') != 'demo'): ?>
                                    <td>
                                        <form action="<?php echo e(route('ticket.destroy', [$ticket->uuid])); ?>" method="POST">
                                            <?php echo method_field('DELETE'); ?>
                                            <?php echo csrf_field(); ?>
                                            <button class="btn bg-transparent"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"
                                                    title="<?php echo e(__('Delete')); ?>"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                <?php else: ?>
                                <tr>
                                    <td>#<?php echo e(($ticket->tid)); ?></td>
                                    <td><a
                                            href="<?php echo e(route('ticket.reply', [$ticket->uuid])); ?>"><?php echo e(Str::limit($ticket->title, 30)); ?></a>
                                    </td>
                                    <td><span class="badge text-white"
                                            style="color: <?php echo e($ticket->ticketStatus->text_color); ?> !important;background-color: <?php echo e($ticket->ticketStatus->color); ?> !important;"><?php echo e(__($ticket->ticketStatus->title)); ?></span>
                                    </td>
                                    <td><?php echo e(__($ticket->ticketUrgency->name)); ?>

                                    </td>
                                    <td><?php echo e(__($ticket->department->name)); ?>

                                    </td>
                                    <td><?php echo e($ticket->last_touched_at->diffForHumans()); ?>

                                    </td>
                                    <?php if(env('APP_ENV') != 'demo'): ?>
                                    <td>
                                        <form action="<?php echo e(route('ticket.destroy', [$ticket->uuid])); ?>" method="POST">
                                            <?php echo method_field('DELETE'); ?>
                                            <?php echo csrf_field(); ?>
                                            <button class="btn bg-transparent"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"
                                                    title="<?php echo e(__('Delete')); ?>"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <br>
                        <?php echo e($tickets->appends($request->all())->links("pagination::bootstrap-4")); ?>


                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 
        ($theme =="white") ? 'tenant.layouts.white_user_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_user_theme':
    (($theme =="green") ? 'tenant.layouts.green_user_theme':
    (($theme =="black") ? 'tenant.layouts.black_user_theme':
    (($theme =="blue") ?'tenant.layouts.blue_user_theme' :   'tenant.layouts.yellow_user_theme'))))
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/tenant/ticket/user/ticket_by_status.blade.php ENDPATH**/ ?>