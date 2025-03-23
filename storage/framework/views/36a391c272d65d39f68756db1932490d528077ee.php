<?php $__env->startSection('content'); ?>

<div class="section-header col-12 col-md-10 offset-md-1">
    <h1><?php echo e(__('Announcements')); ?></h1>
</div>

<div class="section-body">
<?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="card mb-n3">
                <div class="card-header">
                    <h4><?php echo e($announcement->title); ?></h4>
                   
                </div>
                <div class="card-body px-4">
                <p class="announce-mt"><?php echo e($announcement->announcement); ?></p>
                    <p> <span> <i class=" fa fa-regular fa-calendar"></i></span><span> <?php echo e($announcement->created_at->format('d-M-Y H:i D')); ?></span> </p>
                </div>
            </div>
        </div>
       
    </div>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make( 
        ($theme =="white") ? 'tenant.layouts.public_white':
     ( ($theme =="red") ? 'tenant.layouts.public_red':
    (($theme =="green") ? 'tenant.layouts.public_green':
    (($theme =="black") ? 'tenant.layouts.public_black':
    (($theme =="blue") ?'tenant.layouts.public_blue':'tenant.layouts.public_yellow' ))))
    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/tenant/announcement/user/index.blade.php ENDPATH**/ ?>