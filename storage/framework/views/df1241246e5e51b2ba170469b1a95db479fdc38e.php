<?php $__env->startSection('content'); ?>

<div class="section-header col-12 col-md-10 offset-md-1">
    <h1><?php echo e(__('Knowledge Base')); ?></h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="card article_card">
                <!-- <div class="card-header">
                    <h4><?php echo e(__('Knowledge Base categories')); ?></h4>
                </div> -->
                <div class="card">
                    <?php if(!count($categories)): ?>
                    <div class="empty-state pt-3" data-height="400">
                        <div class="empty-state-icon bg-custom">
                            <i class="fas fa-question"></i>
                        </div>
                        <h2><?php echo e(__('No data found')); ?> !!</h2>
                        <p class="lead">
                            <?php echo e(__('Sorry we cant find any data')); ?>.
                        </p>
                    </div>
                    <?php else: ?>

                    <div class="row ml-md-5">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(count($category_article[$category->uuid])): ?>
                        <div class="col-12 col-md-6 col-lg-6 wizard-steps">
                            <div class="card-body">
                             
                                    <div class="wizard-step">
                                        <a href="<?php echo e(route('articles.show', [$category->uuid])); ?>">
                                        <div class="wizard-step-label category custom_category ">
                                            <?php echo e(__($category->category_text)); ?>

                                        </div>
                                                 </a>
                                     
                                       
                                        <div class="card-body">
                                              <?php if(!count($category_article[$category->uuid])): ?>
                                                <div class="empty-state pt-3" data-height="400">
                                                    <div class="empty-state-icon bg-custom">
                                                        <i class="fas fa-question"></i>
                                                    </div>
                                                    <h2><?php echo e(__('No data found')); ?> !!</h2>
                                                    <p class="lead">
                                                        <?php echo e(__('Sorry we cant find any data')); ?>.
                                                    </p>
                                                </div>
                                            <?php else: ?>
                                      
                                        <?php $__currentLoopData = $category_article[$category->uuid]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>      
                                        <a class="nav-link kb-custom_article"
                                            href="<?php echo e(route('showArticle', [$article->slug])); ?>">
                                            <div class=" ">
                                            <?php echo e(__($article->title)); ?>

                                            </div>
                                        </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                         <?php endif; ?>
                                    
                                        </div>

                                    </div>
                       
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

            
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make( 
        ($theme =="white") ? 'tenant.layouts.public_white':
     ( ($theme =="red") ? 'tenant.layouts.public_red':
    (($theme =="green") ? 'tenant.layouts.public_green':
    (($theme =="black") ? 'tenant.layouts.public_black':
    (($theme =="blue") ?'tenant.layouts.public_blue':'tenant.layouts.public_yellow' ))))
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/tenant/article/index.blade.php ENDPATH**/ ?>