@php
    $user = Auth::user();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/png" href="#">

    <title>Admin Panel</title>

    @include('admin.app_styles')

    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">

    @include('admin.app_scripts')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            @php
                $route = Route::currentRouteName();
            @endphp

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="#">
                <div class="sidebar-brand-text mx-3 ttn">
                    <div class="left">
                        <img src="#" alt="">
                    </div>
                    <div class="right">
                        {{ env('APP_NAME') }}
                    </div>
                </div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <li class="nav-item {{ $route == 'admin_dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="btn btn-info btn-sm mt-3" href="{{ url('/') }}" target="_blank">
                                Visit WebSite
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            {{--<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                {{--<span class="mr-2 d-none d-lg-inline text-gray-600">{{ $user->name }}</span>--}}
                                {{--<img class="img-profile rounded-circle" src="{{ asset('uploads/user_photos/'.$user->photo) }}">--}}
                            {{--</a>--}}
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                {{--<a class="dropdown-item" href="{{ route('admin_profile_change') }}">--}}
                                    {{--<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> {{ CHANGE_PROFILE }}--}}
                                {{--</a>--}}
                                {{--<a class="dropdown-item" href="{{ route('admin_password_change') }}">--}}
                                    {{--<i class="fas fa-unlock-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ CHANGE_PASSWORD }}--}}
                                {{--</a>--}}
                                {{--<a class="dropdown-item" href="{{ route('admin_photo_change') }}">--}}
                                    {{--<i class="fas fa-image fa-sm fa-fw mr-2 text-gray-400"></i> {{ CHANGE_PHOTO }}--}}
                                {{--</a>--}}
                                {{--<a class="dropdown-item" href="{{ route('admin_banner_change') }}">--}}
                                    {{--<i class="fas fa-image fa-sm fa-fw mr-2 text-gray-400"></i> {{ CHANGE_BANNER }}--}}
                                {{--</a>--}}
                                {{--<div class="dropdown-divider"></div>--}}
                                {{--<a class="dropdown-item" href="{{ route('admin_logout') }}">--}}
                                    {{--<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ LOGOUT }}--}}
                                {{--</a>--}}
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('admin_content')

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('admin.app_scripts_footer')

</body>

</html>
