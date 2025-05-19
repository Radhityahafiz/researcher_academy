<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon" style="font-size: 1.5rem;">
            <i class="fas fa-book-reader"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            <div class="font-weight-bold" style="font-size: 1.2rem; line-height: 1.1;">Research</div>
            <div style="font-size: 0.8rem; line-height: 1.1;">Academy</div>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @auth
        @if(auth()->user()->isMentor())
            <!-- Heading -->
            <div class="sidebar-heading">
                Teaching
            </div>

            <!-- Nav Item - Materials -->
            <li class="nav-item {{ request()->routeIs('materials.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('materials.index') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Materials</span></a>
            </li>

            <!-- Nav Item - Videos -->
            <li class="nav-item {{ request()->routeIs('videos.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('videos.index') }}">
                    <i class="fas fa-fw fa-video"></i>
                    <span>Videos</span></a>
            </li>

            <!-- Nav Item - Categories -->
            <li class="nav-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Categories</span></a>
            </li>
        @endif

        <!-- Nav Item - Quizzes -->
        <li class="nav-item {{ request()->routeIs('quizzes.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('quizzes.index') }}">
                <i class="fas fa-fw fa-question-circle"></i>
                <span>Quizzes</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    @endauth
</ul>
<!-- End of Sidebar -->

<!-- Tambahkan ini di bagian bawah layout (misalnya di file blade layout atau langsung dalam file ini) -->
<style>
    #accordionSidebar {
        background: linear-gradient(to bottom, #2980b9, #1abc9c) !important; /* Biru kehijauan */
    }
</style>
