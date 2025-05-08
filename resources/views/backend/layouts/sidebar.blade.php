<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">HEPARS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{request()->routeIs('dashboard') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('career_paths') }}" class="nav-link {{(request()->is('auth/career_paths') || request()->is('auth/career_paths/*')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Career Paths</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('institutions') }}" class="nav-link {{(request()->is('auth/institutions') || request()->is('auth/institutions/*')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Institutions</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('subjects') }}" class="nav-link {{(request()->is('auth/subjects') || request()->is('auth/subjects/*')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>High School Subjects</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('combinations') }}" class="nav-link {{(request()->is('auth/combinations') || request()->is('auth/combinations/*')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Combinations</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.Sidebar-menu -->
    </div>
</aside>