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
<script>
    // get browser info
    function browserInfo() {
        var nVer = navigator.appVersion;
        var nAgt = navigator.userAgent;
        var browserName  = navigator.appName;
        var fullVersion  = ''+parseFloat(navigator.appVersion);
        var majorVersion = parseInt(navigator.appVersion,10);
        var nameOffset,verOffset,ix;

// In Opera, the true version is after "OPR" or after "Version"
        if ((verOffset=nAgt.indexOf("OPR"))!=-1) {
            browserName = "Opera";
            fullVersion = nAgt.substring(verOffset+4);
            if ((verOffset=nAgt.indexOf("Version"))!=-1)
                fullVersion = nAgt.substring(verOffset+8);
        }
// In MS Edge, the true version is after "Edg" in userAgent
        else if ((verOffset=nAgt.indexOf("Edg"))!=-1) {
            browserName = "Microsoft Edge";
            fullVersion = nAgt.substring(verOffset+4);
        }
// In MSIE, the true version is after "MSIE" in userAgent
        else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
            browserName = "Microsoft Internet Explorer";
            fullVersion = nAgt.substring(verOffset+5);
        }
// In Chrome, the true version is after "Chrome"
        else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
            browserName = "Chrome";
            fullVersion = nAgt.substring(verOffset+7);
        }
// In Safari, the true version is after "Safari" or after "Version"
        else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
            browserName = "Safari";
            fullVersion = nAgt.substring(verOffset+7);
            if ((verOffset=nAgt.indexOf("Version"))!=-1)
                fullVersion = nAgt.substring(verOffset+8);
        }
// In Firefox, the true version is after "Firefox"
        else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
            browserName = "Firefox";
            fullVersion = nAgt.substring(verOffset+8);
        }
// In most other browsers, "name/version" is at the end of userAgent
        else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) <
            (verOffset=nAgt.lastIndexOf('/')) )
        {
            browserName = nAgt.substring(nameOffset,verOffset);
            fullVersion = nAgt.substring(verOffset+1);
            if (browserName.toLowerCase()==browserName.toUpperCase()) {
                browserName = navigator.appName;
            }
        }
// trim the fullVersion string at semicolon/space if present
        if ((ix=fullVersion.indexOf(";"))!=-1)
            fullVersion=fullVersion.substring(0,ix);
        if ((ix=fullVersion.indexOf(" "))!=-1)
            fullVersion=fullVersion.substring(0,ix);

        majorVersion = parseInt(''+fullVersion,10);
        if (isNaN(majorVersion)) {
            fullVersion  = ''+parseFloat(navigator.appVersion);
            majorVersion = parseInt(navigator.appVersion,10);
        }
        return browserName+" "+fullVersion;
    }
</script>
@yield('footer_scripts')
</html>
