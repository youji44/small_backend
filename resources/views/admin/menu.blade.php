<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
@php($url = Request::url())
<!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="{{route('dashboard')}}">
        <div class="sidebar-brand-text mx-3 ttn">
            <div class="left">
                <img src="{{asset('logo.svg')}}" alt="">
            </div>
        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Dashboard -->
    <li class="nav-item {{ str_contains($url,'/dashboard')? 'active' : '' }}">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-home"></i>
            <span>User Details</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
</ul>