<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Tickets')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
        <div class="breadcrumb-item"><?php echo e(__('Tickets')); ?></div>
    </div>
</div>

<div class="section-body" id="app1">

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">

              
                <div class="card-body">
                    <form action="/ticket" method="get">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="action" value="modify_ticket" />
                        <div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="urgency"><?php echo e(__('Priority')); ?></label>
                                    <select class="form-control selectric" id="urgency" name="ticket_urgency_id">
                                        <option value="0"><?php echo e(__('All')); ?></option>
                                        <?php $__currentLoopData = $ticket_urgency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urgency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(request()->input('ticket_urgency_id') == $urgency->id): ?>
                                        <option selected value="<?php echo e($urgency->id); ?>"><?php echo e(__($urgency->name)); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo e($urgency->id); ?>"><?php echo e(__($urgency->name)); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ticket_status"><?php echo e(__('Status')); ?></label>
                                    <select class="form-control selectric" id="ticket_status" name="ticket_status_id">
                                        <option value="0"><?php echo e(__('All')); ?></option>
                                        <?php $__currentLoopData = $ticket_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(request()->input('ticket_status_id') == $ticket_status->id): ?>
                                        <option selected value="<?php echo e($ticket_status->id); ?>"><?php echo e(__($ticket_status->title)); ?>

                                        </option>
                                        <?php else: ?>
                                        <option value="<?php echo e($ticket_status->id); ?>"><?php echo e(__($ticket_status->title)); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="department"><?php echo e(__('Department')); ?></label>
                                    <select class="form-control selectric" id="department" name="department_id">
                                        <option value="0"><?php echo e(__('None')); ?></option>
                                        <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(request()->input('department_id') == $department->id): ?>
                                        <option selected value="<?php echo e($department->id); ?>"><?php echo e(__($department->name)); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo e($department->id); ?>"><?php echo e(__($department->name)); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <!-- let's use this option only for super users -->
                                <?php if(Auth::check() && Auth::user()->role != 'user'): ?>
                                <div class="form-group col-md-6">
                                    <label for="assigned_to"><?php echo e(__('Assigned to')); ?></label>
                                    <select class="form-control selectric" id="assigned_to" name="assigned_to">
                                        <option value=""><?php echo e(__('None')); ?></option>
                                        <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(request()->input('assigned_to') == $staff->id): ?>
                                        <option selected value="<?php echo e($staff->id); ?>"><?php echo e($staff->name); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo e($staff->id); ?>"><?php echo e($staff->name); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <?php endif; ?>

                                <div class="form-group col-md-6" v-if="tags">
                                  <label for="department"><?php echo e(__('Tags')); ?></label>
                                  <input type="hidden" ref="tag_ref" id="tag_ref_id" value="" name="tag_ids" />
                                  <ticket-tags multiple :options="tags" taggable push-tags v-model="selected_tags"
                                    :reduce="tags => tags.uuid" label="name" @input="chooseMe">
                                  </ticket-tags>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="search"><?php echo e(__('Search')); ?></label>
                                    <input type="text" class="form-control" id="search"
                                        value="<?php echo e(request()->input('search')); ?>" name="search" placeholder="<?php echo e(__('Search with Ticket ID or Subject')); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-2 row float-left">
                            <div>
                                <button type="submit" class="btn btn-custom"><i class="fas fa-search"></i>
                                    <?php echo e(__('Filter')); ?></button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive pt-1">
                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active"
                                    href="<?php echo e(route('get_tickets')); ?>"></i><span><?php echo e(__('All Tickets')); ?></span></a>
                            </li>
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="nav-link"
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
                                   
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="<?php echo e(route('get_tickets',['name' => 'tid' ,'order'=>$sort_order])); ?>"><?php echo e(__('Ticket ID')); ?> 
                                        <span> <?php if($sort_order =='asc'): ?> 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    <?php else: ?>
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    <?php endif; ?>
                                        </span></a></th>
                                    
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="<?php echo e(route('get_tickets',['name' => 'opened_user_id' ,'order'=>$sort_order])); ?>"><?php echo e(__('customer')); ?> 
                                        <span> <?php if($sort_order =='asc'): ?> 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    <?php else: ?>
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    <?php endif; ?>
                                        </span></a></th>
                                   
                                
                                    
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="<?php echo e(route('get_tickets',['name' => 'title' ,'order'=>$sort_order])); ?>"><?php echo e(__('Subject')); ?> 
                                        <span> <?php if($sort_order =='asc'): ?> 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    <?php else: ?>
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    <?php endif; ?>
                                        </span></a></th>
                                    
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="<?php echo e(route('get_tickets',['name' => 'ticket_status_id' ,'order'=>$sort_order])); ?>"><?php echo e(__('Status')); ?> 
                                        <span> <?php if($sort_order =='asc'): ?> 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    <?php else: ?>
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    <?php endif; ?>
                                        </span></a></th>
                                 
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="<?php echo e(route('get_tickets',['name' => 'ticket_urgency_id' ,'order'=>$sort_order])); ?>"><?php echo e(__('Priority')); ?> 
                                        <span> <?php if($sort_order =='asc'): ?> 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    <?php else: ?>
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    <?php endif; ?>
                                        </span></a></th>
                             
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="<?php echo e(route('get_tickets',['name' => 'department_id' ,'order'=>$sort_order])); ?>"><?php echo e(__('Department')); ?> 
                                        <span> <?php if($sort_order =='asc'): ?> 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    <?php else: ?>
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    <?php endif; ?>
                                        </span></a></th>
                                 
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="<?php echo e(route('get_tickets',['name' => 'last_touched_at' ,'order'=>$sort_order])); ?>"><?php echo e(__('Last action')); ?> 
                                        <span> <?php if($sort_order =='asc'): ?> 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    <?php else: ?>
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    <?php endif; ?>
                                        </span></a></th>
                                    

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php if($ticket->ticketUnread ): ?>
                                <tr class="bg-table-custom font-weight-bold-custom">
                                    <td>#<?php echo e(($ticket->tid)); ?></td>
                                  
                                    <td><?php echo e(($ticket->openedUser->name)); ?></td>
                                    <td> <a class="font-weight-bold-custom"
                                            href="<?php echo e(route('ticket.reply', [$ticket->uuid])); ?>"><?php echo e(Str::limit($ticket->title, 30)); ?>

                                        </a>
                                        <?php if(count($ticket->tags)): ?>
                                        <br>
                                        <?php $__currentLoopData = $ticket->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="tag-badge badgesize text-white"
                                            style="color: <?php echo e($tag->text_color); ?> !important;background-color: <?php echo e($tag->tag_color); ?> !important;">
                                            <?php echo e($tag->name); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
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
                                    <td class="justify-content-center form-inline">
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
                            
                                    <td><?php echo e(($ticket->openedUser->name)); ?></td>
                                    <td><a
                                            href="<?php echo e(route('ticket.reply', [$ticket->uuid])); ?>"><?php echo e(Str::limit($ticket->title, 30)); ?></a>
                                        <?php if(count($ticket->tags)): ?>
                                        <br>
                                        <?php $__currentLoopData = $ticket->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="tag-badge badgesize text-white"
                                            style="color: <?php echo e($tag->text_color); ?> !important;background-color: <?php echo e($tag->tag_color); ?> !important;">
                                            <?php echo e($tag->name); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
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
                                    <td class="justify-content-center form-inline">
                                        <?php if(Auth::check() && Auth::user()->role == 'admin'): ?>
                                        <a href="<?php echo e(route('ticket.show', [$ticket->uuid])); ?>"
                                            class="btn btn-sm bg-transparent"><i class="fas fa-eye text-primary"
                                                aria-hidden="true" title="<?php echo e(__('View')); ?>"></i></a>
                                        <?php endif; ?>
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
<script>
  var uuid = '';
  var current_tags = '';
</script>
<script src="<?php echo e(asset('js/ticket.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/tenant/ticket/search_filter.blade.php ENDPATH**/ ?>