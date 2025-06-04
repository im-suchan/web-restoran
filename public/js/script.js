// Fungsi filter menu
document.addEventListener('DOMContentLoaded', function() {
    const tombolKategori = document.querySelectorAll('.category-btn');
    const kartuMakanan = document.querySelectorAll('.dish-card');
    
    if (tombolKategori.length > 0 && kartuMakanan.length > 0) {
        tombolKategori.forEach(tombol => {
            tombol.addEventListener('click', function() {
                const kategori = this.getAttribute('data-kategori');
                
                // Hapus class active dari semua tombol
                tombolKategori.forEach(btn => btn.classList.remove('active'));
                
                // Tambah class active ke tombol yang diklik
                this.classList.add('active');
                
                // Filter makanan
                kartuMakanan.forEach(kartu => {
                    if (kategori === 'semua' || kartu.getAttribute('data-kategori') === kategori) {
                        kartu.style.display = 'block';
                    } else {
                        kartu.style.display = 'none';
                    }
                });
            });
        });
    }
    
    // Tambah class active ke tombol kategori pertama secara default
    if (tombolKategori.length > 0) {
        tombolKategori[0].classList.add('active');
    }
});
const hero = document.querySelector('.hero');
const images = [
    'images/hero-bg.jpg',
    'images/hero-bg2.jpg',
    'images/hero-bg3.jpg'
];
let currentIndex = 0;

function changeBackground() {
    hero.style.backgroundImage = `url('${images[currentIndex]}')`;
    currentIndex = (currentIndex + 1) % images.length;
}

setInterval(changeBackground, 5000); // Ganti setiap 5 detik
changeBackground(); // Tampilkan gambar pertama saat halaman dimuat
