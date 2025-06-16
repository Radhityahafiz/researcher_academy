<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-3" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon" style="font-size: 1.8rem;">
            <i class="fas fa-book-reader"></i>
        </div>
        <div class="sidebar-brand-text mx-3 text-center">
            <div class="font-weight-bold" style="font-size: 1.3rem; line-height: 1.1;">Research</div>
            <div style="font-size: 0.9rem; line-height: 1.1;">Academy</div>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Beranda</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @auth
        @if(auth()->user()->isMentor())
            <!-- Heading -->
            <div class="sidebar-heading">
                Konten Pembelajaran
            </div>

            <!-- Nav Item - Categories -->
            <li class="nav-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Kategori</span></a>
            </li>

            <!-- Nav Item - Materials -->
            <li class="nav-item {{ request()->routeIs('materials.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('materials.index') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Materi</span></a>
            </li>

            <!-- Nav Item - Videos -->
            <li class="nav-item {{ request()->routeIs('videos.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('videos.index') }}">
                    <i class="fas fa-fw fa-video"></i>
                    <span>Video</span></a>
            </li>

            <!-- Nav Item - Assignments -->
            <li class="nav-item {{ request()->routeIs('assignments.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('assignments.index') }}">
                    <i class="fas fa-tasks"></i>
                    <span>Penugasan</span></a>
            </li>
           
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Manajemen
            </div>

            <!-- Nav Item - Participants -->
<li class="nav-item {{ request()->routeIs('students.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('students.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Kelola Peserta</span></a>
</li>

            <!-- Nav Item - Testimonials -->
            <li class="nav-item {{ request()->routeIs('testimonials.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('testimonials.dashboard') }}">
                    <i class="fas fa-fw fa-comment"></i>
                    <span>Kelola Testimoni</span>
                </a>
            </li>
        @endif

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    @endauth
</ul>
<!-- End of Sidebar -->