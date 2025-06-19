@extends('layouts.app')

@section('page_title', 'Log In')

@section('page_layout', 'layout-top-nav')

@section('page_top_navigation')
    @include('frontend.layouts.nav')
@endsection

@section('page_content_wrapper')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 mx-auto">
            <div class="card card-outline card-primary mt-4">
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <dl>
                            @foreach ($errors->all() as $error)
                                <dd>{{ $error }}</dd>
                            @endforeach
                        </dl>
                    </div>
                    @else
                    <p class="login-box-msg">Sign in to start your session</p>
                    @endif 

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Your Email" required="" autofocus autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember_me" name="remember" value="false">
                                <label for="remember">Remember Me</label>
                            </div>
                        </div>

                        <div class="text-center mt-2 mb-3">
                            <button type="submit" class="btn btn-primary btn-block">Log in</button>
                        </div>
                    </form>

                    @if (Route::has('password.request'))
                    <p class="mb-1">
                        <a href="{{ route('password.request') }}">I forgot my password</a>
                    </p>
                    @endif

                    @if (Route::has('register'))
                    <p class="mb-1">
                        <a href="{{ route('register') }}">Create a new account</a>
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection