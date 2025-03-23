<?php $__env->startSection('content'); ?>

<div class="section-header shadow-none">
    <h1><?php echo e(__('Dashboard')); ?></h1>
</div>

<div class="section-body">
<?php if(($imap_enables->value) == '1'): ?>
<h2 class="section-title"><?php echo e(__('Web Tickets')); ?></h2>
<?php endif; ?>
<div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <a href="<?php echo e(route('get_tickets')); ?>">
                    <div>
                        <div class="custom-card-icon bg-card-dash-1">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('Total Tickets')); ?></h4>
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
                                <h4><?php echo e(__('Open Tickets')); ?></h4>
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
                <a href="<?php echo e(route('tickets', 7)); ?>">
                    <div>
                        <div class="custom-card-icon bg-card-dash-3">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('Awaiting Tickets')); ?></h4>
                            </div>
                            <div class="card-body">
                                <?php echo e(!empty($ticketCount['status'][7]) ? $ticketCount['status'][7] : "0"); ?>

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
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('Response Time')); ?></h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($dashboard['webTicketLife']); ?> <small><?php echo e(__('min')); ?></small>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <?php if(($imap_enables->value) == '1'): ?>
    <h2 class="section-title"><?php echo e(__('Email Tickets')); ?></h2>
    <div class="row">
        
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <a href="<?php echo e(route('get_imap_ticket')); ?>">
                    <div>
                        <div class="custom-card-icon bg-card-dash-1">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('Total Tickets')); ?></h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($emailTicketCount['total']); ?>

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <a href="<?php echo e(route('imapTickets', 1)); ?>">
                    <div>
                        <div class="custom-card-icon bg-card-dash-2">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('Open Tickets')); ?></h4>
                            </div>
                            <div class="card-body">
                                <?php echo e(!empty($emailTicketCount['status'][1]) ? $emailTicketCount['status'][1] : "0"); ?>

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <a href="<?php echo e(route('imapTickets', 7)); ?>">
                    <div>
                        <div class="custom-card-icon bg-card-dash-3">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('Awaiting Tickets')); ?></h4>
                            </div>
                            <div class="card-body">
                                <?php echo e(!empty($emailTicketCount['status'][7]) ? $emailTicketCount['status'][7] : "0"); ?>

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
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('Response Time')); ?></h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($dashboard['mailTicketLife']); ?> <small><?php echo e(__('min')); ?></small>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    <?php endif; ?>
    <div class="row">
        
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <a href="<?php echo e(route('get_staffs')); ?>">
                    <div>
                        <div class="custom-card-icon bg-card-dash-4">
                        <i class='fas fa-users'></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('Total Staffs')); ?></h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($total_staffs); ?>

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <a href="<?php echo e(route('get_departments')); ?>">
                    <div>
                        <div class="custom-card-icon bg-card-dash-5">
                            <i class="fas fa-desktop"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('Total Departments')); ?></h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($total_departments); ?>

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <a href="<?php echo e(route('products')); ?>">
                    <div>
                        <div class="custom-card-icon bg-card-dash-6">
                            <i class="fab fa-product-hunt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('Total Products')); ?></h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($total_products); ?>

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card card-statistic-1">
                    <div>
                        <div class="custom-card-icon bg-card-dash-7">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?php echo e(__('Ticket Rating')); ?></h4>
                            </div>
                            <div class="card-body">
                            <?php echo e(round($ticket_rating, 1)); ?> <?php echo e('/'); ?><?php echo e('5'); ?>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Week Status')); ?></h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Tickets By Status')); ?></h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">

                <div class="card-header">
                    <h4 class="inline-block"><?php echo e(__('Latest Tickets')); ?></h4>
                    <a href="<?php echo e(route('get_tickets')); ?>" class="btn btn-icon btn-custom float-right inline-block"><i
                            class="far fa-edit"></i><?php echo e(__('See All')); ?></a>
                </div>
                <div class="card-body">

                    <div class="table-responsive pt-1">
                        <?php if(!count($dashboard['tickets'])): ?>
                        <div class="empty-state pt-3" data-height="400">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2><?php echo e(__('No tickets found')); ?> !!</h2>
                            <p class="lead">
                                <?php echo e(__('Sorry we cant find any data, to get rid of this message, make at least 1 entry')); ?>.
                            </p>
                            <a href="" class="btn btn-custom mt-4"><?php echo e(__('Create new One')); ?></a>
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
                                <?php $__currentLoopData = $dashboard['tickets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

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
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Graph releated script starts here -->
<script>
    var line_labels = <?php echo json_encode($line_labels) ?>;
    var line_data = <?php echo json_encode($line_data) ?>;

    var doughnut_labels = <?php echo json_encode($doughnut_labels) ?>;
    var doughnut_data = <?php echo json_encode($doughnut_data) ?>;
    var doughnut_bgColors = <?php echo json_encode($doughnut_bgColors) ?>;
</script>

<script src="<?php echo e(asset('js/chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/ticket_graphs.js')); ?>"></script>
<!-- Graph releated script ends here -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/tenant/dashboard/index.blade.php ENDPATH**/ ?>