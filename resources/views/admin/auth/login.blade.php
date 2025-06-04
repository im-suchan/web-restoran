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
