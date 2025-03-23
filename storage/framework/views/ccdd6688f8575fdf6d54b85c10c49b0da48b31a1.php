<?php $__env->startSection('content'); ?>

<div class="section-header col-10 offset-1">
    <h1><?php echo e(__('FAQs')); ?></h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-10 offset-1">
            <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-body">
                    <?php if(!count($faq_categories)): ?>
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
                    <?php $__currentLoopData = $faq_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($faqs[$faq_category->uuid])): ?>
                    <div class="card card-custom-shadow">
                        <div class="card-header">
                            <h3 class="inline-block custom-title"><?php echo e($faq_category->category_text); ?></h3>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-12">
                                    <div id="accordion" class="myaccordion w-100" aria-multiselectable="true">
                                        <?php $__currentLoopData = $faqs[$faq_category->uuid]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card faq-card">
                                            <div class="card-header custom-faq-card" id="<?php echo e($faq->question); ?>">
                                                <h2>
                                                    <button href="#target<?php echo e($faq->uuid); ?>"
                                                        class="d-flex align-items-center justify-content-between btn bg-custom-shade faq-btn"
                                                        data-parent="#accordion" data-toggle="collapse"
                                                        aria-expanded="false" aria-controls="<?php echo e($faq->uuid); ?>">
                                                        <p class="mb-00 custom-p"><?php echo strip_tags($faq->question); ?></p>
                                                        <i class="fas fa-chevron-right"></i>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div class="collapse" id="target<?php echo e($faq->uuid); ?>" role="tabpanel"
                                                aria-labelledby="<?php echo e($faq->question); ?>">
                                                <div class="card-body custom-collapse">
                                                    <?php echo $faq->answer; ?>

                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
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
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/tenant/faq/show.blade.php ENDPATH**/ ?>