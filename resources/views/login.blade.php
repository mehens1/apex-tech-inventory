<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    @include('portal.layout.headMetas')
    <title>Login - APEX Solar & CCTV</title>
</head>

<body>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">

                <img class="img-fluid logo-dark mb-2 logo-color" src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                <img class="img-fluid logo-light mb-2" src="{{ asset('assets/img/logo2-white.png') }}" alt="Logo">
                <div class="loginbox">

                    <div class="login-right">

                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle mt-3">APEX Solar & CCTV Inventory System <br> Access to our
                                dashboard
                            </p>

                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="input-block mb-3">
                                    <label for="email" class="form-control-label">Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>

                                <div class="input-block mb-3">
                                    <label for="password" class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input type="password" name="password" id="password"
                                            class="form-control pass-input" required>
                                        <span class="fas fa-eye toggle-password"></span>
                                    </div>
                                </div>

                                <div class="input-block mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-check custom-checkbox">
                                                <input type="checkbox" name="remember" class="form-check-input"
                                                    id="cb1">
                                                <label class="custom-control-label" for="cb1">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a class="forgot-link" href="#">Forgot
                                                Password?</a>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-lg btn-primary w-100" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    @include('portal.layout.scripts')
</body>

</html>
