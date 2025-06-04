@extends('layouts.app')

@section('title', 'Beranda')
@section('content')
<section class="hero">
    <h1>Selamat Datang di Warung Mbadog</h1>
    <p>Nikmati perjalanan rasa melalui makanan khas Indonesia yang kaya akan cita rasa dan budaya. Dari rendang yang lembut hingga sate yang menggoda, dari gudeg yang manis hingga soto yang hangat – kami menghadirkan resep autentik, cerita kuliner, dan rekomendasi terbaik untuk memuaskan hasrat makanan nusantara Anda.</p>
    <button class="order-btn">Pesan Sekarang</button>
</section>

<section class="why-choose-us">
    <div class="container">
        <div class="image-side">
            <img src="/images/Ayam_Bakar.jpg" alt="Salad Chicken Dish" />
        </div>
        <div class="text-side">
            <h2>Mengapa Memilih Kami?</h2>

            <div class="feature">
                <div class="icon purple">🍽️</div>
                <div>
                    <h3>Cita Rasa Autentik & Konsisten</h3>
                    <p>Setiap hidangan kami mempertahankan resep asli turun-temurun, dipadukan dengan standar modern untuk rasa yang selalu autentik dan lezat.</p>
                    <p>Bahan-bahan berkualitas tinggi, dipilih dari sumber terbaik untuk menjamin kepuasan pelanggan Anda.</p>
                </div>
            </div>

            <div class="feature">
                <div class="icon orange">📈</div>
                <div>
                    <h3>Menu Inovatif & Trendi</h3>
                    <p>Tim ahli kami terus mengembangkan varian baru dari masakan klasik, membantu restoran Anda menonjol di pasar kompetitif.</p>
                    <p>Solusi menu khusus (halal, vegetarian, sehat) untuk menjangkau lebih banyak pelanggan.</p>
                </div>
            </div>

            <div class="feature">
                <div class="icon green">👨‍🍳</div>
                <div>
                    <h3> Layanan Profesional & Andal</h3>
                    <p>Tim kami akan membuat kehadiran anda seperti di rumah keluarga anda sendiri.</p>
                    <p>Kami akan membuat makanan anda dalam waktu 10-20 menit, minuman dalam waktu 2-5 menit.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="best-seller-section">
    <div class="menu-container">
        <h2>Menu Terlaris kami!!!🔥🔥</h2>
        <p class="description">
            Temukan hidangan terlaris kami yang telah memikat hati banyak pelanggan. Dari makanan hingga minuman.
        </p>

        <div class="cards-grid">
            <!-- Card 1 -->
            <div class="dish-card">
                <img src="images/nasigorengbeef.jpg" alt="Breakfast Food">
                <div class="dish-info">
                    <h3>Nasi Goreng Beef</h3>
                    <p class="price">Rp.40.000</p>
                    <p class="description">Nasi goreng beef adalah hidangan nasi goreng khas Indonesia yang dipadukan dengan irisan daging sapi yang gurih dan empuk.</p>
                    <button class="buy-btn">Pesan</button>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="dish-card">
                <img src="images/Nasiayambakar.jpg" alt="Health Breakfast">
                <div class="dish-info">
                    <h3>Nasi Ayam Bakar</h3>
                    <p class="price">Rp.30.000</p>
                    <p class="description">Nasi ayam bakar adalah hidangan lezat yang terdiri dari nasi putih hangat yang disajikan dengan ayam yang dibakar hingga matang sempurna dan berbumbu khas.</p>
                    <button class="buy-btn">Pesan</button>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="dish-card">
                <img src="images/Ayamgeprek.jpg" alt="Health Breakfast">
                <div class="dish-info">
                    <h3>Nasi Ayam Geprek</h3>
                    <p class="price">Rp.25.000</p>
                    <p class="description">Nasi ayam geprek adalah hidangan populer yang terdiri dari nasi putih hangat dan ayam goreng krispi yang digeprek lalu dilumuri sambal pedas khas.</p>
                    <button class="buy-btn">Pesan</button>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="dish-card">
                <img src="images/cahkangkung.jpg" alt="Health Breakfast">
                <div class="dish-info">
                    <h3>Cah Kangkung</h3>
                    <p class="price">Rp.20.000</p>
                    <p class="description">Cah kangkung adalah hidangan tumis sayur yang terbuat dari kangkung segar yang dimasak cepat dengan bawang putih, cabai, dan saus tiram.</p>
                    <button class="buy-btn">Pesan</button>
                </div>
            </div>
            <!-- Card 5-->
            <div class="dish-card">
                <img src="images/cendoldawet.jpg" alt="Health Breakfast">
                <div class="dish-info">
                    <h3>Cendol Dawet</h3>
                    <p class="price">Rp.20.000</p>
                    <p class="description">Cendol adalah minuman tradisional segar yang terbuat dari tepung beras berbentuk kenyal berwarna hijau, disajikan dengan santan, gula merah cair, dan es serut.</p>
                    <button class="buy-btn">Pesan</button>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="dish-card">
                <img src="images/jusalpukat.jpg" alt="Health Breakfast">
                <div class="dish-info">
                    <h3>Jus Alpukat</h3>
                    <p class="price">Rp.15.000</p>
                    <p class="description">Jus alpukat adalah minuman segar dan lembut yang dibuat dari daging buah alpukat matang yang diblender dengan susu dan sedikit gula.</p>
                    <button class="buy-btn">Pesan</button>
                </div>
            </div>
        </div>

        <div class="more-btn-wrapper">
            <button class="more-btn">Selengkapnya</button>
        </div>
    </div>
</section>

@endsection