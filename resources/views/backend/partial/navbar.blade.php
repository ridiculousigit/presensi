<nav class="navbar navbar-expand justify-content-between fixed-top">
    <a class="navbar-brand mb-0 h1 d-none d-md-block" href="{{ route('home') }}">
        <img src="{{ asset('vendor') }}/demo/img/bri_logo.png" class="navbar-brand-image d-inline-block align-top mr-2"
            width="400px" alt="">
        LAB - BRI
    </a>
    <div class="d-flex flex-1 d-block d-md-none">
        <a href="{{ route('home') }}" class="sidebar-toggle ml-3">
            <i data-feather="menu"></i>
        </a>
    </div>

    <ul class="navbar-nav d-flex justify-content-end mr-2">

        <li class="nav-item dropdown">
            <a class="nav-link avatar-with-name" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#">

                <img src="{{ asset('photo/' . $role->photo) }}" class="d-inline-block align-top" alt="">
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('editProfile', ['id' => $role->id]) }}">My Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="{{ route('logout') }}">Sign out</a>
            </div>
        </li>
    </ul>
</nav>
