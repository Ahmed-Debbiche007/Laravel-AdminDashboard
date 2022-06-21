    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <div class="sidebar-brand-icon">
            <i class="fa fa-solid fa-building"></i>
            </div>
             </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Nav::isRoute('home') }}">
            <a class="nav-link" href="/Dashboard">
            <i class="bi bi-speedometer2"></i>
                <span>{{ __('Dashboard') }}</span></a>
        </li>

        <li class="nav-item {{ Nav::isRoute('Listings') }}">
            <a class="nav-link" href="/Listings">
            <i class="bi bi-box-seam"></i>
                <span>Listings</span></a>
        </li>

        <li class="nav-item {{ Nav::isRoute('Clients') }}">
            <a class="nav-link" href="/Clients">
            <i class="bi bi-person"></i>
                <span>Clients</span></a>
        </li>


        <!-- Nav Item - Profile -->
        <li class="nav-item {{ Nav::isRoute('profile') }}">
            <a class="nav-link" href="/profile/{{ Auth::user()->id }}">
            <i class="bi bi-gear"></i>
                <span>Profile</span>
            </a>
        </li>

        <!-- Nav Item - About -->


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->