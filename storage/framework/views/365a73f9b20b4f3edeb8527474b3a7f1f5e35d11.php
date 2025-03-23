<?php $__env->startSection('content'); ?>
<div class="section-header shadow-none">
    <h1><?php echo e(__('FAQ Categories')); ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href=""><?php echo e(__('Dashboard')); ?></a></div>
        <div class="breadcrumb-item"><?php echo e(__('FAQ Categories')); ?></div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                 <div class="card-header">
                    
                    <?php if($show_add_button): ?>
                    <small id='main'>
                        <a href="<?php echo e(route('faq_category.create')); ?>" class="btn btn-custom  float-right add_button"><?php echo e(__('Add')); ?></a>
                    </small>
                    <?php endif; ?>
                 </div>
                 <div class="card-body">
                    <div class="table-responsive">
                        <?php if(!count($faqCategories)): ?>
                        <div class="empty-state pt-3" data-height="400">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2><?php echo e(__('No data found')); ?> !!</h2>
                            <p class="lead">
                                <?php echo e(__('Sorry we cant find any data, to get rid of this message, make at least 1 entry')); ?>.
                            </p>
                            <a href="<?php echo e(route('faq_category.create')); ?>"
                                class="btn btn-custom mt-4"><?php echo e(__('Create new One')); ?></a>
                        </div>
                        <?php else: ?>
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="<?php echo e(route('get_faq_category',['name' => 'name' ,'order'=>$sort_order])); ?>"><?php echo e(__('Name')); ?> 
                                        <span> <?php if($sort_order =='asc'): ?> 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    <?php else: ?>
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    <?php endif; ?>
                                        </span></a></th>
                                        <?php if($show_edit_button || $show_delete_button): ?>
                                    <th></th>
                                    <?php endif; ?>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $faqCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class=" ">
                                  <td><?php echo e($faq_category->name); ?></td>
                                  <?php if($show_edit_button || $show_delete_button): ?>
                                    <td class="justify-content-center form-inline">
                                    <?php if($show_edit_button): ?>
                                      <a href="<?php echo e(route('faq_category.edit', [$faq_category->uuid])); ?>"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="<?php echo e(__('Edit')); ?>"></i></a><?php endif; ?>
                                                <?php if($show_delete_button): ?>
                                        <form action="<?php echo e(route('faq_category.destroy', [$faq_category->uuid])); ?>" method="POST">
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
                        <?php endif; ?>
                        <br>
                        <?php echo e($faqCategories->appends($request->all())->links("pagination::bootstrap-4")); ?>

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
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/tenant/faq_category/index.blade.php ENDPATH**/ ?>