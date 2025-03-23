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
  <link rel="stylesheet" href="<?php echo e(asset('css/white.css')); ?>">
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
              <?php if(Auth::check()): ?>
              <div class="d-sm-none d-lg-inline-block"><?php echo e(__('Hi')); ?>, <?php echo e(Auth::user()->name); ?></div>
              <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

              <a href="<?php echo e(route('profile')); ?>" class="dropdown-item has-icon">
                <i class="far fa-user"></i> <?php echo e(__('Profile')); ?>

              </a>

              <div class="dropdown-divider"></div>
              <a class="dropdown-item has-icon" target="_blank"
                href="https://ticketing.expert/basic_docs/1.1.0/user-doc.html"><i class="far fa-question-circle"></i>
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
              <img src="/system_logo/<?php echo e($logo); ?>" alt="<?php echo e($app_name); ?>" class="logo">
              <?php else: ?>
              <?php echo e($app_name); ?>

              <?php endif; ?>
            </a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href=""><?php echo e($app_name_short); ?></a>
          </div>
          <ul class="sidebar-menu">

            <?php if(Auth::check() && Auth::user()->role != 'null'): ?>
            <?php if(Auth::check() && Auth::user()->role != 'user'): ?>
            <li class="menu-header"><?php echo e(__('Dashboard')); ?></li>
            <li class="<?php echo e(Request::is('dashboard') ||  Request::is('/')? 'active' : ''); ?>"> <a class="nav-link"
                href="<?php echo e(route('dashboard')); ?>"><i class="fas fa-fire"></i><span><?php echo e(__('Dashboard')); ?></span></a>
            </li>
            
            
            <?php endif; ?>

            <li class="menu-header"><?php echo e(__('Ticket Area')); ?></li>

            <?php if(Auth::check() && Auth::user()->role != 'admin'): ?>

            <?php if($ticketCreatePermission==true ||Auth::check() && Auth::user()->role == 'user'): ?>
            <li class="<?php echo e(Request::is('ticket/create') ? 'active' : ''); ?>"> <a class="nav-link"
                href="<?php echo e(route('ticket.create')); ?>"><i
                  class="fas fa-pen-square"></i><span><?php echo e(__('Open Ticket')); ?></span></a>
            </li>
            <?php endif; ?>
            <?php endif; ?>

               <?php if(($imap_enables->value) == '1'): ?>
        
        <li class="<?php echo e(Request::is('imap_ticket*') || Request::is('imap_status_tickets*')  ? 'active' : ''); ?>"><a
            class="nav-link" href="<?php echo e(route('get_imap_ticket')); ?>"><i
              class="fas fa-envelope"></i><span><?php echo e(__('Email Tickets')); ?></span></a></li>
        <?php endif; ?>
  
        <?php if($ticketPermission==true ||Auth::check() && Auth::user()->role == 'admin'): ?>
        <li
          class="<?php echo e((Request::is('ticket*') &&  !Request::is('ticket/create') &&  !Request::is('ticket_status*')) || Request::is('status_tickets*') ? 'active' : ''); ?>">
          <a class="nav-link" href="<?php echo e(route('get_tickets')); ?>"><i
              class="fas fa-ticket-alt"></i><span><?php echo e(__('Web Tickets')); ?></span></a></li>
              <?php endif; ?>
            <?php if(Auth::check() && Auth::user()->role == 'staff'): ?>
            <li
              class="dropdown <?php echo e((Request::is('my_ticket') || Request::is('assigned_to_me') || Request::is('email_assigned_to_me')) ? 'active' : ''); ?>">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i>
                <span><?php echo e(__('My tickets')); ?></span></a>
              <ul class="dropdown-menu">
                <li class="<?php echo e(Request::is('my_ticket') ? 'active' : ''); ?>"><a class="nav-link"
                    href="<?php echo e(route('my_ticket')); ?>"><?php echo e(__('Tickets Opened By Me')); ?></a></li>
                <li class="<?php echo e(Request::is('assigned_to_me') ? 'active' : ''); ?>"><a class="nav-link"
                    href="<?php echo e(route('ticket_assigned_me')); ?>"><?php echo e(__('Assigned Web Tickets')); ?></a></li>
                    <?php if($emailAssignPermission==true ): ?>  
                <li class="<?php echo e(Request::is('email_assigned_to_me') ? 'active' : ''); ?>"><a class="nav-link"
                    href="<?php echo e(route('email_ticket_assigned_me')); ?>"><?php echo e(__('Assigned Email Tickets')); ?></a></li>
                    <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>

            <?php endif; ?>

            <?php if(Auth::check() && Auth::user()->role != 'user'): ?>
            <li class="menu-header"><?php echo e(__('Ticket General')); ?></li>

            <?php if( Auth::check() && Auth::user()->role == 'admin' ||$userPermission==true): ?>
            <li class="<?php echo e(Request::is('user*') ? 'active' : ''); ?>"> <a class="nav-link"
                href="<?php echo e(route('get_users')); ?>"><i class="fas fa-users"></i><span><?php echo e(__('Users')); ?></span></a>
            </li>
            <?php endif; ?>


            <li class="<?php echo e(Request::is('get_announcement*') ? 'active' : ''); ?>"> <a class="nav-link"
                href="<?php echo e(route('get_announcement')); ?>"><i class=" fa fa-solid fa-bullhorn"></i><span><?php echo e(__('Announcements')); ?></span></a>
            </li>
           
            <?php if($productPermission==true ||Auth::check() && Auth::user()->role == 'admin'): ?>
            <li class="<?php echo e(Request::is('product*') ? 'active' : ''); ?>"> <a class="nav-link"
                href="<?php echo e(route('products')); ?>"><i class="fa fa-suitcase" aria-hidden="true"></i><span><?php echo e(__('Products')); ?></span></a>
            </li>
            <?php endif; ?>
            <?php if($feedbackPermission==true ||Auth::check() && Auth::user()->role == 'admin'): ?>
            <li class="<?php echo e(Request::is('feedback*') ? 'active' : ''); ?>"> <a class="nav-link"
                href="<?php echo e(route('feedbacks')); ?>"><i class="fas fa-star" aria-hidden="true"></i><span><?php echo e(__('Feedback')); ?></span></a>
            </li>
            <?php endif; ?>

            <?php if(Auth::check() && Auth::user()->role == 'admin'): ?>
            <li class="<?php echo e(Request::is('roles*') ? 'active' : ''); ?>"> <a class="nav-link"
                href="<?php echo e(route('get_roles')); ?>"><i class="fas fa-user-lock" aria-hidden="true"></i><span><?php echo e(__('Roles & Permission')); ?></span></a>
            </li>
            <?php endif; ?>

            <?php if((Auth::check() && Auth::user()->role == 'admin') || $statusPermission==true): ?>
            <li class="<?php echo e(Request::is('ticket_status*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('get_ticket_statuses')); ?>"><i
                  class="fas fa-fill"></i><span><?php echo e(__('Ticket statuses')); ?></span></a></li>
            <?php endif; ?>
            <?php if((Auth::check() && Auth::user()->role == 'admin') ||$departmentPermission==true): ?>
            <li class="<?php echo e(Request::is('department*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('get_departments')); ?>"><i
                  class="fas fa-building"></i><span><?php echo e(__('Departments')); ?></span></a></li>
            <?php endif; ?>
            
            <?php if((Auth::check() && Auth::user()->role == 'admin') ||$emailTemplatePermission==true): ?>
            <li class="<?php echo e(Request::is('email_template*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('email_template.index')); ?>"><i
                  class="fas fa-envelope-open-text"></i><span><?php echo e(__('Email Templates')); ?></span></a></li>
                  <?php endif; ?>

                  <?php if(Auth::check() && Auth::user()->role == 'admin'): ?>
            <li class="<?php echo e(Request::is('tags*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('get_tags')); ?>"><i class="fas fa-tags"></i><span><?php echo e(__('Tags')); ?></span></a></li>
            <?php endif; ?>
            <?php if((Auth::check() && Auth::user()->role == 'admin') || $cannedResponsePermission == true): ?>
            <li class="<?php echo e(Request::is('canned_responses*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('get_canned_response')); ?>"><i
                  class="fas fa-reply"></i><span><?php echo e(__('Canned Responses')); ?></span></a></li>
                  <?php endif; ?>
            <li class="<?php echo e(Request::is('error_log*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('error_log.index')); ?>"><i
                  class="fas fa-exclamation-triangle"></i><span><?php echo e(__('Error Logs')); ?></span></a></li>
            <?php endif; ?>

            <?php if(Auth::check() && Auth::user()->role == 'admin'): ?>
            <li class="menu-header"><?php echo e(__('Admin Area')); ?></li>
            <li class="<?php echo e(Request::is('staff*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('get_staffs')); ?>"><i class="fas fa-users"></i><span><?php echo e(__('Staffs')); ?></span></a></li>
            <li class="<?php echo e(Request::is('settings*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('get_settings')); ?>"><i class="fas fa-cogs"></i><span><?php echo e(__('Settings')); ?></span></a>
            </li>
            <li class="<?php echo e(Request::is('language*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('get_languages')); ?>"><i class="fas fa-language"
                  aria-hidden="true"></i><span><?php echo e(__('Add language')); ?></span></a></li>
            <li class="<?php echo e(Request::is('theme.index') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('theme.index')); ?>"><i class="fa fa-paint-brush" aria-hidden="true"></i><span><?php echo e(__('Theme Settings')); ?></span></a></li>
                  
            <?php endif; ?>
            <?php if( (Auth::check() && Auth::user()->role == 'admin')||(Auth::check() && Auth::user()->role != 'user' &&($faqcategoryPermission==true|| $faqPermission==true||$kbcategoryPermission==true||$kbarticlePermission==true))): ?>
           
            <li class="menu-header"><?php echo e(__('Knowledge Base')); ?></li>
            <?php if((Auth::check() && Auth::user()->role == 'admin') || $faqcategoryPermission == true): ?>
            <li class="<?php echo e(Request::is('faq_category*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('get_faq_category')); ?>"><i
                  class="fas fa-stream"></i><span><?php echo e(__('FAQ Categories')); ?></span></a></li>
                  <?php endif; ?>
                  <?php if((Auth::check() && Auth::user()->role == 'admin') || $faqPermission == true): ?>
            <li class="<?php echo e(Request::is('faq*') && !Request::is('faq_category*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('get_faqs')); ?>"><i class="fas fa-question-circle"></i><span><?php echo e(__('FAQs')); ?></span></a>
            </li>
            <?php endif; ?>
            <?php if((Auth::check() && Auth::user()->role == 'admin') || $kbcategoryPermission == true): ?>
            <li class="<?php echo e(Request::is('kb_category*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('get_kb_category')); ?>"><i
                  class="fas fa-info-circle"></i><span><?php echo e(__('KB Categories')); ?></span></a></li>
                  <?php endif; ?>
                  <?php if((Auth::check() && Auth::user()->role == 'admin') || $kbarticlePermission == true): ?>
            <li class="<?php echo e(Request::is('kb_article*') ? 'active' : ''); ?>"><a class="nav-link"
                href="<?php echo e(route('get_kb_article')); ?>"><i class="fa fa-database"
                  aria-hidden="true"></i><span><?php echo e(__('KB Articles')); ?></span></a></li>
                  <?php endif; ?>

            <?php endif; ?>
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

  <!-- Template JS File -->
  <script src="<?php echo e(asset('js/script.js')); ?>"></script>
  <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
  <!-- Page Specific JS File -->
</body>

</html>
<?php /**PATH /srv/app/resources/views/tenant/layouts/white_theme.blade.php ENDPATH**/ ?>