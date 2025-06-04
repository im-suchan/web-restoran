<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Mbadog - @yield('title')</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Warung Mbadog</div>
            <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('menu') }}">Menu</a></li>
                <li><a href="{{ route('reservation.index') }}">Reservasi</a></li>
                <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                <li><a href="{{ route('kontak') }}">Kontak</a></li>
                <li><a href="{{ route('admin.login') }}">Login</a> </li>

            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-content">
            <div class="useful-links">
                <h3>LINK BERMANFAAT</h3>
                <ul>
                    <li><a href="{{ route('home') }}">BERANDA</a></li>
                    <li><a href="{{ route('menu') }}">KATEGORI</a></li>
                    <li><a href="{{ route('tentang') }}">TENTANG KAMI</a></li>
                    <li><a href="{{ route('kontak') }}">KONTAK</a></li>
                    <li><a href="#">LAINNYA</a></li>
                </ul>
            </div>
            <div class="contact-info">
                <h3>KONTAK</h3>
                <p>Jl. Lkr. Utara No.8, Perwira, Kec.<br>
                Bekasi Utara, Kota Bks, Jawa<br>
                Barat 17124<br>
                021 - 23231170<br>
                rektorat@bsi.ac.id</p>
            </div>
        </div>
        <div class="copyright">
            © Hak Cipta 2024 – 2025.  Warung Mbadog. Semua Hak Dilindungi.
        </div>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>