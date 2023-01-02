@php
    $notAllowedHeaders = ['recoverytruck', 'recoverytruck/otp'];
@endphp
<!DOCTYPE html>
<!-- Microdata markup added by Google Structured Data Markup Helper. -->
<html lang="en">

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

    <!-- meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Hire And Fyre | Recovery Truck bucking UAE" />
    <meta name="description" content="Hire And Fyre | Recovery Truck bucking UAE" />

    <title>@yield('title') {{ $title }} </title>

    <!-- favicon -->
    <link rel="icon" href="{{ url('images/genral/'.$fevicon) }}" type="image/png" sizes="16x16" />
    
    <!-- link -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <link rel="stylesheet" href="{{ url('css/theme.css') }}">
    <link rel="stylesheet" href="{{ url('css/stylesheet-recoverytruck.css') }}">
    
    @if(selected_lang()->rtl_available == 1)
        <!-- RTL -->
            <link rel="stylesheet" href="{{ url('css/rtl.css') }}">
            <link rel="stylesheet" href="{{ url('css/navbar-rtl.css') }}">
        <!-- END -->
    @endif
    @php
        if(!in_array(Request::path(), $notAllowedHeaders)) {
    @endphp
        <link rel="stylesheet" href="{{ url('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ url('css/animate.css') }}">
    @php
        }
    @endphp

    <link rel="stylesheet"
        href="//fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" 
        href="//fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- <title>Hire And Fyre | Recovery Truck bucking UAE</title> -->
    
    <!-- Patterns -->
    @include('front.layout.patterns.pattern1')
    @include('front.layout.patterns.pattern2')
    @include('front.layout.patterns.pattern3')
    @include('front.layout.patterns.pattern4')
    @include('front.layout.patterns.pattern5')

    <!-- Custom Css -->
    @if(file_exists(public_path().'/css/custom-style.css'))
    <link rel="stylesheet" type="text/css" href="{{url('css/custom-style.css')}}">
    @endif

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
</head>
<body>

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

    <!-- ============================================== HEADER ============================================== -->
    @php
        if(!in_array(Request::path(), $notAllowedHeaders)) {
    @endphp
            @include('front.layout.recoverytruck.header')
    @php
        }
    @endphp
    

    <!-- Main Body -->
    @yield('body')

    <!-- Main Body End -->
    @php
        if(in_array(Request::path(), $notAllowedHeaders)) {
    @endphp
            @include('front.layout.recoverytruck.footer')
    @php
        }
    @endphp
    
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

    <!-- <script src="//code.jquery.com/jquery-3.6.0.js"></script> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="{{ url('js/script-recoverytruck.js') }}"></script>
  @yield('script')

</body>
</html>
