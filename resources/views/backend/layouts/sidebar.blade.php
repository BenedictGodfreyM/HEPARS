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
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('career_paths') }}" class="nav-link">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Career Paths</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('institutions') }}" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Institutions</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('subjects') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>High School Subjects</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.Sidebar-menu -->
    </div>
</aside>