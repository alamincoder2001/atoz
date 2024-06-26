<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{url('admin')}}">
                <img src="{{asset($profile->logo != null ? $profile->logo : 'noImage.jpg')}}" alt="homepage" class="light-logo" style="width: 40px; height: 35px; border: 1px solid #4c4c4c; border-radius: 4px;" />
                <p class="m-0">{{ $profile->company_name }}</p>
            </a>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- End Logo -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav float-start me-auto">
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav float-end">
                <li class="nav-item dropdown">
                    <p style="margin: 0px;border-right: 1px solid gray; border-left: 1px solid gray;height: 100%;display: flex;align-items: center;padding: 15px;color: white;font-weight: 800;" id="time"></p>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset(Auth::guard()->user()->image != null ? Auth::guard()->user()->image: 'noImage.jpg')}}" alt="user" class="rounded-circle" width="31" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="mdi mdi-account me-1 ms-1"></i> My Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>