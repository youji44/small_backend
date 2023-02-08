<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{asset('logo.png')}}">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{asset('frontend/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('frontend/assets/css/font-awesome.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('frontend/assets/css/themify-icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('frontend/assets/css/flaticon-set.css')}}" rel="stylesheet"/>
    <link href="{{asset('frontend/assets/css/elegant-icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('frontend/assets/css/magnific-popup.css')}}" rel="stylesheet"/>
    <link href="{{asset('frontend/assets/css/owl.carousel.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('frontend/assets/css/owl.theme.default.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('frontend/assets/css/animate.css')}}" rel="stylesheet"/>
    <link href="{{asset('frontend/assets/css/bootsnav.css')}}" rel="stylesheet"/>
    <link href="{{asset('frontend/assets/css/responsive.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('backend/css/toastr.min.css') }}">

    <!-- ========== End Stylesheet ========== -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <title>@yield('title')</title>
    @yield('header_styles')
</head>

<body id="page-top">
<!-- Preloader Start -->
<div id="site-preloader" class="site-preloader">
    <div class="loader-wrap">
        <div class="ring">
            <span></span>
        </div>
        <h2>Danske</h2>
    </div>
</div>
<!-- Preloader Ends -->
<!-- Page Wrapper -->
<div id="wrapper">
    <div class="container-fluid">
        @yield('content')
    </div>
</div>
<!-- End of Page Wrapper -->
</body>

<script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.appear.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/progress-bar.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootsnav.js') }}"></script>
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>
<script src="{{ asset('backend/js/toastr.min.js') }}"></script>

{{--<script src="{{ asset('js/app.js') }}"></script>--}}
@include('notification')

@yield('footer_scripts')
</html>
