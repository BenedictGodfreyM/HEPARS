@push("styles")
<style>
    header{
        width: 100%;
        padding: 0;
        margin: 0;
        overflow-x: hidden;
    }
    .system-title{
        font-size: 24px;
        font-weight: bold;
        background: linear-gradient(135deg, #1eb53a 20%, #000000 20%, #000000 40%, #fcd116 40%,  #fcd116 60%, #000000 60%, #000000 80%, #00a3dd 80%);
        background-size: 100% 100%;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        text-fill-color: transparent;
    }
    .brand-logo{
        max-height: 65px;
        height: auto;
    }
    .bg-olive{
        background-color: #3d9970;
    }
    .navbar{
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .navbar-brand{
        font-weight: 700;
        letter-spacing: 1px;
    }
    .nav-link{
        position: relative;
        font-weight: 500;
        padding: 0.5rem 1rem !important;
        margin: 0 0.25rem;
        transition: all 0.3s ease;
    }
    .nav-link.active {
        font-weight: 900;
        color: #fff !important;
    }
    @media (min-width: 992px){
        .nav-link:after{
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #fff;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover:after,
        .nav-link.active:after{
            width: 70%;
        }
        .nav-link:hover{
            transform: translateY(-2px);
        }
    }
</style>
@endpush

<header>
    <div class="row p-2 py-3 border">
        <div class="col-2 my-auto">
            <img src="{{ asset('assets/img/National-Emblem.png') }}" alt="Natinal Emblem" class="float-right brand-logo" />
        </div>
        <div class="col-8 text-center my-auto system-title">
            HIGHER EDUCATION PROGRAM APPLICATION RECOMMENDATION SYSTEM
        </div>
        <div class="col-2 my-auto"> 
            <img src="{{ asset('assets/img/TCU-logo.png') }}" alt="TCU Logo" class="float-left brand-logo" />
        </div>
    </div>
</header>

<nav class="main-header navbar navbar-expand-md navbar-light navbar-white bg-olive">
    <div class="container">
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse order-3 collapse" id="navbarCollapse" style="">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{request()->routeIs('home') ? 'active' : ''}}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admission_portals') }}" class="nav-link {{request()->routeIs('admission_portals') ? 'active' : ''}}">Admission Portals</a>
                </li>
                <li class="nav-item">
                    <a href="@auth {{ route('dashboard') }} @else {{ route('login') }} @endauth" class="nav-link">Account</a>
                </li>
            </ul>
        </div>
    </div>
</nav>