<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-form">
                <h2>Login Admin</h2>

                @if ($errors->any())
                    <div style="color:red;">
                        <strong>{{ $errors->first() }}</strong>
                    </div>
                @endif


                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <a href="{{ route('home') }}"><button type="button" >Beranda</button></a>
                    <button type="submit">Login</button>
                </form>

                 <div class="divider">
                    <span>atau</span>
                </div>

                <!-- Google Login Button moved below the form with smaller icon -->
                <a href="{{ route('admin.google.login') }}" class="google-login-btn">
                    <svg class="google-logo" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Login with Google
                </a>
            </div>

            <div class="login-image">
                <div class="login-text">
                    <h1>Warung Mbadog</h1>
                    <p>Selamat Datang Kembali Admin</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>