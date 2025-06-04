@extends('layouts.admin')

@section('content')
<div class="dashboard-content">
    <div class="welcome-box">
        <h4>Halaman Beranda</h4>
        <div class="card">
            <div class="card-body">
                <h5>Selamat Datang, {{ Auth::guard('admin')->user()->name }}</h5>
                <p>Melalui dashboard ini, Anda dapat dengan mudah mengelola berbagai kebutuhan restoran, mulai dari data menu, pemesanan pelanggan, reservasi meja, hingga testimoni dan laporan penjualan. Sistem ini dirancang untuk membantu operasional restoran menjadi lebih efisien dan terorganisir.

Gunakan fitur-fitur yang tersedia dengan bijak untuk memastikan pelayanan terbaik bagi pelanggan serta menjaga kualitas sajian khas Nusantara yang menjadi kebanggaan Warung Mbadog.

Terima kasih atas dedikasi Anda.
Mari bersama-sama kita jaga rasa dan pelayanan terbaik untuk setiap pengunjung Warung Mbadog.</p>


                <div class="note">Warung Mbadog? Kenyang Pokoknya!!!</div>
            </div>
        </div>
    </div>
</div>
@endsection
