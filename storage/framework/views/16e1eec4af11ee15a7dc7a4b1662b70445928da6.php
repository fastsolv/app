<?php $__env->startSection('content'); ?>

<div class="section-header">
    <h1><?php echo e(__('Languages')); ?></h1>
    <div class="section-header-breadcrumb">
        
        <div class="breadcrumb-item"><?php echo e(__('Add a Language')); ?></div>
    </div>
</div>

<div class="section-body">

    <?php echo $__env->make('common.demo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Add a Language')); ?></h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="<?php echo e(route('language.store')); ?>">
                        <?php echo method_field('POST'); ?>
                        <?php echo csrf_field(); ?>
                        <div>
                            <div class="form-group row mb-4">
                                <label for="address"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Language')); ?>*</label>
                                <div class="col-sm-12 col-md-8">

                                    <input id="language" type="text"
                                        class="form-control <?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="language"
                                        value="<?php echo e(old('language')); ?>" autocomplete="language" autofocus>
                                    <?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger pt-1"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Code')); ?></label>
                                <div class="col-sm-12 col-md-8">

                                    <input id="code" type="text"
                                        class="form-control <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="code"
                                        value="<?php echo e(old('code')); ?>" autocomplete="code" autofocus>
                                    <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger pt-1"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <small class="text-secondary"><i class="fa fa-exclamation-circle"
                                            aria-hidden="true"></i>
                                        <?php echo e(__('The language code must be a two letter keyword based on ISO 2 letter (Alpha-2 code, ISO 639-1) standerd. Eg: en for English')); ?>.<br>
                                        <?php echo e(__('Reference: ')); ?> <a href="https://www.science.co.il/language/Codes.php"
                                            target="_blank" rel="noopener noreferrer">
                                            <?php echo e(__('Language codes')); ?> </a>
                                    </small>
                                </div>
                            </div>

                            <?php if(env('APP_ENV') != 'demo'): ?>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-8">
                                    <button type="submit" class="btn btn-custom"><?php echo e(__('Add')); ?></button>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block"><?php echo e(__('List of Languages')); ?></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if(!count($languages)): ?>
                        <div class="empty-state pt-3" data-height="400">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2><?php echo e(__('No data found')); ?> !!</h2>
                            <p class="lead">
                                <?php echo e(__('Sorry we cant find any data, to get rid of this message, make at least 1 entry')); ?>.
                            </p>
                        </div>
                        <?php else: ?>
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                    <th><?php echo e(__('Language')); ?></th>
                                    <th><?php echo e(__('Code')); ?></th>
                                    <?php if(env('APP_ENV') != 'demo'): ?>
                                    <th></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(__($language->language)); ?></td>
                                    <td><?php echo e(__($language->code)); ?></td>
                                    <td class="form-inline">
                                        <form action="<?php echo e(route('language.destroy', [$language->id])); ?>" method="POST">
                                            <?php echo method_field('DELETE'); ?>
                                            <?php echo csrf_field(); ?>
                                            <button class="btn btn-sm bg-transparent"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"
                                                    title="<?php echo e(__('Delete')); ?>"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.new_theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/app/resources/views/central/language/index.blade.php ENDPATH**/ ?>