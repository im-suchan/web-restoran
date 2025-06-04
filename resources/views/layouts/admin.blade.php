<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="sidebar">
        <h1>
            <img src="{{ asset('images/favicon.png') }}" alt="Logo" style="height: 40px; vertical-align: middle; margin-right: 8px;">
            WarDog
        </h1>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Beranda</a></li>
            <li><a href="{{ route('admin.users.index') }}">User</a></li>

            <li><a href="#">Data Produk</a></li>
            <li><a href="#">Laporan</a></li>
            <li><a href="#">Costumer</a></li>
            <li><a href="{{ route('admin.account') }}">Manajemen Akun</a></li>
            <li>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

</body>
</html>
