<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            <span class="brand-text font-weight-light">HEPARS</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse order-3 collapse" id="navbarCollapse" style="">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{request()->routeIs('home') ? 'active' : ''}}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admission_portals') }}" class="nav-link {{request()->routeIs('admission_portals') ? 'active' : ''}}">Admission Portals</a>
                </li>
            </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}" role="button">
                    <i class="fas fa-user"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>