<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    @include('portal.layout.headMetas')
    <title>Reset Password - APEX Solar & CCTV</title>
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
                            <h1>Reset Password</h1>
                            <p class="account-subtitle mt-3">APEX Solar & CCTV Inventory System <br> Rest password
                            </p>

                            

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('password.update', ['token' => $token]) }}" method="POST">
                                @csrf

                                <div class="input-block mb-3">
        <label for="new_password" class="form-control-label">New Password</label>
        <div class="pass-group">
            <input type="password" name="new_password" id="new_password" 
                   class="form-control pass-input" required>
            <span class="fas fa-eye toggle-password"></span>
        </div>
    </div>

    <div class="input-block mb-3">
        <label for="new_password_confirmation" class="form-control-label">Confirm Password</label>
        <div class="pass-group">
            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                   class="form-control pass-input" required>
            <span class="fas fa-eye toggle-password"></span>
        </div>
    </div>

    <button class="btn btn-lg btn-primary w-100" type="submit">Change Password</button>
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
