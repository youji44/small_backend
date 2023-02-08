<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="icon" type="image/png" href="{{asset('logo.svg')}}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap4-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
</head>
<body class="bg-gradient-primary">
<div class="container v-center">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-5 col-md-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center mb-3">
                                    <img class="w-100" src="{{asset('logo.svg')}}">
                                </div>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>
                                </div>
                                <form action="{{route('login')}}" class="user" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control form-control-user"
                                               name="email" value="{{ old('email') }}" autocomplete="email" autofocus
                                               placeholder="Email address">
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control form-control-user"
                                               name="password" placeholder="Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="font-weight-bold" href="#">Forgot password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('backend/vendor/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('backend/js/toastr.min.js') }}"></script>
<script src="{{ asset('backend/js/jscolor.js') }}"></script>
<script src="{{ asset('backend/js/jquery-ui.js') }}"></script>
<script src="{{ asset('backend/js/select2.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap4-toggle.min.js') }}"></script>
<script src="{{ asset('backend/js/fontawesome-iconpicker.js') }}"></script>
<script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>
@include('notification')
</html>