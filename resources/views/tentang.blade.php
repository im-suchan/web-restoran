@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="about-page">
    <section class="hero-section">
        <h1>Tentang Kami</h1>
        <p>
            Warung Mbadog adalah restoran yang menghadirkan cita rasa autentik masakan Indonesia dalam suasana yang hangat dan bersahabat.
            Berdiri dengan semangat melestarikan kekayaan kuliner Nusantara, Warung Mbadog menyajikan berbagai hidangan khas dari berbagai daerah di Indonesia,
            mulai dari makanan rumahan yang sederhana hingga sajian tradisional yang legendaris.
        </p>
        <p>
            Nama "Mbadog", yang dalam bahasa Jawa berarti "makan dengan lahap", mencerminkan filosofi kami: menyajikan makanan lezat yang membuat pelanggan makan dengan penuh kenikmatan.
            Kami percaya bahwa makanan bukan hanya soal rasa, tetapi juga pengalaman dan itulah yang ingin kami hadirkan di setiap kunjungan.
        </p>
        <p>
            Dengan bahan-bahan segar pilihan, resep warisan keluarga, serta pelayanan yang ramah, kami berkomitmen untuk memberikan pengalaman bersantap yang tak terlupakan.
            Baik Anda sedang mencari sarapan tradisional, makan siang bersama rekan kerja, atau makan malam keluarga yang hangat, Warung Mbadog adalah tempat yang tepat.
        </p>
        <p>
            Mari nikmati kekayaan rasa Indonesia di setiap suapan, hanya di Warung Mbadog  Tempatnya makan enak pasti kenyang!!!
        </p>
    </section>

    <div class="container">

        <section class="team-section">
            <h2>Tim Kami</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="{{ asset('images/team1.PNG') }}" alt="Chef Kami">
                    <h3>Suchan</h3>
                    <p>Head Chef</p>
                </div>
                <div class="team-member">
                    <img src="{{ asset('images/team2.PNG') }}" alt="Pastry Chef">
                    <h3>Wuchan</h3>
                    <p>Pastry Chef</p>
                </div>
                <div class="team-member">
                    <img src="{{ asset('images/team3.PNG') }}" alt="Manajer Restoran">
                    <h3>Anna</h3>
                    <p>Restaurant Manager</p>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const hero = document.querySelector('.hero-section');
        
        // Dapatkan URL gambar secara langsung
        const bgImages = [
            "{{ asset('images/bg-reser1.jpg') }}",
            "{{ asset('images/bg-reser2.jpg') }}",
            "{{ asset('images/bg-reser3.jpg') }}"
        ];
        
        let currentIndex = 0;
        
        function changeBackground() {
            hero.style.backgroundImage = `url(${bgImages[currentIndex]})`;
            hero.style.backgroundSize = "cover";
            hero.style.backgroundPosition = "center";
            currentIndex = (currentIndex + 1) % bgImages.length;
        }
        
        // Atur background awal
        changeBackground();
        
        // Mulai slideshow
        setInterval(changeBackground, 5000);
    });
</script>