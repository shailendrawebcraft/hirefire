<!DOCTYPE html>
<!--
**********************************************************************************************************
    Copyright (c) 2022.
**********************************************************************************************************  -->
<!--
  Template Name: emart - Laravel Multi-Vendor Ecommerce Advanced CMS
  Version: 3.6.0
  Author: Media City
-->


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(selected_lang()->rtl_available == 1) dir="rtl" @endif>

<head>
  
  @if(env('GOOGLE_TAG_MANAGER_ID') != '' && env('GOOGLE_TAG_MANAGER_ENABLED') == true)
    @include('googletagmanager::head')
  @endif

  @if(env('FACEBOOK_PIXEL_ID') != '')
  @include('facebook-pixel::head')
  @endif

  <style>
    :root {
      --background_blue_bg_color: #108BEA;
      --background_dark_blue_bg_color: #157ed2;
      --background_light_blue_bg_color: #0f6cb2;
      --background_black_bg_color: #2E353B;
      --background_white_bg_color: #FFF;
      --background_grey_bg_color: #e9e9de;
      --background_yellow_bg_color: #fdd922;
      --background_green_bg_color: #157ed2;
      --background_pink_bg_color: #ff7878;
      --text_white_color: #FFF;
      --text_black_color: #333;
      --text_light_black_color: #666;
      --text_blue_color: #157ed2;
      --text_yellow_color: #FDD922;
      --text_grey_color: #9a9a9a;
      --text_dark_grey_color: #abafb1;
      --text_dark_blue_color: #147ED2;
      --text_green_color: #12CCA7;
      --text_pink_color: #000;
    }

    img.lazy :not(hover-image) {
      background-image: url('//via.placeholder.com/200x200.png?text=loading');
      background-repeat: no-repeat;
      background-position: 50% 50%;
    }
  </style>

  <!-- jQuery 3.5.4 -->
  <script src="{{url('js/jquery.min.js')}}"></script>



  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all">
  @yield('meta_tags')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="fallback_locale" content="{{ config('app.fallback_locale') }}">
  <!-- Theme Header Color -->
  <meta name="theme-color" content="#157ED2">
  <title>@yield('title') {{ $title }} </title>
  <!-- END Fonts -->
  @if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' && env('PWA_ENABLE') == 1)
  @laravelPWA
  @endif
  <!-- Favicon -->
  <link rel="icon" href="{{url('images/genral/'.$fevicon)}}" type="image/png" sizes="16x16">
  <link rel="stylesheet" href="{{ url('/admin_new/assets/scss/_custom-chat.scss?v=123') }}">
  <link rel="stylesheet" href="{{ url('css/theme.css') }}">

  <link type="text/css" rel="stylesheet" href="{{ url('css/app.css') }}">
  
  <link rel="stylesheet" href="{{ url("css/front.css") }}">
  <!-- Pattern End -->
  @if(selected_lang()->rtl_available == 1)
  <!-- RTL -->
  <link rel="stylesheet" href="{{ url('css/rtl.css') }}">
  <link rel="stylesheet" href="{{ url('css/navbar-rtl.css') }}">
  <!-- END -->
  @endif

  <!-- Patterns -->
  @include('front.layout.patterns.pattern1')
  @include('front.layout.patterns.pattern2')
  @include('front.layout.patterns.pattern3')
  @include('front.layout.patterns.pattern4')
  @include('front.layout.patterns.pattern5')

  <!-- Custom Css -->
  @if(file_exists(public_path().'/css/stylesheet.css'))
  <link rel="stylesheet" type="text/css" href="{{url('css/stylesheet.css')}}">
  @endif
  <link rel="stylesheet" type="text/css" href="{{url('css/stylesheet1.css')}}">

  <script async src="//www.googletagmanager.com/gtag/js?id={{ $seoset->google_analysis }}"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', '{{ $seoset->google_analysis }}');
  </script>

  <!-- Laravel notify css -->
  @notify_css

  <!-- Custom script head -->
  @yield('head-script')
  <!-- Custom style head -->
  @yield('stylesheet')
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
</head>


