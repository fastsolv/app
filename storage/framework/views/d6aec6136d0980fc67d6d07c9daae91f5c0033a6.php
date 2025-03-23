<?php $__env->startSection('content'); ?>

<div class="section-header shadow-none">
    <h1><?php echo e(__('Announcements')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
        <div class="breadcrumb-item"><?php echo e(__('Announcements')); ?></div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-header">
                    <!-- <h4 class="inline-block"><?php echo e(__('List of Announcements')); ?></h4>  -->
                     <?php if($show_add_button): ?>
                    <small id='main'>
                        <a href="<?php echo e(route('announcement.create')); ?>"
                            class="btn btn-custom  float-right add_button"><?php echo e(__('Add')); ?></a>
                    </small>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if(!count($announcements)): ?>
                        <div class="empty-state pt-3" data-height="400">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2><?php echo e(__('No Announcements found')); ?> !!</h2>
                            
                            <a href="<?php echo e(route('announcement.create')); ?>"
                                class="btn btn-custom mt-4"><?php echo e(__('Create new One')); ?></a>
                        </div>
                        <?php else: ?>
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                    <th class="col-lg-2 "> <a  class ="text-secondary text-decoration-none font-weight-bold" href="<?php echo e(route('get_announcement',['name' => 'title' ,'order'=>$sort_order])); ?>"><?php echo e(__('Title')); ?>

                                         <span> <?php if($sort_order =='asc'): ?> 
                                            <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                             <?php else: ?>
                                             <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                             <?php endif; ?>
                                        </span>
                                    </a></th>
                                    <th class="col-lg-7 "> <a  class ="text-secondary text-decoration-none font-weight-bold" href="<?php echo e(route('get_announcement',['name' => 'announcement' ,'order'=>$sort_order])); ?>"><?php echo e(__('Announcement')); ?> 
                                         <span> <?php if($sort_order =='asc'): ?> 
                                            <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                             <?php else: ?>
                                             <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                             <?php endif; ?>
                                        </span>
                                    </a></th>
                                    
                                    <th class="col-lg-2"><a  class ="text-secondary text-decoration-none font-weight-bold" href="<?php echo e(route('get_announcement',['name' => 'is_published' ,'order'=>$sort_order])); ?>"><?php echo e(__('Published')); ?> 
                                        <span> <?php if($sort_order =='asc'): ?> 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    <?php else: ?>
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    <?php endif; ?>
                                        </span></a></th>
                                    <?php if($show_edit_button || $show_delete_button): ?>
                                    <th class="col-lg-1 "></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-capitalize">
                                        <?php echo e($announcement->title); ?></td>
                                    <td>  <?php echo strip_tags($announcement->announcement); ?>. </td>
                                     <?php if(($announcement->is_published) == true): ?>
                                    <td class="text-success"><?php echo e(__('Yes')); ?></td>
                                      <?php else: ?>
                                    <td class="text-danger"><?php echo e(__('No')); ?></td>
                                    <?php endif; ?>

                                    <?php if($show_edit_button || $show_delete_button): ?>
                                    <td class="justify-content-center form-inline">
                                        <?php if($show_edit_button): ?>
                                        <a href="<?php echo e(route('announcement.edit', [$announcement->uuid])); ?>"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="<?php echo e(__('Edit')); ?>"></i></a> <?php endif; ?>
                                         <?php if($show_delete_button): ?>
                                        <form action="<?php echo e(route('announcement.destroy', [$announcement->uuid])); ?>"
                                            method="POST">
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
                                    <?php endif; ?>

                                </tr>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <br>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/tenant/announcement/index.blade.php ENDPATH**/ ?>