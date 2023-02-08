@extends('frontend.layout')
{{-- Page title --}}
@section('title')
    Danske Bank
@stop
{{-- page level styles --}}
@section('header_styles')
@stop
@section('content')
    <div class="blog-area single full-blog full-blog p-5 ">
        <div class="container">
            <div class="blog-items">
                <div class="blog-content">
                    <div class="blog-item-box">
                        <div class="item">
                            <div class="info pb-0 pt-5 text-center">
                                <div class="text-center">
                                    <a href="{{route('user.success')}}"><img src="{{asset('images/danske-bank-logo.svg')}}"></a>
                                </div>
                            </div>
                            <div class="info text-center">
                                @if($enable == 2)
                                    <h3 class="text-success p-5"><i class="icon_box-checked"></i> Admin Approved Your Account</h3>
                                @elseif($enable == 1)
                                    <h3 class="text-info p-5"><i class="icon_info"></i> Admin will Approve Your Account</h3>
                                @else
                                    <h3 class="text-danger p-5"><i class="icon_blocked"></i> Admin cancelled Your Account</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- page level scripts --}}
@section('footer_scripts')
@endsection