<body class="cnt-home">

  @include('sweet::alert')


  <!-- preloader -->
  <div class="display-none payment-verify-preloader">
    <div class="payment">
      <div class="payment-message">
        <i class="fa fa-spinner fa-pulse fa-fw"></i> <span class="sr-only">{{ __('Loading') }}...</span>
        {{ __('staticwords.verifyPayment') }}
        <br>
        <div class="jsonstatus">

        </div>
      </div>
    </div>
  </div>


  @if(env("ENABLE_PRELOADER") == 1)
  <!-- preloader -->
  <div class="front-preloader">
    <div class="status">
      <div class="status-message">
        <img height="100px" src="{{url('images/preloader/preloader.png')}}" alt="preloader">
      </div>
    </div>
  </div>
  @endif
  <!-- form submit preloader -->
  <div class="display-none preL">
    <div class="display-none preloader3"></div>
  </div>

  <div class="d-none">
  <!-- ============================================== HEADER ============================================== -->
    <span id="app"></span>
    <span id="search-area"></span>
    <span id="search-xs"></span>
    <span id="search-sm"></span>
    <span id="menubar"></span>
    <span id="mobilesidebar"></span>
    <span id="mobilemenubar"></span>
    <span id="cart-total-d"></span>
    <span id="notifications"></span>
    <span id="mobilewishlist"></span>
    <span id="desktop-wis-count"></span>
    <span id="comparedesktop"></span>
    <span id="comparemobile"></span>
  </div>

    <!-- top section -->
    <div class="top-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="top-left-text">
                        Emergency towing services when you need them most
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <ul>
                      @foreach($socials as $social)
                        @php
                          $socialicon = '';
                          switch($social->icon) {
                            case 'fb':
                              $socialicon = "fa fa-facebook-official";
                              break;
                            case 'instagram':
                              $socialicon = "fa fa-instagram";
                              break;
                            case 'linkedin':
                              $socialicon = "fa fa-linkedin-square";
                              break;
                            default:
                              $socialicon = "fa fa-facebook-official";
                          }
                        @endphp
                        <li>
                          <a target="_blank" rel="nofollow" href="{{$social->url}}"><i class="{{ $socialicon }}" aria-hidden="true"></i></a>
                        </li>
                      @endforeach
                        <!-- <li>
                            <a href="https://www.facebook.com/profile.php?id=100085467462410" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        </li>

                        <li>
                            <a href="https://www.instagram.com/jasper_realtors/?igshid=NmNmNjAwNzg%3D" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/company/jasper-real-estate/" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Linkedin"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="sticky">
        <div class="container mt-2 mb-2">
            <div class="row">
                <div class="col-xl-3 col-md-2 col-sm-4 col-4">
                    <div class="mt-1">
                        <a href="{{ url('/') }}">
                            <img class="logo-img" src="{{url('images/genral/'.$front_logo)}}" alt="min_logo">
                        </a>
                    </div>
                </div>
                <div class="col-xl-9 col-md-10 col-sm-8 col-8">
                    <div class="d-flex align-items-center justify-content-end">
                       
                        <div class="header-contact-info">
                            <a href="tel:{{$genrals_settings->mobile}}" tiltle="Call Us Now">
                            <div class="info-icon-box">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </div>
                            <div class="info-icon-text d-lg-block d-md-block d-none">
                            <p class="mb-0"><small>Call Us Now</small></p>
                            <h6>{{$genrals_settings->mobile}} </h6>
                            </div>
                            </a>
                        </div>
                        <div class="header-contact-info">
                            <a href="mailto:{{$genrals_settings->email}}" tiltle="E-Mail">
                                <div class="info-icon-box">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                                <div class="info-icon-text  d-lg-block d-md-block d-none">
                                <p class="mb-0"><small>Email Us Now</small></p>
                                <h6>{{$genrals_settings->email}}</h6>
                                </div>
                            </a>
                        </div>
                        <button class="navbar-toggler drawer-hamburger d-block d-lg-none " type="button" data-toggle="collapse" data-target="#navmobileopen" aria-controls="navmobileopen" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="drawer-hamburger-icon"></span>
                            <!-- <i class="fa fa-align-justify" aria-hidden="true"></i> -->
                            <span class="sr-only">toggle navigation</span>
                        </button>
                    </div>
                </div>
            </div>
           
        </div>
        <div class="nav-outer">
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="nav-overlay" data-toggle="collapse" data-target="#navmobileopen" aria-controls="navmobileopen" aria-expanded="false" aria-label="Toggle navigation" role="menubar"></div>
                        <div class="collapse navbar-collapse" id="navmobileopen">
                            <ul class="navbar-nav mr-auto" id="nav">
                                <li class="nav-item current">
                                    <a class="nav-link " href="index.html">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#">Hire a Recovery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ url('/ecommerce') }}">Rent Equipments</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#">Consultancy Services</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        </div>
    </header>

    <!-- slider -->
    <section class="banner-sec wow fadeIn">
        <div class="owl-carousel owl-theme" id="owl-carousel8">
            <div class="item">
                <img src="images/banner1.jpg" class="img-fluid" alt="Hire and Fyre">
            </div>
            <div class="item">
                <img src="images/banner2.jpg" class="img-fluid" alt="Hire and Fyre">
            </div>
        </div>
        <div class="banner-caption">
            <h1>Emergency Road Side Assistance 
                <br> We Help You Recover!</h1>
            <a href="about-us.html" class="btn btn-primary btn-login btn-effect-1">KNOW MORE <i class="fa fa-arrow-circle-o-right"
                    aria-hidden="true"></i></a>
        </div>
    </section>
    <!-- why section -->
    <section class="why-outer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center wow fadeInUp">
                    <h6 class="">Our Services</h6>
                    <h1 class="mb-4 text-brand-dark" >What We Provide</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">
                    <div class="service-outer">
                        <div class="ser-img-outer">
                            <img src="images/service3.jpg" alt="HNF" class="w-100">
                            <div class="ser-overlay"></div>
                        </div>
                        <div class="service-text">
                            <a href="#">
                            Hire a Recovery Truck
                            <span>
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.5 29.0625C19.097 29.0625 22.5467 27.6336 25.0901 25.0901C27.6336 22.5467 29.0625 19.097 29.0625 15.5C29.0625 11.903 27.6336 8.45333 25.0901 5.90986C22.5467 3.3664 19.097 1.9375 15.5 1.9375C11.903 1.9375 8.45333 3.3664 5.90986 5.90986C3.3664 8.45333 1.9375 11.903 1.9375 15.5C1.9375 19.097 3.3664 22.5467 5.90986 25.0901C8.45333 27.6336 11.903 29.0625 15.5 29.0625ZM15.5 0C19.6109 0 23.5533 1.63303 26.4602 4.53984C29.367 7.44666 31 11.3891 31 15.5C31 19.6109 29.367 23.5533 26.4602 26.4602C23.5533 29.367 19.6109 31 15.5 31C11.3891 31 7.44666 29.367 4.53984 26.4602C1.63303 23.5533 0 19.6109 0 15.5C0 11.3891 1.63303 7.44666 4.53984 4.53984C7.44666 1.63303 11.3891 0 15.5 0ZM8.71875 14.5312C8.46182 14.5312 8.21542 14.6333 8.03374 14.815C7.85206 14.9967 7.75 15.2431 7.75 15.5C7.75 15.7569 7.85206 16.0033 8.03374 16.185C8.21542 16.3667 8.46182 16.4688 8.71875 16.4688H19.9427L15.7829 20.6266C15.601 20.8085 15.4988 21.0552 15.4988 21.3125C15.4988 21.5698 15.601 21.8165 15.7829 21.9984C15.9648 22.1803 16.2115 22.2825 16.4688 22.2825C16.726 22.2825 16.9727 22.1803 17.1546 21.9984L22.9671 16.1859C23.0573 16.0959 23.1289 15.989 23.1778 15.8713C23.2266 15.7536 23.2517 15.6274 23.2517 15.5C23.2517 15.3726 23.2266 15.2464 23.1778 15.1287C23.1289 15.011 23.0573 14.9041 22.9671 14.8141L17.1546 9.00163C16.9727 8.81972 16.726 8.71753 16.4688 8.71753C16.2115 8.71753 15.9648 8.81972 15.7829 9.00163C15.601 9.18353 15.4988 9.43025 15.4988 9.6875C15.4988 9.94475 15.601 10.1915 15.7829 10.3734L19.9427 14.5312H8.71875Z" fill=""/>
                                </svg>
                            </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                    <div class="service-outer">
                        <div class="ser-img-outer">
                            <img src="images/service2.jpg" alt="HNF" class="w-100">
                            <div class="ser-overlay"></div>
                        </div>
                        <div class="service-text">
                            <a href="{{ url('/ecommerce') }}">
                                Hire an Equipment
                            <span>
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.5 29.0625C19.097 29.0625 22.5467 27.6336 25.0901 25.0901C27.6336 22.5467 29.0625 19.097 29.0625 15.5C29.0625 11.903 27.6336 8.45333 25.0901 5.90986C22.5467 3.3664 19.097 1.9375 15.5 1.9375C11.903 1.9375 8.45333 3.3664 5.90986 5.90986C3.3664 8.45333 1.9375 11.903 1.9375 15.5C1.9375 19.097 3.3664 22.5467 5.90986 25.0901C8.45333 27.6336 11.903 29.0625 15.5 29.0625ZM15.5 0C19.6109 0 23.5533 1.63303 26.4602 4.53984C29.367 7.44666 31 11.3891 31 15.5C31 19.6109 29.367 23.5533 26.4602 26.4602C23.5533 29.367 19.6109 31 15.5 31C11.3891 31 7.44666 29.367 4.53984 26.4602C1.63303 23.5533 0 19.6109 0 15.5C0 11.3891 1.63303 7.44666 4.53984 4.53984C7.44666 1.63303 11.3891 0 15.5 0ZM8.71875 14.5312C8.46182 14.5312 8.21542 14.6333 8.03374 14.815C7.85206 14.9967 7.75 15.2431 7.75 15.5C7.75 15.7569 7.85206 16.0033 8.03374 16.185C8.21542 16.3667 8.46182 16.4688 8.71875 16.4688H19.9427L15.7829 20.6266C15.601 20.8085 15.4988 21.0552 15.4988 21.3125C15.4988 21.5698 15.601 21.8165 15.7829 21.9984C15.9648 22.1803 16.2115 22.2825 16.4688 22.2825C16.726 22.2825 16.9727 22.1803 17.1546 21.9984L22.9671 16.1859C23.0573 16.0959 23.1289 15.989 23.1778 15.8713C23.2266 15.7536 23.2517 15.6274 23.2517 15.5C23.2517 15.3726 23.2266 15.2464 23.1778 15.1287C23.1289 15.011 23.0573 14.9041 22.9671 14.8141L17.1546 9.00163C16.9727 8.81972 16.726 8.71753 16.4688 8.71753C16.2115 8.71753 15.9648 8.81972 15.7829 9.00163C15.601 9.18353 15.4988 9.43025 15.4988 9.6875C15.4988 9.94475 15.601 10.1915 15.7829 10.3734L19.9427 14.5312H8.71875Z" fill=""/>
                                </svg>
                            </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                    <div class="service-outer">
                        <div class="ser-img-outer">
                            <img src="images/service1.jpg" alt="HNF" class="w-100">
                            <div class="ser-overlay"></div>
                        </div>
                        <div class="service-text">
                            <a href="#">
                                Hire a Service
                            <span>
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.5 29.0625C19.097 29.0625 22.5467 27.6336 25.0901 25.0901C27.6336 22.5467 29.0625 19.097 29.0625 15.5C29.0625 11.903 27.6336 8.45333 25.0901 5.90986C22.5467 3.3664 19.097 1.9375 15.5 1.9375C11.903 1.9375 8.45333 3.3664 5.90986 5.90986C3.3664 8.45333 1.9375 11.903 1.9375 15.5C1.9375 19.097 3.3664 22.5467 5.90986 25.0901C8.45333 27.6336 11.903 29.0625 15.5 29.0625ZM15.5 0C19.6109 0 23.5533 1.63303 26.4602 4.53984C29.367 7.44666 31 11.3891 31 15.5C31 19.6109 29.367 23.5533 26.4602 26.4602C23.5533 29.367 19.6109 31 15.5 31C11.3891 31 7.44666 29.367 4.53984 26.4602C1.63303 23.5533 0 19.6109 0 15.5C0 11.3891 1.63303 7.44666 4.53984 4.53984C7.44666 1.63303 11.3891 0 15.5 0ZM8.71875 14.5312C8.46182 14.5312 8.21542 14.6333 8.03374 14.815C7.85206 14.9967 7.75 15.2431 7.75 15.5C7.75 15.7569 7.85206 16.0033 8.03374 16.185C8.21542 16.3667 8.46182 16.4688 8.71875 16.4688H19.9427L15.7829 20.6266C15.601 20.8085 15.4988 21.0552 15.4988 21.3125C15.4988 21.5698 15.601 21.8165 15.7829 21.9984C15.9648 22.1803 16.2115 22.2825 16.4688 22.2825C16.726 22.2825 16.9727 22.1803 17.1546 21.9984L22.9671 16.1859C23.0573 16.0959 23.1289 15.989 23.1778 15.8713C23.2266 15.7536 23.2517 15.6274 23.2517 15.5C23.2517 15.3726 23.2266 15.2464 23.1778 15.1287C23.1289 15.011 23.0573 14.9041 22.9671 14.8141L17.1546 9.00163C16.9727 8.81972 16.726 8.71753 16.4688 8.71753C16.2115 8.71753 15.9648 8.81972 15.7829 9.00163C15.601 9.18353 15.4988 9.43025 15.4988 9.6875C15.4988 9.94475 15.601 10.1915 15.7829 10.3734L19.9427 14.5312H8.71875Z" fill=""/>
                                </svg>
                            </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container ">
        <div class="about-text">
        <div class="row">
            <div class="col-md-5 wow fadeInLeft">
                <img src="images/about-img.jpg" class="w-100" alt="HNF">
            </div>
            <div class="col-md-5 offset-md-2 wow fadeInRight">
                <h6>About Us</h6>
                <h2 class="text-brand-dark">What We Have For You</h2>
                <h5>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.
                </h5>
            </div>
        </div>
        </div>
    </div>
    <!-- counter-section -->
    <section class="counter-sec">
        <div class="container" id="counter">
            <div class="row">
                <div class="col-md-3">
                    <div class="counder-box wow fadeInLeft">
                        <span class="count-num counter-value plus" data-count="5256">
                            0
                        </span>
                        <h6>Happy Customer </h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counder-box wow fadeInLeft">
                        <span class="count-num counter-value parcent" data-count="98">
                           0
                        </span>
                        <h6>Customer Satisfaction </h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counder-box wow fadeInLeft">
                        <span class="count-num counter-value parcent" data-count="100">
                            0
                        </span>
                        <h6>Best Services </h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counder-box wow fadeInLeft">
                        <span class="count-num counter-value parcent" data-count="100">
                           0
                        </span>
                        <h6>Professional Partners</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <!-- testimonial section -->
      <section class="testimonial-sec wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4  col-sm-12">
                   <div class="tt-text-outer">
                    <h6>Testimonial</h6>
                    <h2 class="text-brand-dark">What Our Clients Say  </h2>
                   </div>
                </div>
                <div class="col-lg-9 col-md-8  col-sm-12">
                    <div class="owl-carousel owl-theme" id="owl-carousel4">
                        <div class="item">
                            <div class="testimonial-outer">
                                <div class="t-text">
                                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore gna a. Ut enim ad minim veniam, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore gna a. </p>

                                </div>
                                <div class="testi-info">
                                    <div class="d-flex align-items-center">
                                        <div class="t-avatar">
                                            <img src="images/avtar.jpg" class="img-fluid" alt="Jasper Real Estate">
                                        </div>
                                        <h5><em>Lisa Smith<br><small >UAE</small></em>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial-outer">
                                <div class="t-text">
                                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore gna a. Ut enim ad minim veniam, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore gna a. </p>

                                </div>
                                <div class="testi-info">
                                    <div class="d-flex align-items-center">
                                        <div class="t-avatar">
                                            <img src="images/avtar.jpg" class="img-fluid" alt="Jasper Real Estate">
                                        </div>
                                        <h5><em>Lisa Smith<br><small >UAE</small></em>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial-outer">
                                <div class="t-text">
                                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore gna a. Ut enim ad minim veniam, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore gna a. </p>
                                </div>
                                <div class="testi-info">
                                    <div class="d-flex align-items-center">
                                        <div class="t-avatar">
                                            <img src="images/avtar.jpg" class="img-fluid" alt="Jasper Real Estate">
                                        </div>
                                        <h5><em>Lisa Smith<br><small >UAE</small></em>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
  <!-- ==================== FOOTER ======================== -->
  @if(!empty($footer3_widget ))
  <div class="row our-features-box">
    <div class="container">
      <ul>
        <li>
          <div class="feature-box">
            @if(isset($footer3_widget->icon_section1))<i
              class="footericon fa {{ $footer3_widget->icon_section1 }}"></i>@endif
            <p></p>
            <div class="content-blocks">{{ $footer3_widget->shiping }}</div>
          </div>
        </li>
        <li>
          <div class="feature-box">
            @if(isset($footer3_widget->icon_section2))<i
              class="footericon fa {{ $footer3_widget->icon_section2 }}"></i>@endif
            <p></p>
            <div class="content-blocks">
              {{ $footer3_widget->mobile }} </div>
          </div>
        </li>
        <li>
          <div class="feature-box">
            @if(isset($footer3_widget->icon_section3))<i
              class="footericon fa {{ $footer3_widget->icon_section3 }}"></i>@endif
            <p></p>
            <div class="content-blocks">{{ $footer3_widget->return }}</div>
          </div>
        </li>
        <li>
          <div class="feature-box">
            @if(isset($footer3_widget->icon_section4))<i
              class="footericon fa {{ $footer3_widget->icon_section4 }}"></i>@endif
            <p></p>
            <div class="content">{{ $footer3_widget->money }}</div>
          </div>
        </li>

      </ul>
    </div>
  </div>
  @endif

  @if(count($brands) > 0)
  <div id="brands-carousel" class="logo-slider logo-slider-one">
    <div class="logo-slider-inner">

      <div id="brand-slider"
        class="owl-carousel home-owl-carousel custom-carousel brand-slider {{ isset($selected_language) && $selected_language->rtl_available == 1 ? 'owl-rtl' : ''}}">
        @foreach($brands as $datas)
        <div class="item m-t-15">
          <a href="#" class="image">
            @if(file_exists(public_path().'/images/brands/'.$datas->image) && $datas->image != '')
            <img class="owl-lazy" title="{{ $datas->name }}" width="100px" height="110px"
              data-src="{{url('images/brands/'.$datas->image)}}" alt="{{ $datas->name }}">
            @else
            <img class="owl-lazy" title="{{ $datas->name }}" width="100px" height="110px"
              data-src="{{ Avatar::create($datas->name)->toBase64() }}" alt="{{ $datas->name }}">
            @endif
          </a>
        </div>
        @endforeach

      </div>
      <!-- /.owl-carousel #logo-slider -->
    </div>
    <!-- /.logo-slider-inner -->
  </div>
  @endif

  <div>
    @php
    $enable_newsletter_widget = App\Widgetsetting::where('name','newsletter')->first();
    @endphp

    @if($enable_newsletter_widget->home == '1' && isset($enable_newsletter_widget) || $enable_newsletter_widget->shop ==
    "1")
    <div class="container newsletter-bg-custom">
      <div class="p-5">
        <div class="row">
          <div class="col-sm-12 col-md-7">
            <h2 class="text-white text-center">@lang("staticwords.newsletterheading")</h2>
            <h5 class="text-light text-center">@lang("staticwords.newsletterwords")</h5>
          </div>
  
          <div class="col-sm-12 col-md-5">
            <div class="form-group bg-white border rounded px-2 py-2 mb-2">
              <form method="post" action="{{url('newsletter')}}">
                @csrf
                <div class="row">
                  <div class="col">
                    <input required type="email" name="email"
                      class="form-control pl-3 shadow-none bg-transparent border-0"
                      placeholder="Enter your email address">
                  </div>
                  <div class="col-auto"> <button type="submit" class="text-white btn btn-block newsletter-bg-custom"><i
                        class="fa fa-paper-plane-o mr-2"></i>Subscribe</button> </div>
                </div>
              </form>
  
            </div>
          </div>
  
        </div>
      </div>
    </div>
    

    @endif


  </div>

  <!-- /.logo-slider-end -->
  <footer id="footer" class="footer color-bg">
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="address-block">
              @if(isset($genrals_settings))
              <div class="module-body">
                <ul class="toggle-footer">
                  @if(!empty($genrals_settings->address))
                  <li class="media">
                    <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i
                          class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                    <div class="media-body">
                      <p>{{$genrals_settings->address}}</p>
                    </div>
                  </li>
                  @endif
                  @if(!empty($genrals_settings->mobile))
                  <li class="media">
                    <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i
                          class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                    <div class="media-body">
                      <a href="tel:{{$genrals_settings->mobile}}" tiltle="Mobile No.">{{$genrals_settings->mobile}}</a>
                    </div>
                  </li>
                  @endif
                  @if(!empty($genrals_settings->email))
                  <li class="media">
                    <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i
                          class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                    <div class="media-body"> <span><a href="mailto:{{$genrals_settings->email}}"
                          tiltle="E-Mail">{{$genrals_settings->email}}</a></span> </div>
                  </li>
                  @endif
                </ul>
              </div>
              @endif
            </div>
            <!-- /.module-body -->
          </div>
          <!-- /.col -->

          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading module-small-screen">
              <h4 class="module-title">{{ $footer3_widget->footer2 }}</h4>
            </div>
            <!-- /.module-heading -->

            <div class="module-body module-small-screen">
              <ul class='list-unstyled'>
                @if(Auth::check())

                <li class="first"><a href="{{url('profile')}}" title="My Account">{{ __('staticwords.MyAccount') }}</a>
                </li>
                <li><a href="{{url('order')}}" title="Order History">{{ __('staticwords.OrderHistory') }}</a></li>
                @endif
                <li><a href="{{url('faq')}}" title="Faq">{{ __('staticwords.faqs') }}</a></li>
                <li><a href="{{ route('contact.us') }}"
                    title="{{ __("staticwords.ContactUs") }}">{{ __('staticwords.ContactUs') }}</a>
                </li>
                @if(isset($genrals_settings) && $genrals_settings['vendor_enable'] == 1)
                @if(Auth::check())
                @if(Auth::user()->role_id != 'a' && !Auth::user()->store)
                <li class="last"><a href="{{ route('applyforseller') }}"
                    title="{{ __('staticwords.ApplyforSellerAccount') }}">{{ __('staticwords.ApplyforSellerAccount') }}</a>
                </li>
                @endif
                @else
                <li class="last"><a href="{{ route('applyforseller') }}"
                    title="{{ __('staticwords.ApplyforSellerAccount') }}">{{ __('staticwords.ApplyforSellerAccount') }}</a>
                </li>
                @endif
                @endif
                <li class="last"><a href="{{ route('hdesk') }}"
                    title="{{ __('staticwords.HelpCenter') }}">{{ __('staticwords.HelpCenter') }}</a>
                </li>
                <li class="last"><a href="{{ route('track.order') }}"
                    title="{{ __("staticwords.TrackOrder") }}">{{ __('staticwords.TrackOrder') }}</a>
                </li>
              </ul>
            </div>
            <!-- /.module-body -->
          </div>

          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading module-small-screen">
              <h4 class="module-title">{{ $footer3_widget->footer3 }}</h4>
            </div>

            @foreach($widget3items as $foo)
            <div class="module-body module-small-screen">
              <ul class='list-unstyled'>
                <li class="first">

                  @if($foo->link_by == 'page' && isset($foo->gotopage['slug']))
                  <a title="{{ $foo->title }}" href="{{ route('page.slug',$foo->gotopage['slug']) }}">
                    {{ $foo->title }}
                  </a>
                  @else
                  <a target="__blank" title="{{ $foo->title }}" href="{{ $foo->url }}">
                    {{ $foo->title }}
                  </a>
                  @endif

                </li>
              </ul>
            </div>
            @endforeach
            <!-- /.module-body -->
          </div>
          <!-- /.col -->

          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading module-small-screen">
              <h4 class="module-title">{{ $footer3_widget->footer4 }}</h4>
            </div>

            @foreach($widget4items as $foo)
            <div class="module-body module-small-screen">
              <ul class='list-unstyled'>
                <li class="first">

                  @if($foo->link_by == 'page' && isset($foo->gotopage['slug']))
                  <a title="{{ $foo->title }}" href="{{ route('page.slug',$foo->gotopage['slug']) }}">
                    {{ $foo->title }}
                  </a>
                  @else
                  <a target="__blank" title="{{ $foo->title }}" href="{{ $foo->url }}">
                    {{ $foo->title }}
                  </a>
                  @endif

                </li>
              </ul>
            </div>
            @endforeach

            <!-- /.module-body -->
          </div>

        </div>
      </div>
    </div>
    <div class="copyright-bar header-nav-screen">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-4 col-lg-4 no-padding social">
            <ul class="link">
              @foreach($socials as $social)
              <li class="{{$social->icon}} pull-left"><a target="_blank" rel="nofollow" href="{{$social->url}}"></a>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="col-xs-12 col-sm-4 col-lg-4 no-padding copyright">
            &copy; {{ date("Y") }} @if(isset($Copyright)) {{ $Copyright }}@endif
          </div>
          <div class="col-xs-12 col-sm-4 col-lg-4 no-padding">
            <div class="clearfix payment-methods">

              <div class="owl-carousel home-owl-carousel owl-theme  owl-loaded owl-drag">
                @if($Api_settings->paypal_enable=='1')
                <div class="payment-item">
                  <a title="Paypal" target="__blank" href="https://paypal.com"><img
                      data-src="{{ url('images/payment/paypal.png') }}" alt="Paypal" class="owl-lazy img-fluid"></a>
                </div>
                @endif


                @if($Api_settings->stripe_enable=='1')
                <div class="payment-item">
                  <a title="Stripe" target="__blank" href="https://stripe.com/"><img
                      data-src="{{ url('images/payment/stripe.png') }}" alt="Razorpay" class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->braintree_enable=='1')
                <div class="payment-item">
                  <a title="Braintree" target="__blank" href="https://www.braintreepayments.com/"><img
                      data-src="{{ url('images/payment/braintree.png') }}" alt="Braintree"
                      class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->paystack_enable =='1')
                <div class="payment-item">
                  <a title="Paystack" target="__blank" href="https://paystack.com/"><img
                      data-src="{{ url('images/payment/paystack.png') }}" alt="Paystack" class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->paytm_enable=='1')
                <div class="payment-item">
                  <a title="Paytm" target="__blank" href="https://paytm.com"><img
                      data-src="{{ url('images/payment/paytm.png') }}" alt="Paytm" class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->razorpay=='1')
                <div class="payment-item">
                  <a title="Razorpay" target="__blank" href="https://razorpay.com/"><img
                      data-src="{{ url('images/payment/razorpay.png') }}" alt="Razorpay" class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->instamojo_enable=='1')
                <div class="payment-item">
                  <a title="Instamojo" target="__blank" href="https://www.instamojo.com/"><img
                      data-src="{{ url('images/payment/instamojo.png') }}" alt="Razorpay"
                      class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->payu_enable=='1')
                <div class="payment-item">
                  <a title="PayUMoney" target="__blank" href="https://www.payu.in/"><img
                      data-src="{{ url('images/payment/payumoney.png') }}" alt="Razorpay"
                      class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->payhere_enable == '1')
                <div class="payment-item">
                  <a title="Payhere" target="__blank" href="https://www.payhere.lk/"><img
                      data-src="{{ url('images/payment/payhere.png') }}" alt="Payhere" class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->omise_enable == '1')
                <div class="payment-item">
                  <a title="Omise" target="__blank" href="https://www.omise.co"><img
                      data-src="{{ url('images/payment/omise.png') }}" alt="omise" class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->cashfree_enable == '1')
                <div class="payment-item">
                  <a title="Cashfree" target="__blank" href="https://www.cashfree.com/"><img
                      data-src="{{ url('images/payment/cashfree.png') }}" alt="cashfree" class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->moli_enable == '1')
                <div class="payment-item">
                  <a title="mollie" target="__blank" href="https://www.mollie.com/en"><img
                      data-src="{{ url('images/payment/mollie.png') }}" alt="mollie" class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->rave_enable == '1')
                <div class="payment-item">
                  <a title="Rave" target="__blank" href="https://dashboard.flutterwave.com/"><img
                      data-src="{{ url('images/payment/rave.png') }}" alt="rave" class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->skrill_enable == '1')
                <div class="payment-item">
                  <a title="Skrill" target="__blank" href="https://www.skrill.com/"><img
                      data-src="{{ url('images/payment/skrill.png') }}" alt="skrill" class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->sslcommerze_enable == '1')
                <div class="payment-item">
                  <a title="SSLCommerz" target="__blank" href="https://www.sslcommerz.com/"><img
                      data-src="{{ url('images/payment/sslcommerz.png') }}" alt="skrill" class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->enable_amarpay == '1')
                <div class="payment-item">
                  <a title="Aamarpay" target="__blank" href="https://aamarpay.com/"><img
                      data-src="{{ url('images/payment/aamarpay.png') }}" alt="skrill" class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if($Api_settings->iyzico_enable == '1')
                <div class="payment-item">
                  <a title="Iyzico Payment" target="__blank" href="https://www.iyzico.com/"><img
                      data-src="{{ url('images/payment/iyzico.png') }}" alt="skrill" class="owl-lazy img-fluid"></a>
                </div>
                @endif

                @if(config('dpopayment.enable') == 1 && Module::has('DPOPayment') &&
                Module::find('DPOPayment')->isEnabled())
                @include('dpopayment::front.sliderlogo')
                @endif

                @if(config('bkash.ENABLE') == 1 && Module::has('Bkash') && Module::find('Bkash')->isEnabled())
                @include('bkash::front.sliderlogo')
                @endif

                @if(config('mpesa.ENABLE') == 1 && Module::has('MPesa') && Module::find('MPesa')->isEnabled())
                @include('mpesa::front.sliderlogo')
                @endif

                @if(config('authorizenet.ENABLE') == 1 && Module::has('AuthorizeNet') &&
                Module::find('AuthorizeNet')->isEnabled())
                @include('authorizenet::front.sliderlogo')
                @endif

                @if(config('midtrains.ENABLE') == 1 && Module::has('Midtrains') &&
                Module::find('Midtrains')->isEnabled())
                @include('midtrains::front.sliderlogo')
                @endif

                @if(config('paytab.ENABLE') == 1 && Module::has('Paytab') && Module::find('Paytab')->isEnabled())
                @include('paytab::front.sliderlogo')
                @endif

                @if(config('worldpay.ENABLE') == 1 && Module::has('Worldpay') && Module::find('Worldpay')->isEnabled())
                @include('worldpay::front.sliderlogo')
                @endif

                @if(config('smanager.ENABLE') == 1 && Module::has('Smanager') && Module::find('Smanager')->isEnabled())
                @include('smanager::front.sliderlogo')
                @endif

                @if(config('squarepay.ENABLE') == 1 && Module::has('SquarePay') &&
                Module::find('SquarePay')->isEnabled())
                @include('squarepay::front.sliderlogo')
                @endif

                @if(config('esewa.ENABLE') == 1 && Module::has('Esewa') && Module::find('Esewa')->isEnabled())
                  @include('esewa::front.sliderlogo')
                @endif

                @if(config('senangpay.ENABLE') == 1 && Module::has('Senangpay') && Module::find('Senangpay')->isEnabled())
                  @include('senangpay::front.sliderlogo')
                @endif

              </div>
            </div>

            <!-- /.payment-methods -->
          </div>
        </div>
      </div>
    </div>

    <!-- small screen copyright-bar start -->
    <div class="copyright-bar header-nav-smallscreen">
      <div class="row">
        <div class="col-md-6">
          <div class="no-padding social">
            <ul class="link">
              @foreach($socials as $social)
              <li class="{{$social->icon}} pull-left"><a target="_blank" rel="nofollow" href="{{$social->url}}"></a>
              </li>
              @endforeach
            </ul>

            <div class="d-inline col-12 col-sm-12 col-md-12 col-lg-12 no-padding copyright">
              <span style="padding-left: 15px;">&copy; {{ date("Y") }} @if(isset($Copyright)) {{$Copyright}}</span>
              @endif
            </div>
          </div>
        </div>

      </div>


    </div>
    <!-- small screen copyright-bar end -->
  </footer>

  <!-- Offer Popup -->

  <!-- END-->

  <!-- Floating Chat Button -->
  <div id="wpButton"></div>

  @if(env('GOOGLE_TAG_MANAGER_ID') != '' && env('GOOGLE_TAG_MANAGER_ENABLED') == true)
  @include('googletagmanager::body')
  @endif

  @if(env('FACEBOOK_PIXEL_ID') != '')
  @include('facebook-pixel::body')
  @endif

  <!-- End -->
  <!-- Display GDPR7 Cokkie message -->
  @include('cookieConsent::index')
  @notify_js
  @notify_render

  <!-- Messenger Bubble -->
  @if(Request::ip() != '::1' && env('MESSENGER_CHAT_BUBBLE_URL') != '')
  <script src="{{ env('MESSENGER_CHAT_BUBBLE_URL') }}" async></script>
  @endif
  <script>
    var sendurl = @json(route('ajaxsearch'));
    var rightclick = @json($rightclick);
    var inspect = @json($inspect);
    var baseUrl = @json(url('/'));
    var crate = @json($conversion_rate);
    var exist = @json(url('shop'));
    var setstart = @json(url('setstart'));
  </script>
  <script src="{{ url('js/master.js') }}"></script>

  <!-- Default Front JS -->
  @if(selected_lang()->rtl_available == 1)
  <!-- RTL OWL JS-->
  <script src="{{url('front/js/default.js')}}"></script>

  @else
  <!-- LTR OWL JS-->
  <script src="{{url('front/js/scripts.min.js')}}"></script>
  @endif
  <script>
    var baseUrl = @json(url('/'));

    @if(selected_lang()->rtl_available == 1)
      var rtl = true;
    @else
      var rtl = false;
    @endif

  </script>

  <script src="{{ url('js/app.js') }}"></script>
  @if(file_exists(public_path().'/js/custom-js.js'))
  <script defer src="{{url('js/custom-js.js')}}"></script>
  @endif
  <!-- Sweetalert JS -->
  <script src="{{ url('front/vendor/js/sweetalert.min.js') }}"></script>

  @php
  $wp = \DB::table('whatsapp_settings')->first();
  @endphp

  @if(isset($wp) && $wp->status == 1)

  <script>
    $('#wpButton').venomButton({

      phone: '{{ $wp->phone_no }}',

      popupMessage: '{{ $wp->popupMessage }}',

      showPopup: true,

      position: '{{ $wp->position }}',

      size: '{{ $wp->size }}',

      headerTitle: '{{ $wp->headerTitle }}',

      headerColor: '{{ $wp->headerColor }}'

    });
  </script>

  @endif

  @if(strlen( env('ONESIGNAL_APP_ID',""))>4)
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
  <script>
    var ONESIGNAL_APP_ID = @json(env('ONESIGNAL_APP_ID'));
    var USER_ID = '{{  auth()->user() ? auth()->user()->id : "" }}';
  </script>
  <script src="{{ url('js/onesignal.js') }}"></script>
  @endif

  <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/wow.js"></script>
  <script>
    // JavaScript Document
    $(window).on('load', function() {

      $('#loader-wrapper').hide();

    });
    $(window).scroll(function() {
        var e = $(".sticky");
        $(window).scrollTop() >= 50 ? e.addClass("fixed") : e.removeClass("fixed")
    }), $(".navbar-toggler").click(function() {
        $(".navbar-expand-lg").toggleClass("drawer-open")
    }), $(".nav-overlay").click(function() {
        $(".navbar-expand-lg").removeClass("drawer-open")
    }),
    $(document).ready(function() {
        $("#owl-carousel8").owlCarousel({
            loop: !0,
            margin: 0,
            autoplay: !0,
            autoplayTimeout: 8e3,
            items: 1,
            nav: !0,
            dots: !1,
            touchDrag: true,
            mouseDrag: true,
            animateOut: "fadeOut",
            animateIn: "fadeIn"
        }), $(".owl-prev").html('<i class="fa fa-angle-left"></i>'), $(".owl-next").html('<i class="fa fa-angle-right"></i>')
    }),
    $(document).ready(function() {
        $("#owl-carousel4").owlCarousel({
            loop: !0,
            margin: 30,
            padding: 30,
            responsiveClass: !0,
            autoplay: !0,
            autoplayTimeout: 3e3,
            autoplayHoverPause: !0,
            responsive: {
                0: {
                    items: 1,
                    nav: !0
                },
                575: {
                    items: 1,
                    nav: !1
                },
                1000: {
                    items: 2,
                    nav: !0,
                    loop: !1
                }
            }
        }), $(".owl-prev").html('<i class="fa fa-angle-left"></i>'), $(".owl-next").html('<i class="fa fa-angle-right"></i>')
    }),
    jQuery(document).on("click", '[data-toggle="lightbox"]', function(e) {
        e.preventDefault(), jQuery(this).ekkoLightbox()
    }), $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    }),  
    $(document).ready(function() {
        $("#backToTop").click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 500)
        }), window.onscroll = function() {
            document.body.scrollTop > 20 || document.documentElement.scrollTop > 20 ? $("#backToTop").addClass("d-block") : $("#backToTop").removeClass("d-block")
        }
    })
    // counter
    var a = 0;
    $(window).scroll(function() {

    var oTop = $('#counter').offset().top - window.innerHeight;
    if (a == 0 && $(window).scrollTop() > oTop) {
        $('.counter-value').each(function() {
            var $this = $(this),
                countTo = $this.attr('data-count');
            $({
                countNum: $this.text()
            }).animate({
                    countNum: countTo
                },

                {

                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                        //alert('finished');
                    }

                });
        });
        a = 1;
    }

    });
    //animated class for scroll
    wow = new WOW(

    {

        animateClass: 'animated',

        offset: 100,

        callback: function(box) {

        }
    }

    );

    wow.init();

    $('*').each(function() {

    if ($(this).attr('data-animation')) {

        var $animationName = $(this).attr('data-animation'),

            $animationDelay = "delay-" + $(this).attr('data-animation-delay');

        $(this).appear(function() {

            $(this).addClass('wow').addClass($animationName);

            $(this).addClass('wow').addClass($animationDelay);

        });

    }

    });
  </script>
  @yield('script')

</body>

</html>