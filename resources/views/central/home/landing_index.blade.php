<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Sassly HTML5 Template">

  <title>Sassly Customer Service</title>

  <!-- Fav Icon -->
  <link rel="icon" type="image/x-icon" href="../{{ asset('sassly/imgs/logo/favicon.webp') }}">

  <!-- All CSS files -->
  <link rel="stylesheet" href="{{ asset('sassly/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('sassly/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('sassly/css/swiper-bundle.min.css') }}">
  <link rel="stylesheet" href="{{ asset('sassly/css/progressbar.css') }}">
  <link rel="stylesheet" href="{{ asset('sassly/css/meanmenu.min.css') }}">
  <link rel="stylesheet" href="{{ asset('sassly/css/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('sassly/css/master-customer-service.css') }}">

  <style>
    .user-brand img{
      max-width: 60%;
    }
  </style>

</head>


<body class="font-heading-pt-serif-regular">

  <!-- Preloader -->
  <div id="preloader">
    <div id="container" class="container-preloader">
      <div class="animation-preloader">
        <div class="spinner"></div>
        <div class="txt-loading">
            <span data-text="F" class="characters">F</span>
            <span data-text="A" class="characters">A</span>
            <span data-text="S" class="characters">S</span>
            <span data-text="T" class="characters">T</span>
            <span data-text="S" class="characters">S</span>
            <span data-text="O" class="characters">O</span>
            <span data-text="L" class="characters">L</span>
            <span data-text="V" class="characters">V</span>
        </div>
      </div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
  </div>

  <!-- Cursor Animation -->
  <div class="cursor1"></div>

  <!-- Sroll to top -->
  <div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
    </svg>
  </div>

  <!-- Switcher Area Start -->
  <div class="switcher__area">
    <div class="switcher__icon">
      <button id="switcher_open"><i class="fa-solid fa-gear"></i></button>
      <button id="switcher_close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="switcher__items">
      <div class="switcher__item">
        <div class="switch__title-wrap">
          <p class="switcher__title">Language Support</p>
        </div>
        <div class="switcher__btn lang_dir wc-col-2">
          <button class="active" data-mode="ltr">LTR</button>
          <button data-mode="rtl">RTL</button>
        </div>
      </div>
      <div class="switcher__item">
        <div class="switch__title-wrap">
          <p class="switcher__title">Layout</p>
        </div>
        <div class="switcher__btn layout-type wc-col-2">
          <button class="active" data-mode="full-width">Full Width</button>
          <button data-mode="box-layout">Box Layout</button>
        </div>
      </div>
      <div class="switcher__item">
        <div class="switch__title-wrap">
          <p class="switcher__title">Cursor</p>
        </div>
        <div class="switcher__btn">
          <select name="cursor-style" id="cursor_style">
            <option value="1">default</option>
            <option selected value="2">animated</option>
          </select>
        </div>
      </div>
    </div>
  </div>
  <!-- Switcher Area End -->

  <!-- offcanvas start  -->
  <div class="offcanvas-area">
    <div class="offcanvas-area-meta-wrapper">
      <span id="close_offcanvas" class="close-offcanvas">
        <a class="user-brand sidebar-brand" href="{{ route('home') }}">
            @if ($logo != null)
            <img src="/system_logo/{{ $logo }}" alt="{{ env('APP_NAME') }}" class="logo">
            @else
            {{ env('APP_NAME') }}
            @endif
        </a>
      </span>
      <div class="offcanvas-btn-wrapper">
        <a target="_blank" href="https://themeforest.net/item/axtra-digital-agency-creative-portfolio-theme/43074408"
          class="wc-btn wc-btn-default btn-hover-cropping">Purchase now</a>
      </div>
    </div>
    <div class="offcanvas-area-menu-wrapper">
      <ul id="accordion" class="accordion">
        <li>
          <div class="link">Home <img class="angle-down" src="{{ asset('sassly/imgs/icon/angle-down.png') }}" alt="icon image">
          </div>
          <ul class="submenu">
            <li><a href="ai-content-writer.html">AI Content Writer</a></li>
            <li><a href="ai-image-generator.html">AI Image Generator</a></li>
            <li><a href="ai-chatbot.html">AI Chatbot</a></li>
            <li><a href="ai-seo.html">AI SEO Software</a></li>
            <li><a href="ai-software.html">AI Startups</a></li>
            <li><a href="ai-video-editor.html">AI Video Editor</a></li>
            <li><a href="booking.html">Booking Software</a></li>
            <li><a href="online-meeting.html">Virtual Meeting</a></li>
            <li><a href="crm.html">CRM Software</a></li>
            <li><a href="customer-service.html"  class="active-page">Customer Support</a></li>
            <li><a href="mobile-apps.html">Mobile App / SASS</a></li>
            <li><a href="marketing-automation.html">Marketing automation</a></li>
          </ul>
        </li>
        <li>
        <li><a href="about.html">About</a></li>
        <li>
          <div class="link">Pages<img class="angle-down" src="{{ asset('sassly/imgs/icon/angle-down.png') }}" alt="icon image"></div>
          <ul class="submenu">
            <li><a href="integration.html">integration</a></li>
            <li><a href="integration-single.html">integration single</a></li>
            <li><a href="about.html">about</a></li>
            <li><a href="contact.html">contact</a></li>
            <li><a href="404.html">404</a></li>
            <li><a href="pricing.html">pricing</a></li>
            <li><a href="faq.html">faq</a></li>
            <li><a href="all-template.html">video templete</a></li>
            <li><a href="team.html">team page</a></li>
            <li><a href="privacy-policy.html">privacy policy</a></li>
          </ul>
        </li>
        <li><a href="pricing.html">Pricing</a></li>
        <li><a href="team.html">Team</a></li>
        <li><a href="faq.html">FaQ</a></li>
        <li>
          <div class="link">Blog<img class="angle-down" src="{{ asset('sassly/imgs/icon/angle-down.png') }}" alt="icon image"></div>
          <ul class="submenu">
            <li><a href="blog.html">Our Blog</a></li>
            <li><a href="blog-details.html">Blog Details</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <!-- offcanvas end  -->


  <!-- search modal start -->
  <div class="modal fade" id="search-template" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="search-template" aria-hidden="true">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <form action="#" class="form-search">
            <input type="text" placeholder="Search">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- search modal end -->

  <!-- Header area start -->
  <header class="header-area style-1 pos-abs zi-9">
    <div id="elementToRemove" class="offer-note">
      <p class="text">All plans have <span>30% OFF</span> For this week <span><a href="contact.html">Claim
            Discount</a></span></p>
      <button id="removeButton" class="close-offer"><img src="{{ asset('sassly/imgs/icon/cross-light.webp') }}"
          alt="icon image"></button>
    </div>
    <div class="container">
      <div class="header-area__inner">
        <div class="header__logo">
            <a class="user-brand sidebar-brand" href="{{ route('home') }}">
                @if ($logo != null)
                <img src="/system_logo/{{ $logo }}" alt="{{ env('APP_NAME') }}" class="logo">
                @else
                {{ env('APP_NAME') }}
                @endif
            </a>
        </div>
        <div class="header__nav pos-center">
          <nav class="main-menu">
            <ul>
              <li class="menu-item-has-children"><a href="index.html">home</a>
                <ul class="dp-menu">
                  <li><a href="ai-content-writer.html">AI Content Writer</a></li>
                  <li><a href="ai-image-generator.html">AI Image Generator</a></li>
                  <li><a href="ai-chatbot.html">AI Chatbot</a></li>
                  <li><a href="ai-seo.html">AI SEO Software</a></li>
                  <li><a href="ai-software.html">AI Startups</a></li>
                  <li><a href="ai-video-editor.html">AI Video Editor</a></li>
                  <li><a href="booking.html">Booking Software</a></li>
                  <li><a href="online-meeting.html">Virtual Meeting</a></li>
                  <li><a href="crm.html">CRM Software</a></li>
                  <li><a href="customer-service.html" class="active-page">Customer Support</a></li>
                  <li><a href="mobile-apps.html">Mobile App / SASS</a></li>
                  <li><a href="marketing-automation.html">Marketing automation</a></li>
                </ul>
              </li>
              <li><a href="about.html">about</a></li>
              <li class="menu-item-has-children">
                <a href="#">Pages</a>
                <ul class="dp-menu">
                  <li><a href="integration.html">integration</a></li>
                  <li><a href="integration-single.html">integration single</a></li>
                  <li><a href="about.html">about</a></li>
                  <li><a href="contact.html">contact</a></li>
                  <li><a href="404.html">404</a></li>
                  <li><a href="pricing.html">pricing</a></li>
                  <li><a href="faq.html">faq</a></li>
                  <li><a href="all-template.html">video templete</a></li>
                  <li><a href="team.html">team page</a></li>
                  <li><a href="privacy-policy.html">privacy policy</a></li>
                </ul>
              </li>
              <li>
                <a href="#">blog</a>
                <ul class="dp-menu">
                  <li><a href="blog.html">blog</a></li>
                  <li><a href="blog-details.html">blog details</a></li>
                </ul>
              </li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
          </nav>
        </div>
        <div class="header__button">
          <a href="{{ route('login') }}" class="wc-btn wc-btn-primary btn-text-flip bordered"> <span data-text="Login">Login</span></a>
          <a href="{{ route('register') }}" class="wc-btn wc-btn-primary btn-text-flip"> <span data-text="Sign up">Register</span></a>
        </div>
        <div class="header__navicon d-xl-none">
          <button onclick="showCanvas3()" class="open-offcanvas">
            <i class="fa-solid fa-bars"></i></button>
        </div>
      </div>
    </div>
  </header>
  <!-- Header area end -->

  <div class="has-smooth" id="has_smooth"></div>
  <div id="smooth-wrapper">
    <div id="smooth-content">
      <div class="body-wrapper body-booking">

        <!-- overlay switcher close  -->
        <div class="overlay-switcher-close"></div>


        <main>

          <!-- hero area start  -->
          <section class="hero-area">
            <div class="container">
              <div class="hero-area-inner">
                <div class="section-content">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h1 class="section-title has_fade_anim">Automate
                        your customer
                        service with
                        Sassly</h1>
                    </div>
                  </div>
                  <div class="text-wrapper">
                    <p class="text has_fade_anim" data-delay="0.30">Leave pen-and-paper bookings in the past allowing
                      you to focus more on
                      your business
                      or simply enjoy your newfound free time.</p>
                  </div>
                  <div class="form-wrapper has_fade_anim" data-delay="0.45">
                    <form action="#" class="subscribe-form">
                      <div class="input-field">
                        <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                        <input type="email" placeholder="Enter your email">
                      </div>
                      <button type="submit" class="subscribe-btn wc-btn-primary btn-text-flip"><span
                          data-text="Get started">Get started</span></button>
                    </form>
                  </div>
                  <div class="feature-list has_fade_anim" data-delay="0.60">
                    <ul>
                      <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">No credit card required</li>
                      <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">14 days free trial</li>
                    </ul>
                  </div>
                </div>
                <div class="hero-thumb">
                  <div class="img-1">
                    <img src="{{ asset('sassly/imgs/gallery/img-s-22.webp') }}" alt="gallery image">
                  </div>
                  <div class="img-2">
                    <img src="{{ asset('sassly/imgs/gallery/img-s-23.webp') }}" alt="gallery image">
                  </div>
                  <div class="img-3">
                    <img src="{{ asset('sassly/imgs/gallery/img-s-24.webp') }}" data-speed="0.85" alt="gallery image">
                  </div>
                  <div class="img-4">
                    <img src="{{ asset('sassly/imgs/gallery/img-s-25.webp') }}" data-speed="1.15" alt="gallery image">
                  </div>
                  <div class="shape-1">
                    <img src="{{ asset('sassly/imgs/shape/shape-s-20.webp') }}" alt="shape image">
                  </div>
                  <div class="shape-2">
                    <img src="{{ asset('sassly/imgs/shape/shape-s-21.webp') }}" alt="shape image">
                  </div>
                  <div class="shape-3">
                    <img src="{{ asset('sassly/imgs/shape/shape-s-22.webp') }}" alt="shape image">
                  </div>
                  <div class="shape-4">
                    <img src="{{ asset('sassly/imgs/shape/shape-s-23.webp') }}" alt="shape image">
                  </div>
                  <div class="shape-5">
                    <img src="{{ asset('sassly/imgs/shape/shape-s-24.webp') }}" alt="shape image">
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- hero area end  -->

          <!-- brand area start  -->
          <div class="brand-area section-spacing pb-0">
            <div class="container">
              <div class="text-wrapper">
                <p class="text has_fade_anim">Sassly software trusted by the great company</p>
              </div>
              <div class="brand-logos has_fade_anim">
                <div class="swiper brand-active">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="logo">
                        <img src="{{ asset('sassly/imgs/brand/img-s-15.webp') }}" alt="logo">
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="logo">
                        <img src="{{ asset('sassly/imgs/brand/img-s-16.webp') }}" alt="logo">
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="logo">
                        <img src="{{ asset('sassly/imgs/brand/img-s-17.webp') }}" alt="logo">
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="logo">
                        <img src="{{ asset('sassly/imgs/brand/img-s-18.webp') }}" alt="logo">
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="logo">
                        <img src="{{ asset('sassly/imgs/brand/img-s-19.webp') }}" alt="logo">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- brand area end  -->

          <!-- advantage area start  -->
          <section class="advantage-area section-spacing pb-0">
            <div class="container">
              <div class="advantage-area-inner">
                <div class="shape-1">
                  <img src="{{ asset('sassly/imgs/shape/shape-s-25.webp') }}" data-speed="0.8" alt="shape image">
                </div>
                <div class="shape-2">
                  <img src="{{ asset('sassly/imgs/shape/shape-s-26.webp') }}" data-speed="0.8" alt="shape image">
                </div>
                <div class="shape-3">
                  <img src="{{ asset('sassly/imgs/shape/shape-s-27.webp') }}" data-speed="0.8" alt="shape image">
                </div>
                <div class="section-header">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h2 class="section-title has_fade_anim">Faster advantage for
                        support team workspace.</h2>
                    </div>
                  </div>
                  <div class="text-wrapper">
                    <p class="text has_fade_anim">Deliver happiness to your customers and get them to adore you! Desk
                      helps you be
                      more
                      accessible</p>
                  </div>
                </div>
                <div class="content-wrapper-box">
                  <div class="content-wrapper">
                    <div class="advantage-cards">
                      <ul class="nav nav-tabs has_fade_anim" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <div class="nav-link active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home-tab-pane" role="tab" aria-controls="home-tab-pane"
                            aria-selected="true">
                            <div class="advantage-card">
                              <div class="card-icon">
                                <img src="{{ asset('sassly/imgs/icon/icon-s-12.webp') }}" alt="icon image">
                              </div>
                              <div class="card-text">
                                <p class="text has_fade_anim">Create task for any
                                  team person</p>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="nav-item" role="presentation">
                          <div class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                            role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                            <div class="advantage-card">
                              <div class="card-icon">
                                <img src="{{ asset('sassly/imgs/icon/icon-s-13.webp') }}" alt="icon image">
                              </div>
                              <div class="card-text">
                                <p class="text">Third party data
                                  protection</p>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="nav-item" role="presentation">
                          <div class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                            role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                            <div class="advantage-card">
                              <div class="card-icon">
                                <img src="{{ asset('sassly/imgs/icon/icon-s-14.webp') }}" alt="icon image">
                              </div>
                              <div class="card-text">
                                <p class="text">Get task completed
                                  by your members</p>
                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="advantage-content">

                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                          aria-labelledby="home-tab" tabindex="0">
                          <div class="advantage-card-content">
                            <div class="advantage-thumb">
                              <img src="{{ asset('sassly/imgs/gallery/img-s-26.webp') }}" alt="gallery image">
                            </div>
                            <div class="advantage-desctiption">
                              <div class="title-wrapper">
                                <h2 class="title has_fade_anim">Continue your dialogue
                                  with clarifying info and
                                  request.</h2>
                              </div>
                              <div class="text-wrapper">
                                <p class="text has_fade_anim">Deliver happiness to your customers and get them to adore
                                  you! Desk
                                  helps you be more accessible to provide them with quick resolutions</p>
                              </div>
                              <div class="btn-wrapper has_fade_anim">
                                <a href="contact.html" class="wc-btn wc-btn-underline btn-text-flip"> <span
                                    data-text="Learn more">Learn more</span></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                          tabindex="0">
                          <div class="advantage-card-content">
                            <div class="advantage-thumb">
                              <img src="{{ asset('sassly/imgs/gallery/img-s-26.webp') }}" alt="gallery image">
                            </div>
                            <div class="advantage-desctiption">
                              <div class="title-wrapper">
                                <h2 class="title">Continue your dialogue
                                  with clarifying info and
                                  request.</h2>
                              </div>
                              <div class="text-wrapper">
                                <p class="text">Deliver happiness to your customers and get them to adore you! Desk
                                  helps
                                  you be more accessible to provide them with quick resolutions</p>
                              </div>
                              <div class="btn-wrapper">
                                <a href="contact.html" class="wc-btn wc-btn-underline btn-text-flip"> <span
                                    data-text="Learn more">Learn more</span></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                          tabindex="0">
                          <div class="advantage-card-content">
                            <div class="advantage-thumb">
                              <img src="{{ asset('sassly/imgs/gallery/img-s-26.webp') }}" alt="gallery image">
                            </div>
                            <div class="advantage-desctiption">
                              <div class="title-wrapper">
                                <h2 class="title">Continue your dialogue
                                  with clarifying info and
                                  request.</h2>
                              </div>
                              <div class="text-wrapper">
                                <p class="text">Deliver happiness to your customers and get them to adore you! Desk
                                  helps
                                  you be more accessible to provide them with quick resolutions</p>
                              </div>
                              <div class="btn-wrapper">
                                <a href="contact.html" class="wc-btn wc-btn-underline btn-text-flip"> <span
                                    data-text="Learn more">Learn more</span></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- advantage area end  -->

          <!-- choose area start  -->
          <section class="choose-area">
            <div class="container">
              <div class="choose-area-inner">
                <div class="section-header">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h2 class="section-title has_fade_anim">Choose it for capture
                        leads and make buying
                        easy</h2>
                    </div>
                  </div>
                  <div class="meta">
                    <div class="text-wrapper">
                      <p class="text has_fade_anim">Track all metrics with custom reports. Maximize impact by analyzing
                        campaign
                        results and content performance easily. Personalize your emails</p>
                    </div>
                    <div class="btn-wrapper has_fade_anim">
                      <a href="contact.html" class="wc-btn wc-btn-underline btn-text-flip"> <span
                          data-text="Book a demo">Book a demo</span></a>
                    </div>
                  </div>
                </div>
                <div class="choose-cards-wrapper">
                  <div class="choose-cards">
                    <div class="has_fade_anim">
                      <a href="#">
                        <div class="choose-card-box">
                          <div class="title-wrapper">
                            <p class="title">Quick message reply
                              in one click.</p>
                          </div>
                          <div class="text-wrapper">
                            <p class="text">24/7 hours available</p>
                          </div>
                          <div class="thumb-wrapper">
                            <img src="{{ asset('sassly/imgs/icon/icon-s-15.webp') }}" alt="">
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="has_fade_anim">
                      <a href="#">
                        <div class="choose-card-box">
                          <div class="title-wrapper">
                            <p class="title">Fully responsive
                              layout.</p>
                          </div>
                          <div class="text-wrapper">
                            <p class="text">For all the device</p>
                          </div>
                          <div class="thumb-wrapper">
                            <img src="{{ asset('sassly/imgs/icon/icon-s-16.webp') }}" alt="">
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="has_fade_anim">
                      <a href="#">
                        <div class="choose-card-box">
                          <div class="title-wrapper">
                            <p class="title">Get instant support
                              for all day.</p>
                          </div>
                          <div class="text-wrapper">
                            <p class="text">Getting ready</p>
                          </div>
                          <div class="thumb-wrapper">
                            <img src="{{ asset('sassly/imgs/icon/icon-s-17.webp') }}" alt="">
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- choose area end  -->

          <!-- counter area start  -->
          <section class="counter-area section-spacing pb-0">
            <div class="container">
              <div class="counter-area-inner">
                <div class="shape-1">
                  <img src="{{ asset('sassly/imgs/shape/shape-s-28.webp') }}" data-speed="0.8" alt="shape image">
                </div>
                <div class="section-header">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h2 class="section-title has_fade_anim">Faster counter for
                        support team workspace.</h2>
                    </div>
                  </div>
                  <div class="text-wrapper">
                    <p class="text has_fade_anim">Deliver happiness to your customers and get them to adore you! Desk helps you be
                      more
                      accessible</p>
                  </div>
                </div>
                <div class="counter-wrapper-box fix has_fade_anim">
                  <div class="counter-wrapper">
                    <div class="counter-box">
                      <h3 class="number wc-counter">20M</h3>
                      <p class="text">Emails per month
                        and websites</p>
                    </div>
                    <div class="counter-box">
                      <h3 class="number wc-counter">95%</h3>
                      <p class="text">Client support and
                        satisfaction</p>
                    </div>
                    <div class="counter-box">
                      <h3 class="number wc-counter">5k+</h3>
                      <p class="text">Monthly campaign
                        with orders</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- counter area end  -->

          <!-- feature area start  -->
          <section class="feature-area section-spacing">
            <div class="container">
              <div class="feature-area-inner">
                <div class="shape-1">
                  <img src="{{ asset('sassly/imgs/shape/shape-s-29.webp') }}" data-speed="1.2" alt="shape image">
                </div>
                <div class="feature-thumb-wrapper">
                  <div class="feature-thumb">
                    <div class="main-image">
                      <img src="{{ asset('sassly/imgs/gallery/img-s-27.webp') }}" alt="gallery image">
                    </div>
                    <div class="image-2">
                      <img src="{{ asset('sassly/imgs/gallery/img-s-28.webp') }}"  alt="gallery image">
                    </div>
                    <div class="image-3">
                      <img src="{{ asset('sassly/imgs/gallery/img-s-29.webp') }}" data-speed="0.8" alt="gallery image">
                    </div>
                  </div>
                </div>
                <div class="section-content">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h2 class="section-title has_fade_anim">Optimize your
                        services and resize
                        business.</h2>
                    </div>
                  </div>
                  <div class="text-wrapper">
                    <p class="text has_fade_anim">Track all metrics with custom reports. Maximize impact by analyzing campaign results
                      and content performance easily. Personalize your emails</p>
                  </div>
                  <div class="feature-list-box has_fade_anim">
                    <div class="feature-list">
                      <div class="feature-list-item">
                        <span class="icon">
                          <img src="{{ asset('sassly/imgs/icon/check-6.webp') }}" alt="icon image">
                        </span>
                        <p class="text"><span>Automation builder</span> track your performance and more—all from a
                          single platform.</p>
                      </div>
                      <div class="feature-list-item">
                        <span class="icon">
                          <img src="{{ asset('sassly/imgs/icon/check-6.webp') }}" alt="icon image">
                        </span>
                        <p class="text"><span>Awesome dashboard</span> channel for businesses of any size. Start your
                          video course today.</p>
                      </div>
                    </div>
                  </div>
                  <div class="btn-wrapper has_fade_anim">
                    <a href="contact.html" class="wc-btn wc-btn-primary btn-text-flip"> <span
                        data-text="Signup now">Signup now</span></a>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- feature area end  -->

          <!-- testimonial area start  -->
          <section class="testimonial-area section-spacing pb-0">
            <div class="container">
              <div class="testimonial-area-inner">
                <div class="section-header">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h2 class="section-title has_fade_anim">Satisfied customers
                        feedback</h2>
                    </div>
                  </div>
                  <div class="text-wrapper">
                    <p class="text has_fade_anim">Deliver happiness to your customers and get them to adore you! Desk helps you be
                      more accessible</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testimonial-wrapper-box">
              <div class="testimonial-wrapper has_fade_anim">
                <div class="swiper testimonial-slider">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="testimonial-box">
                        <div class="ratings-list">
                          <ul>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                          </ul>
                        </div>
                        <p class="text">Improve audience engagement by segmenting. Boost your conversions by targeting
                          subsets from your contacts. Give them content they need.</p>
                        <div class="author">
                          <div class="avatar"><img src="{{ asset('sassly/imgs/client/img-s-5.webp') }}" alt="image"></div>
                          <div class="">
                            <h2 class="name">Charry Maron</h2>
                            <span class="meta-title">Developer</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="testimonial-box">
                        <div class="ratings-list">
                          <ul>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                          </ul>
                        </div>
                        <p class="text">Our social media engagement soared the first month of using this software that
                          actually get read, and don't just get lost in inboxes.</p>
                        <div class="author">
                          <div class="avatar"><img src="{{ asset('sassly/imgs/client/img-s-6.webp') }}" alt="image"></div>
                          <div class="">
                            <h2 class="name">Charry Maron</h2>
                            <span class="meta-title">Developer</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="testimonial-box">
                        <div class="ratings-list">
                          <ul>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                          </ul>
                        </div>
                        <p class="text">Simple, effective, and incredibly powerful. My site’s speed doubled, and my
                          bounce rate dropped. Thank you for this amazing tool!</p>
                        <div class="author">
                          <div class="avatar"><img src="{{ asset('sassly/imgs/client/img-s-7.webp') }}" alt="image"></div>
                          <div class="">
                            <h2 class="name">Charry Maron</h2>
                            <span class="meta-title">Developer</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="testimonial-box">
                        <div class="ratings-list">
                          <ul>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                          </ul>
                        </div>
                        <p class="text">Optimizing images never felt this easy. My website’s performance skyrocketed,
                          and my Google rankings followed suit. I couldn’t be happier!</p>
                        <div class="author">
                          <div class="avatar"><img src="{{ asset('sassly/imgs/client/img-s-8.webp') }}" alt="image"></div>
                          <div class="">
                            <h2 class="name">Charry Maron</h2>
                            <span class="meta-title">Developer</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="testimonial-box">
                        <div class="ratings-list">
                          <ul>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                          </ul>
                        </div>
                        <p class="text">I thought my site was fast until I optimized my images with this plugin. The
                          difference is astounding. It’s a game-changer for any website owner!</p>
                        <div class="author">
                          <div class="avatar"><img src="{{ asset('sassly/imgs/client/img-s-5.webp') }}" alt="image"></div>
                          <div class="">
                            <h2 class="name">Charry Maron</h2>
                            <span class="meta-title">Developer</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="testimonial-box">
                        <div class="ratings-list">
                          <ul>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                          </ul>
                        </div>
                        <p class="text">Improve audience engagement by segmenting. Boost your conversions by targeting
                          subsets from your contacts. Give them content they need.</p>
                        <div class="author">
                          <div class="avatar"><img src="{{ asset('sassly/imgs/client/img-s-5.webp') }}" alt="image"></div>
                          <div class="">
                            <h2 class="name">Charry Maron</h2>
                            <span class="meta-title">Developer</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="testimonial-box">
                        <div class="ratings-list">
                          <ul>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                          </ul>
                        </div>
                        <p class="text">Our social media engagement soared the first month of using this software that
                          actually get read, and don't just get lost in inboxes.</p>
                        <div class="author">
                          <div class="avatar"><img src="{{ asset('sassly/imgs/client/img-s-6.webp') }}" alt="image"></div>
                          <div class="">
                            <h2 class="name">Charry Maron</h2>
                            <span class="meta-title">Developer</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="testimonial-box">
                        <div class="ratings-list">
                          <ul>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                          </ul>
                        </div>
                        <p class="text">Simple, effective, and incredibly powerful. My site’s speed doubled, and my
                          bounce rate dropped. Thank you for this amazing tool!</p>
                        <div class="author">
                          <div class="avatar"><img src="{{ asset('sassly/imgs/client/img-s-7.webp') }}" alt="image"></div>
                          <div class="">
                            <h2 class="name">Charry Maron</h2>
                            <span class="meta-title">Developer</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="testimonial-box">
                        <div class="ratings-list">
                          <ul>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                          </ul>
                        </div>
                        <p class="text">Optimizing images never felt this easy. My website’s performance skyrocketed,
                          and my Google rankings followed suit. I couldn’t be happier!</p>
                        <div class="author">
                          <div class="avatar"><img src="{{ asset('sassly/imgs/client/img-s-8.webp') }}" alt="image"></div>
                          <div class="">
                            <h2 class="name">Charry Maron</h2>
                            <span class="meta-title">Developer</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="testimonial-box">
                        <div class="ratings-list">
                          <ul>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                            <li><img src="{{ asset('sassly/imgs/icon/rating-star.webp') }}" alt="icon image"></li>
                          </ul>
                        </div>
                        <p class="text">I thought my site was fast until I optimized my images with this plugin. The
                          difference is astounding. It’s a game-changer for any website owner!</p>
                        <div class="author">
                          <div class="avatar"><img src="{{ asset('sassly/imgs/client/img-s-5.webp') }}" alt="image"></div>
                          <div class="">
                            <h2 class="name">Charry Maron</h2>
                            <span class="meta-title">Developer</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="pagination-wrapper d-none">
                    <div class="testimonial-pagination"></div>
                  </div>
                </div>

              </div>
            </div>
          </section>
          <!-- testimonial area end  -->

          <!-- rating area start  -->
          <section class="rating-area section-spacing">
            <div class="container">
              <div class="rating-area-inner">
                <div class="section-header">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h2 class="section-title has_fade_anim">Highly rated software
                        by customers</h2>
                    </div>
                  </div>
                  <div class="text-wrapper">
                    <p class="text has_fade_anim">Deliver happiness to your customers and get them to adore you! Desk helps you be
                      more accessible</p>
                  </div>
                </div>
                <div class="ratings-wrapper-box">
                  <div class="ratings-wrapper has_fade_anim">
                    <div class="rating-image">
                      <img src="{{ asset('sassly/imgs/gallery/img-s-30.webp') }}" alt="rating image">
                    </div>
                    <div class="rating-image">
                      <img src="{{ asset('sassly/imgs/gallery/img-s-31.webp') }}" alt="rating image">
                    </div>
                    <div class="rating-image">
                      <img src="{{ asset('sassly/imgs/gallery/img-s-32.webp') }}" alt="rating image">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- rating area end  -->

          <!-- faq area start  -->
          <section class="faq-area section-spacing pb-0">
            <div class="container">
              <div class="faq-area-inner">
                <div class="section-content">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h2 class="section-title has_fade_anim">Offer a superb
                        freedom</h2>
                    </div>
                  </div>
                  <div class="text-wrapper">
                    <p class="text has_fade_anim">Our simple tools help you manage inventory stock and watch your business thrive.</p>
                  </div>
                  <div class="accordion-wrapper has_fade_anim">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                      <div class="accordion-item">
                        <p class="accordion-header" id="flush-headingOne">
                          <button class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                            aria-controls="flush-collapseOne">Optimized posting times</button>
                        </p>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                          aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">Our AI-driven scheduler suggests the best posting times for your
                            audience, maximizing engagement and reach.</div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <p class="accordion-header" id="flush-headingTwo">
                          <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                            aria-expanded="false" aria-controls="flush-collapseTwo">Flexible pricing plan for chatting
                          </button>
                        </p>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse show"
                          aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">Our AI-driven scheduler suggests the best posting times for your
                            audience, maximizing engagement and reach.</div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <p class="accordion-header" id="flush-headingThree">
                          <button class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                            aria-controls="flush-collapseThree">Content calendar visibility</button>
                        </p>
                        <div id="flush-collapseThree" class="accordion-collapse collapse"
                          aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">Our AI-driven scheduler suggests the best posting times for your
                            audience, maximizing engagement and reach.</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="faq-thumb">
                  <img src="{{ asset('sassly/imgs/gallery/img-s-33.webp') }}" alt="gallery image">
                </div>
              </div>
            </div>
          </section>
          <!-- faq area end  -->

          <!-- pricing area start  -->
          <section class="pricing-area section-spacing">
            <div class="container">
              <div class="pricing-area-inner">
                <div class="shape-1">
                  <img src="{{ asset('sassly/imgs/shape/shape-s-30.webp') }}" data-speed="0.8" alt="shape image">
                </div>
                <div class="section-header">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h2 class="section-title has_fade_anim">Here's what you will save
                        per user, per month.</h2>
                    </div>
                  </div>
                  <div class="text-wrapper">
                    <p class="text has_fade_anim">Deliver happiness to your customers and get them to adore you! Desk helps you be
                      more accessible</p>
                  </div>
                </div>
                <div class="wcf__toggle_switcher style-1">
                  <div class="slide-toggle-wrapper has_fade_anim">
                    <div class="slide-toggle-btn">
                      <div class="shape-1">
                        <img src="{{ asset('sassly/imgs/shape/shape-s-17.webp') }}" alt="shape image">
                      </div>
                      <h3 class="offer-text">Save 20% with <br>
                        annual plans</h3>
                      <label for="view-1dfbbd6" class="before_label active">
                        Monthly </label>
                      <input type="checkbox" id="view-1dfbbd6">
                      <label for="view-1dfbbd6" class="switcher"></label>
                      <label for="view-1dfbbd6" class="after_label">
                        Yearly </label>
                    </div>
                  </div>

                  <div class="toggle-content">
                    <div class="toggle-pane show">
                      <div class="pricing-wrapper-box">
                        <div class="pricing-wrapper">
                          <div class="pricing-box basic has_fade_anim">
                            <h3 class="title">Basic</h3>
                            <p class="description">Ability to understand and generate content</p>
                            <h3 class="price">$09 <span>/month</span></h3>
                            <a href="contact.html" class="wc-btn wc-btn-primary btn-text-flip"> <span
                                data-text="Test 14 days for free">Test 14 days for free</span></a>
                            <div class="feature-list">
                              <ul>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Unlimited cards</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Automated management</li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">SOX
                                  compliance</li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}"
                                    alt="icon image">Enterprise
                                  ERP integrations
                                </li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Limited
                                  tools</li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Local
                                  video issuance</li>
                              </ul>
                            </div>
                          </div>
                          <div class="pricing-box standard has_fade_anim">
                            <h3 class="title">Standard</h3>
                            <p class="description">Additional user account and collaboration</p>
                            <h3 class="price">$29 <span>/month</span></h3>
                            <a href="contact.html" class="wc-btn wc-btn-primary btn-text-flip"> <span
                                data-text="Test 14 days for free">Test 14 days for free</span></a>
                            <div class="feature-list">
                              <ul>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Unlimited cards</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Automated management</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">SOX
                                  compliance</li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}"
                                    alt="icon image">Enterprise
                                  ERP integrations
                                </li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Limited
                                  tools</li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Local
                                  video issuance</li>
                              </ul>
                            </div>
                          </div>
                          <div class="pricing-box silver popular has_fade_anim">
                            <span class="tag">Popular</span>
                            <h3 class="title">Silver</h3>
                            <p class="description">Ability to understand and generate content</p>
                            <h3 class="price">$39 <span>/month</span></h3>
                            <a href="contact.html" class="wc-btn wc-btn-primary btn-text-flip"> <span
                                data-text="Test 14 days for free">Test 14 days for free</span></a>
                            <div class="feature-list">
                              <ul>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Unlimited cards</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Automated management</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">SOX
                                  compliance</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Enterprise
                                  ERP integrations
                                </li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Limited
                                  tools</li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Local
                                  video issuance</li>
                              </ul>
                            </div>
                          </div>
                          <div class="pricing-box premium has_fade_anim">
                            <h3 class="title">Premium</h3>
                            <p class="description">Ability to understand and generate content</p>
                            <h3 class="price">$49 <span>/month</span></h3>
                            <a href="contact.html" class="wc-btn wc-btn-primary btn-text-flip"> <span
                                data-text="Test 14 days for free">Test 14 days for free</span></a>
                            <div class="feature-list">
                              <ul>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Unlimited cards</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Automated management</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">SOX
                                  compliance</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Enterprise
                                  ERP integrations
                                </li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Limited
                                  tools</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Local
                                  video issuance</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="toggle-pane">
                      <div class="pricing-wrapper-box">
                        <div class="pricing-wrapper">
                          <div class="pricing-box basic">
                            <h3 class="title">Basic</h3>
                            <p class="description">Ability to understand and generate content</p>
                            <h3 class="price">$89 <span>/month</span></h3>
                            <a href="contact.html" class="wc-btn wc-btn-primary btn-text-flip"> <span
                                data-text="Test 14 days for free">Test 14 days for free</span></a>
                            <div class="feature-list">
                              <ul>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Unlimited cards</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Automated management</li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">SOX
                                  compliance</li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}"
                                    alt="icon image">Enterprise
                                  ERP integrations
                                </li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Limited
                                  tools</li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Local
                                  video issuance</li>
                              </ul>
                            </div>
                          </div>
                          <div class="pricing-box standard">
                            <h3 class="title">Standard</h3>
                            <p class="description">Additional user account and collaboration</p>
                            <h3 class="price">$189 <span>/month</span></h3>
                            <a href="contact.html" class="wc-btn wc-btn-primary btn-text-flip"> <span
                                data-text="Test 14 days for free">Test 14 days for free</span></a>
                            <div class="feature-list">
                              <ul>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Unlimited cards</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Automated management</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">SOX
                                  compliance</li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}"
                                    alt="icon image">Enterprise
                                  ERP integrations
                                </li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Limited
                                  tools</li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Local
                                  video issuance</li>
                              </ul>
                            </div>
                          </div>
                          <div class="pricing-box silver popular">
                            <span class="tag">Popular</span>
                            <h3 class="title">Silver</h3>
                            <p class="description">Ability to understand and generate content</p>
                            <h3 class="price">$589 <span>/month</span></h3>
                            <a href="contact.html" class="wc-btn wc-btn-primary btn-text-flip"> <span
                                data-text="Test 14 days for free">Test 14 days for free</span></a>
                            <div class="feature-list">
                              <ul>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Unlimited cards</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Automated management</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">SOX
                                  compliance</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Enterprise
                                  ERP integrations
                                </li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Limited
                                  tools</li>
                                <li class="disallow"><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Local
                                  video issuance</li>
                              </ul>
                            </div>
                          </div>
                          <div class="pricing-box premium">
                            <h3 class="title">Premium</h3>
                            <p class="description">Ability to understand and generate content</p>
                            <h3 class="price">$889 <span>/month</span></h3>
                            <a href="contact.html" class="wc-btn wc-btn-primary btn-text-flip"> <span
                                data-text="Test 14 days for free">Test 14 days for free</span></a>
                            <div class="feature-list">
                              <ul>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Unlimited cards</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Automated management</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">SOX
                                  compliance</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Enterprise
                                  ERP integrations
                                </li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Limited
                                  tools</li>
                                <li><img src="{{ asset('sassly/imgs/icon/check-3.webp') }}" alt="icon image">Local
                                  video issuance</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- pricing area end  -->

          <!-- integration area start  -->
          <section class="integration-area section-spacing">
            <div class="container">
              <div class="integration-area-inner">
                <div class="shape-1">
                  <img src="{{ asset('sassly/imgs/shape/shape-s-31.webp') }}" alt="shape image">
                </div>
                <div class="section-header">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h2 class="section-title has_fade_anim">Works on your
                        favorite platforms</h2>
                    </div>
                  </div>
                  <div class="text-wrapper">
                    <p class="text has_fade_anim">Deliver happiness to your customers and get them to adore you! Desk helps you be
                      more accessible</p>
                  </div>
                </div>
                <div class="logos-wrapper-box">
                  <div class="logos-wrapper has_fade_anim">
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-1.webp') }}" alt="app icon">
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-2.webp') }}" alt="app icon">
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-3.webp') }}" alt="app icon">
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-4.webp') }}" alt="app icon">
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-5.webp') }}" alt="app icon">
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-6.webp') }}" alt="app icon">
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-7.webp') }}" alt="app icon">
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-8.webp') }}" alt="app icon">
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-9.webp') }}" alt="app icon">
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-10.webp') }}" alt="app icon">
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-11.webp') }}" alt="app icon">
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-12.webp') }}" alt="app icon">
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-13.webp') }}" alt="app icon">
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('sassly/imgs/icon/icon-app-14.webp') }}" alt="app icon">
                    </div>
                  </div>
                </div>
                <div class="btn-wrapper has_fade_anim">
                  <a href="integration.html" class="wc-btn wc-btn-underline btn-text-flip"> <span
                      data-text="View all integration">View all integration</span></a>
                </div>
              </div>
            </div>
          </section>
          <!-- integration area end  -->

          <!-- blog area start  -->
          <section class="blog-area section-spacing">
            <div class="container">
              <div class="blog-area-inner">
                <div class="section-header">
                  <div class="section-title-wrapper">
                    <div class="title-wrapper">
                      <h2 class="section-title has_fade_anim">Journal from
                        Sassly</h2>
                    </div>
                  </div>
                  <div class="btn-wrapper has_fade_anim">
                    <a href="blog.html" class="wc-btn wc-btn-primary btn-text-flip"> <span
                        data-text="Browse all posts">Browse all posts</span></a>
                  </div>
                </div>
                <div class="blog-wrapper-box">
                  <div class="blog-wrapper">
                    <article class="blog has_fade_anim">
                      <div class="thumb">
                        <a href="blog-details.html"><img src="{{ asset('sassly/imgs/blog/img-s-1.webp') }}" alt="blog image"></a>
                      </div>
                      <div class="content">
                        <div class="meta">
                          <span class="date">28 July 2023</span>
                        </div>
                        <h3 class="title"><a href="blog-details.html">5 tipes for generate customer reports quickly</a>
                        </h3>
                        <div class="btn-wrapper">
                          <a href="blog-details.html" class="wc-btn wc-btn-underline btn-text-flip"> <span
                              data-text="Learn more">Learn more</span></a>
                        </div>
                      </div>
                    </article>
                    <article class="blog has_fade_anim" data-delay="0.25">
                      <div class="thumb">
                        <a href="blog-details.html"><img src="{{ asset('sassly/imgs/blog/img-s-2.webp') }}" alt="blog image"></a>
                      </div>
                      <div class="content">
                        <div class="meta">
                          <span class="date">14 March 2023</span>
                        </div>
                        <h3 class="title"><a href="blog-details.html">Crafting a brand identity for a digital
                            product</a>
                        </h3>
                        <div class="btn-wrapper">
                          <a href="blog-details.html" class="wc-btn wc-btn-underline btn-text-flip"> <span
                              data-text="Learn more">Learn more</span></a>
                        </div>
                      </div>
                    </article>
                    <article class="blog has_fade_anim" data-delay="0.35">
                      <div class="thumb">
                        <a href="blog-details.html"><img src="{{ asset('sassly/imgs/blog/img-s-3.webp') }}" alt="blog image"></a>
                      </div>
                      <div class="content">
                        <div class="meta">
                          <span class="date">12 January 2023</span>
                        </div>
                        <h3 class="title"><a href="blog-details.html">Maintaining a voice of superb customer support</a>
                        </h3>
                        <div class="btn-wrapper">
                          <a href="blog-details.html" class="wc-btn wc-btn-underline btn-text-flip"> <span
                              data-text="Learn more">Learn more</span></a>
                        </div>
                      </div>
                    </article>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- blog area end  -->


        </main>

        <!-- footer area start  -->
        <footer class="footer-area style-1">
          <div class="container">
            <div class="footer-area-inner">
              <div class="footer-widget-wrapper">
                <div class="footer-logo">
                  <img src="{{ asset('sassly/imgs/logo/logo-8.webp') }}" alt="site-logo">
                </div>
                <div class="description-text">
                  <div class="text-wrapper">
                    <p class="text">Sassly is a real early-stage software looking for an analytics platform that scales
                      with you, check out our stage program.</p>
                  </div>
                </div>
              </div>
              <div class="footer-widget-wrapper">
                <h2 class="title">Company</h2>
                <ul class="footer-nav-list">
                  <li><a href="#">About</a></li>
                  <li><a href="#">Careers</a></li>
                  <li><a href="#">Press</a></li>
                  <li><a href="#">Contact Us</a></li>
                  <li><a href="#">System Status</a></li>
                </ul>
              </div>
              <div class="footer-widget-wrapper">
                <h2 class="title">Useful Link</h2>
                <ul class="footer-nav-list">
                  <li><a href="#">Features</a></li>
                  <li><a href="#">Resources</a></li>
                  <li><a href="#">Service</a></li>
                  <li><a href="#">Team</a></li>
                  <li><a href="#">Collection</a></li>
                </ul>
              </div>
              <div class="footer-widget-wrapper">
                <h2 class="title">Product</h2>
                <ul class="footer-nav-list">
                  <li><a href="#">Live Chat</a></li>
                  <li><a href="#">Jirogram</a></li>
                  <li><a href="#">Datasetico</a></li>
                  <li><a href="#">Underline</a></li>
                  <li><a href="#">Keyword</a></li>
                </ul>
              </div>
            </div>
            <div class="copyright-area-inner">
              <ul class="social-links">
                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
              </ul>
              <div class="copyright-text">
                <p class="text">© 2022 <a href="https://crowdyflow.com/">Crowdyflow</a> Agency</p>
              </div>
            </div>
          </div>
        </footer>
        <!-- footer area end  -->

      </div>
    </div>
  </div>
  <!-- login form  -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="form-box-wrapper">
          <div class="login-form-box">
            <div class="btn-wrapper">
              <button class="close-btn" data-bs-dismiss="modal"><img src="{{ asset('sassly/imgs/icon/cross.webp') }}"
                  alt="icon image"></button>
            </div>
            <div class="title-wrapper">
              <h2 class="title"><span>Welcome <br>
                  Back to</span> Sassly </h2>
            </div>
            <div class="icon">
              <img src="{{ asset('sassly/imgs/shape/shape-s-55.webp') }}" alt="shape image">
            </div>
            <div class="form-wrapper">
              <form action="#" class="user-form">
                <div class="input-field">
                  <input type="email" placeholder="Enter your email">
                </div>
                <div class="input-field">
                  <input type="password" placeholder="Enter password">
                </div>
                <div class="policy-field">
                  <input type="checkbox" id="p-policy" name="p-policy" value="Boat">
                  <label for="policy">Remember me</label>
                  <a href="#" class="forget-password">Forgot your password?</a>
                </div>
                <button type="submit" class="subscribe-btn wc-btn-primary btn-text-flip"><span
                    data-text="Login">Login</span></button>
              </form>
            </div>
            <div class="note">
              <p>Don’t have an account? <span><a href="javascript:void(0)" data-bs-dismiss="modal"
                    data-bs-toggle="modal" data-bs-target="#signupform">Create Here!</a></span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- signup form  -->
  <div class="modal fade" id="signupform" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="form-box-wrapper">
          <div class="register-form-box">
            <div class="btn-wrapper">
              <button class="close-btn" data-bs-dismiss="modal"><img src="{{ asset('sassly/imgs/icon/cross.webp') }}"
                  alt="icon image"></button>
            </div>
            <div class="title-wrapper">
              <h2 class="title"><span>Start Your <br>
                  Journey</span> with us.</h2>
            </div>
            <div class="icon">
              <img src="{{ asset('sassly/imgs/shape/shape-s-55.webp') }}" alt="shape image">
            </div>
            <div class="form-wrapper">
              <form action="#" class="user-form">
                <div class="input-field">
                  <input type="text" placeholder="Type your name">
                </div>
                <div class="input-field">
                  <input type="text" placeholder="User name">
                </div>
                <div class="input-field">
                  <input type="email" placeholder="Type Email">
                </div>
                <div class="input-field">
                  <input type="password" placeholder="Type Password">
                </div>
                <div class="input-field">
                  <input type="password" placeholder="Confirm Password">
                </div>
                <div class="policy-field">
                  <input type="checkbox" id="d-policy" name="d-policy" value="Boat">
                  <label for="d-policy">I agree to sassly <span><a href="#">Terms of Service.</a></span></label>
                </div>
                <button type="submit" class="subscribe-btn wc-btn-primary btn-text-flip"><span
                    data-text="Register">Register</span></button>
              </form>
            </div>
            <div class="note">
              <p>Already have an account? <span><a href="javascript:void(0)" data-bs-dismiss="modal"
                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">Login Here!</a></span></p>
            </div>
            <h3 class="alternative-title"><span>OR</span></h3>
            <ul class="social-links">
              <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- All JS files -->
  <script src="{{ asset('sassly/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('sassly/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('sassly/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('sassly/js/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('sassly/js/counter.js') }}"></script>
  <script src="{{ asset('sassly/js/gsap.min.js') }}"></script>
  <script src="{{ asset('sassly/js/ScrollSmoother.min.js') }}"></script>
  <script src="{{ asset('sassly/js/ScrollToPlugin.min.js') }}"></script>
  <script src="{{ asset('sassly/js/ScrollTrigger.min.js') }}"></script>
  <script src="{{ asset('sassly/js/jquery.meanmenu.min.js') }}"></script>
  <script src="{{ asset('sassly/js/backToTop.js') }}"></script>
  <script src="{{ asset('sassly/js/main.js') }}"></script>
  <script src="{{ asset('sassly/js/error-handling.js') }}"></script>
  <script src="{{ asset('sassly/js/offcanvas.js') }}"></script>

  <script>

    // testimonial slider
    if (('.testimonial-slider').length) {
      var testimonial_slider = new Swiper(".testimonial-slider", {
        loop: false,
        slidesPerView: 1,
        spaceBetween: 30,
        speed: 1800,
        freeMode: true,
        watchSlidesProgress: true,
        navigation: {
          prevEl: ".testimonial-button-prev",
          nextEl: ".testimonial-button-next",
        },
        pagination: {
          el: '.testimonial-pagination',
          type: 'bullets',
        },
        breakpoints: {
          // when window width is >= px
          576: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 2,
          },
          1201: {
            slidesPerView: 3,
          },
          1367: {
            slidesPerView: 4.4,
          },
        }
      });
    }

    // brand_slider_active
    if ('.brand-active') {
      var brand_slider_active = new Swiper(".brand-active", {
        slidesPerView: 5,
        loop: true,
        autoplay: true,
        spaceBetween: 60,
        speed: 3000,
        autoplay: {
          delay: .1,
          disableOnInteraction: false,
        },
        breakpoints: {
          // when window width is >= 320px
          375: {
            slidesPerView: 2,
            spaceBetween: 0,
          },
          // when window width is >= 480px
          480: {
            slidesPerView: 3,
            spaceBetween: 30,
          },
          // when window width is >= 640px
          640: {
            slidesPerView: 4,
            spaceBetween: 40
          },
          // when window width is >= 1366px
          1366: {
            slidesPerView: 5,
          },
        }
      });
    }

    const toggle_switcher = function ($scope) {
      const checked = $("input", $scope);
      const toggle_pane = $(".toggle-pane", $scope);
      const toggle_label = $(".before_label, .after_label", $scope);

      checked.change(function () {
        toggle_pane.toggleClass('show');
        toggle_label.toggleClass('active');
      })
    }


    // Get references to the button and the element to remove
    const button = document.getElementById('removeButton');
    const elementToRemove = document.getElementById('elementToRemove');

    // Add event listener to the button
    button.addEventListener('click', function () {
      // Remove the element from the DOM
      elementToRemove.remove();
    });
  </script>



</body>

</html>