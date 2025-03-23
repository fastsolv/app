<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ env('APP_NAME') }}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('css/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('css/summernote.min.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
  <link href="{{ asset('css/vue-select.css') }}" rel="stylesheet">
  <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
  <script src="{{ asset('js/vue.min.js') }}"></script>
  <script src="{{ asset('js/vue-select.js') }}"></script>
  <script src="{{ asset('js/axios.min.js') }}"></script>
  <link href="{{ asset('css/v-quill-editor.css') }}" rel="stylesheet">
  <script src="{{ asset('js/v-quill-editor.min.js') }}"></script>



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
              <div class="d-sm-none d-lg-inline-block">{{ __('Language.') }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              @foreach ($languages as $language)
              <a href="/lang/{{ $language->code }}" class="dropdown-item has-icon">
                {{ $language->language }}
              </a>
              @endforeach
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <i class="fa fa-user-circle mr-1"></i>
              <div class="d-sm-none d-lg-inline-block">{{ __('Hi') }}, {{ Auth::user()->first_name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

              <a href="{{ route('profile') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> {{ __('Profile') }}
              </a>

              <div class="dropdown-divider"></div>
              <a class="dropdown-item has-icon" target="_blank"
                href="https://ticketing.expert/saas_docs/1.0.0/"><i class="far fa-question-circle"></i>
                {{ __('Help') }}</a>
              <div class="dropdown-divider"></div>
              <a href{{ route('logout') }} class="dropdown-item has-icon text-danger pointer" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="">
              @if ($logo != null)
              <img src="/system_logo/{{ $logo }}" alt="{{ env('APP_NAME') }}" class="logo">
              @else
              {{ env('APP_NAME') }}
              @endif
            </a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="">{{ $app_name_short }}</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">{{ __('Dashboard') }}</li>
            <li class="{{ Request::is('dashboard') || Request::is('/') ? 'active' : '' }}"> <a class="nav-link"
                href="{{ route('dashboard') }}"><i class="fas fa-fire"></i><span>{{ __('Dashboard') }}</span></a>
            </li>

            <li class="menu-header">{{ __('Admin Area') }}</li>
            <li class="{{ Request::is('tenants*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('tenants.index') }}"><i class="fas fa-user-cog"></i><span>{{ __('Tenants') }}</span></a>
            </li>
            <li class="{{ Request::is('orders*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('orders.index') }}"><i class="fas fa-shopping-cart"
                  aria-hidden="true"></i><span>{{ __('Orders') }}</span></a></li>
            <li class="{{ Request::is('invoices*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('invoices.index') }}"><i
                  class="fas fa-file-invoice"></i><span>{{ __('Invoices') }}</span></a></li>
            <li class="{{ Request::is('services*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('services.index') }}"><i
                  class="fas fa-list"></i><span>{{ __('Subscriptions') }}</span></a></li>
            <li class="{{ Request::is('users*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('users.index') }}"><i class="fas fa-users"
                  aria-hidden="true"></i><span>{{ __('Users') }}</span></a></li>
            <li class="{{ Request::is('plans*') || Request::is('pricing*') ? 'active' : '' }}"> <a class="nav-link"
                href="{{ route('plans.index') }}"><i class="fas fa-pen-square"></i><span>{{ __('Plans') }}</span></a>
            </li>
            <li class="{{ Request::is('gateways*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('gateways.index') }}"><i class="fas fa-credit-card"
                  aria-hidden="true"></i><span>{{ __('Gateways') }}</span></a></li>

            <li class="menu-header">{{ __('Settings') }}</li>
            <li class="{{ Request::is('currency*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('currency.index') }}"><i class="fas fa-language"
                  aria-hidden="true"></i><span>{{ __('Currencies') }}</span></a></li>
            <li class="{{ Request::is('billing_address*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('billing_address.index') }}"><i
                  class="fas fa-address-card"></i><span>{{ __('Billing Address') }}</span></a></li>
            <li class="{{ Request::is('language*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('language.index') }}"><i class="fas fa-language"
                  aria-hidden="true"></i><span>{{ __('Languages') }}</span></a></li>
            <li class="{{ Request::is('settings*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('admin_settings.index') }}"><i class="fas fa-cogs"></i><span>{{ __('System Settings') }}</span></a>
            </li>
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          @yield('content')
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          {{ $footer_text }}
        </div>
        <div class="footer-right">
          <a href="{{ route('privacyPolicy') }}" class="pr-3 text-secondary">{{ __('Privacy Policy') }}</a><a
            href="{{ route('terms') }}" class="pr-3 text-secondary">{{ __('Terms of Use') }}</a><span>T.E 1.1.0</span>
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('js/main.js') }}"></script>
  <script src="{{ asset('js/stisla.js') }}"></script>

  <!-- JS Libraies -->
  <script src="{{ asset('js/library.js') }}"></script>
  <script src="{{ asset('js/chart.min.js') }}"></script>
  <script src="{{ asset('js/chart.js') }}"></script>
  <script src="{{ asset('js/datepicker.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ asset('js/script.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  <!-- Page Specific JS File -->
</body>

</html>