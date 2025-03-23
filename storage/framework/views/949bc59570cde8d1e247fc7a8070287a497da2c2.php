<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo e(env('APP_NAME')); ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/fontawesome.css')); ?>">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo e(asset('css/selectric.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/summernote.min.css')); ?>">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/components.css')); ?>">
  <link href="<?php echo e(asset('css/vue-select.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('css/datepicker.css')); ?>" rel="stylesheet">
  <script src="<?php echo e(asset('js/vue.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/vue-select.js')); ?>"></script>
  <script src="<?php echo e(asset('js/axios.min.js')); ?>"></script>
  <link href="<?php echo e(asset('css/v-quill-editor.css')); ?>" rel="stylesheet">
  <script src="<?php echo e(asset('js/v-quill-editor.min.js')); ?>"></script>



</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
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
              <div class="d-sm-none d-lg-inline-block"><?php echo e(__('Hi')); ?>, <?php echo e(Auth::user()->first_name); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

              <a href="<?php echo e(route('profile')); ?>" class="dropdown-item has-icon">
                <i class="far fa-user"></i> <?php echo e(__('Profile')); ?>

              </a>

              <div class="dropdown-divider"></div>
              <a class="dropdown-item has-icon" target="_blank"
                href="https://ticketing.expert/saas_docs/1.0.0/"><i class="far fa-question-circle"></i>
                <?php echo e(__('Help')); ?></a>
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
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="">
              <?php if($logo != null): ?>
              <img src="/system_logo/<?php echo e($logo); ?>" alt="<?php echo e(env('APP_NAME')); ?>" class="logo">
              <?php else: ?>
              <?php echo e(env('APP_NAME')); ?>

              <?php endif; ?>
            </a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href=""><?php echo e($app_name_short); ?></a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header"><?php echo e(__('Dashboard')); ?></li>
            <li class="<?php echo e(Request::is('dashboard') || Request::is('/') ? 'active' : ''); ?>"> <a class="nav-link"
                href="<?php echo e(route('dashboard')); ?>"><i class="fas fa-fire"></i><span><?php echo e(__('Dashboard')); ?></span></a>
            </li>

            <li class="menu-header"><?php echo e(__('Admin Area')); ?></li>
            <li class="<?php echo e(Request::is('tenants*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('tenants.index')); ?>"><i class="fas fa-user-cog"></i><span><?php echo e(__('Tenants')); ?></span></a>
            </li>
            <li class="<?php echo e(Request::is('orders*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('orders.index')); ?>"><i class="fas fa-shopping-cart"
                  aria-hidden="true"></i><span><?php echo e(__('Orders')); ?></span></a></li>
            <li class="<?php echo e(Request::is('invoices*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('invoices.index')); ?>"><i
                  class="fas fa-file-invoice"></i><span><?php echo e(__('Invoices')); ?></span></a></li>
            <li class="<?php echo e(Request::is('services*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('services.index')); ?>"><i
                  class="fas fa-list"></i><span><?php echo e(__('Subscriptions')); ?></span></a></li>
            <li class="<?php echo e(Request::is('users*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('users.index')); ?>"><i class="fas fa-users"
                  aria-hidden="true"></i><span><?php echo e(__('Users')); ?></span></a></li>
            <li class="<?php echo e(Request::is('plans*') || Request::is('pricing*') ? 'active' : ''); ?>"> <a class="nav-link"
                href="<?php echo e(route('plans.index')); ?>"><i class="fas fa-pen-square"></i><span><?php echo e(__('Plans')); ?></span></a>
            </li>
            <li class="<?php echo e(Request::is('gateways*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('gateways.index')); ?>"><i class="fas fa-credit-card"
                  aria-hidden="true"></i><span><?php echo e(__('Gateways')); ?></span></a></li>

            <li class="menu-header"><?php echo e(__('Settings')); ?></li>
            <li class="<?php echo e(Request::is('currency*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('currency.index')); ?>"><i class="fas fa-language"
                  aria-hidden="true"></i><span><?php echo e(__('Currencies')); ?></span></a></li>
            <li class="<?php echo e(Request::is('billing_address*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('billing_address.index')); ?>"><i
                  class="fas fa-address-card"></i><span><?php echo e(__('Billing Address')); ?></span></a></li>
            <li class="<?php echo e(Request::is('language*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('language.index')); ?>"><i class="fas fa-language"
                  aria-hidden="true"></i><span><?php echo e(__('Languages')); ?></span></a></li>
            <li class="<?php echo e(Request::is('settings*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('admin_settings.index')); ?>"><i class="fas fa-cogs"></i><span><?php echo e(__('System Settings')); ?></span></a>
            </li>
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <?php echo $__env->yieldContent('content'); ?>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          <?php echo e($footer_text); ?>

        </div>
        <div class="footer-right">
          <a href="<?php echo e(route('privacyPolicy')); ?>" class="pr-3 text-secondary"><?php echo e(__('Privacy Policy')); ?></a><a
            href="<?php echo e(route('terms')); ?>" class="pr-3 text-secondary"><?php echo e(__('Terms of Use')); ?></a><span>T.E 1.1.0</span>
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?php echo e(asset('js/main.js')); ?>"></script>
  <script src="<?php echo e(asset('js/stisla.js')); ?>"></script>

  <!-- JS Libraies -->
  <script src="<?php echo e(asset('js/library.js')); ?>"></script>
  <script src="<?php echo e(asset('js/chart.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/chart.js')); ?>"></script>
  <script src="<?php echo e(asset('js/datepicker.js')); ?>"></script>

  <!-- Template JS File -->
  <script src="<?php echo e(asset('js/script.js')); ?>"></script>
  <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
  <!-- Page Specific JS File -->
</body>

</html><?php /**PATH /srv/app/resources/views/central/layouts/new_theme.blade.php ENDPATH**/ ?>