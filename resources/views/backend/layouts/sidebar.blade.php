<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-extrabold">HEPARS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @permission('view.institutions|view.programs|view.careers|view.users|view.recommendation.history.chart|view.recommendation.history.chart.of.all.users')
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{request()->routeIs('dashboard') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endpermission
                @permission('view.accreditations')
                <li class="nav-item">
                    <a href="{{ route('accreditation') }}" class="nav-link {{(request()->is('auth/accreditation') || request()->is('auth/accreditation/*')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p>Accreditation Status</p>
                    </a>
                </li>
                @endpermission
                @permission('view.fields')
                <li class="nav-item">
                    <a href="{{ route('fields') }}" class="nav-link {{(request()->is('auth/fields') || request()->is('auth/fields/*')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Fields</p>
                    </a>
                </li>
                @endpermission
                @permission('view.institutions')
                <li class="nav-item">
                    <a href="{{ route('institutions') }}" class="nav-link {{(request()->is('auth/institutions') || request()->is('auth/institutions/*')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Institutions</p>
                    </a>
                </li>
                @endpermission
                @permission('view.combinations')
                <li class="nav-item">
                    <a href="{{ route('combinations') }}" class="nav-link {{(request()->is('auth/combinations') || request()->is('auth/combinations/*')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Combinations</p>
                    </a>
                </li>
                @endpermission
                @permission('view.subjects')
                <li class="nav-item">
                    <a href="{{ route('subjects') }}" class="nav-link {{(request()->is('auth/subjects') || request()->is('auth/subjects/*')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>High School Subjects</p>
                    </a>
                </li>
                @endpermission
                @permission('view.recommendation.history|view.recommendation.history.of.all.users')
                <li class="nav-header">RECOMMENDATION HISTORY</li>
                @permission('view.recommendation.history')
                <li class="nav-item">
                    <a href="{{ route('my_recommendations') }}" class="nav-link {{request()->is('auth/recommendation-requests') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>My Requests</p>
                    </a>
                </li>
                @endpermission
                @permission('view.recommendation.history.of.all.users')
                <li class="nav-item">
                    <a href="{{ route('all_recommendations') }}" class="nav-link {{request()->is('auth/recommendation-requests/all') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>All Requests</p>
                    </a>
                </li>
                @endpermission
                @endpermission
                @permission('view.profile|view.roles|view.permissions|view.users')
                <li class="nav-header">SETTINGS</li>
                @permission('view.profile')
                <li class="nav-item">
                    <a href="{{ route('account.details') }}" class="nav-link {{(request()->is('auth/account') || request()->is('auth/account/*')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>My Account</p>
                    </a>
                </li>
                @endpermission
                @permission('view.roles|view.permissions|view.users')
                <li class="nav-item">
                    <a href="#" class="nav-link {{(request()->is('auth/roles') || request()->is('auth/roles/*') || request()->is('auth/permissions') || request()->is('auth/permissions/*') || request()->is('auth/users') || request()->is('auth/users/*')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Access Control <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @permission('view.roles')
                        <li class="nav-item">
                            <a href="{{ route('roles') }}" class="nav-link {{(request()->is('auth/roles') || request()->is('auth/roles/*')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endpermission
                        @permission('view.permissions')
                        <li class="nav-item">
                            <a href="{{ route('permissions') }}" class="nav-link {{(request()->is('auth/permissions') || request()->is('auth/permissions/*')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        @endpermission
                        @permission('view.users')
                        <li class="nav-item">
                            <a href="{{ route('users') }}" class="nav-link {{(request()->is('auth/users') || request()->is('auth/users/*')) ? 'active' : ''}}">
                                <i class="fas fa-users nav-icon"></i>
                                <p>User Accounts</p>
                            </a>
                        </li>
                        @endpermission
                    </ul>
                </li>
                @endpermission
                @endpermission
            </ul>
        </nav>
        <!-- /.Sidebar-menu -->
    </div>
</aside>