<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo e($app_name); ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/fontawesome.css')); ?>">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo e(asset('css/selectric.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/summernote-bs4.min.css')); ?>">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo e(asset('css/black.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/components.css')); ?>">
  <link href="<?php echo e(asset('css/vue-select.css')); ?>" rel="stylesheet">
  <script src="<?php echo e(asset('js/vue.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/vue-select.js')); ?>"></script>
  <script src="<?php echo e(asset('js/axios.min.js')); ?>"></script>
  <link href="<?php echo e(asset('css/v-quill-editor.css')); ?>" rel="stylesheet">
  <script src="<?php echo e(asset('js/v-quill-editor.min.js')); ?>"></script>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar  navbar-expand-lg main-navbar user-navbar">
        <div>
          <a class="user-brand sidebar-brand" href="<?php echo e(route('home')); ?>">
            <?php if($logo != null): ?>
            <img src="/system_logo/<?php echo e($logo); ?>" alt="<?php echo e($app_name); ?>" class="logo">
            <?php else: ?>
            <?php echo e($app_name); ?>

            <?php endif; ?>
          </a>
        </div>


        <ul class="navbar-nav navbar-right float-right ml-auto">
          <li><a class="nav-link   nav-link-lg nav-link-user" href="<?php echo e(route('get_tickets')); ?>">
            <i class="fas fa-ticket-alt mr-1" aria-hidden="true"></i>
            <div class="d-sm-none d-lg-inline-block"><?php echo e(__("Ticket")); ?></div>
          </a>
        </li>
          <li><a class="nav-link   nav-link-lg nav-link-user" href="<?php echo e(route('articles.index')); ?>">
              <i class="fa fa-database mr-1" aria-hidden="true"></i>
              <div class="d-sm-none d-lg-inline-block"><?php echo e(__('Knowledge Base')); ?></div>
            </a>
          </li>
          <li><a class="nav-link   nav-link-lg nav-link-user" href="<?php echo e(route('user_announcements')); ?>">
          <i class=" fa fa-solid fa-bullhorn"></i>
              <div class="d-sm-none d-lg-inline-block"><?php echo e(__('Announcement ')); ?></div>
            </a>
          </li>
          <li><a class="nav-link   nav-link-lg nav-link-user" href="<?php echo e(route('faq_list.index')); ?>">
              <i class="fas fa-question-circle mr-1"></i>
              <div class="d-sm-none d-lg-inline-block"><?php echo e(__('FAQs')); ?></div>
            </a>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <i class="fas fa-globe-asia mr-1"></i>
              <div class="d-sm-none d-lg-inline-block"><?php echo e(__('Language.')); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="/lang/<?php echo e($language->code); ?>" class="dropdown-item has-icon">
                <?php echo e($language->language); ?>

              </a>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <i class="fa fa-user-circle mr-1"></i>
              <div class="d-sm-none d-lg-inline-block"><?php echo e(__('Hi')); ?>, <?php echo e(Auth::user()->name); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              

              <a href="<?php echo e(route('profile')); ?>" class="dropdown-item has-icon">
                <i class="far fa-user"></i> <?php echo e(__('Profile')); ?>

              </a>

              <div class="dropdown-divider"></div>
              <a class="dropdown-item has-icon" href=""><i class="far fa-question-circle"></i> <?php echo e(__('Help')); ?></a>
              <div class="dropdown-divider"></div>
              <a href<?php echo e(route('logout')); ?> class="dropdown-item has-icon text-danger pointer" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> <?php echo e(__('Logout')); ?>

              </a>
              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
              </form>
            </div>
          </li>
        </ul>
      </nav>

      <!-- Main Content -->
      <div class="main-content main-sm-user main-user pl-md-5 pr-md-5">
        <section class="section">
          <?php echo $__env->yieldContent('content'); ?>
        </section>
      </div>
      <footer class="main-footer public-footer">
        <div class="footer-left">
          <?php echo e($footer_text); ?>

        </div>
        <div class="footer-right">
          <a href="<?php echo e(route('privacyPolicy')); ?>" class="pr-3 text-secondary"><?php echo e(__('Privacy Policy')); ?></a><a
            href="<?php echo e(route('terms')); ?>" class="pr-3 text-secondary"><?php echo e(__('Terms of Use')); ?></a><span>T.E 1.0.0</span>
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?php echo e(asset('js/main.js')); ?>"></script>
  <script src="<?php echo e(asset('js/stisla.js')); ?>"></script>

  <!-- JS Libraies -->
  <script src="<?php echo e(asset('js/library.js')); ?>"></script>

  <!-- Template JS File -->
  <script src="<?php echo e(asset('js/script.js')); ?>"></script>
  <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
  <!-- Page Specific JS File -->
</body>

</html>
<?php /**PATH /srv/app/resources/views/tenant/layouts/black_user_theme.blade.php ENDPATH**/ ?>