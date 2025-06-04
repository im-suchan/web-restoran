@extends('layouts.app')

@section('title', 'Menu Kami')

@section('content')
<div class="menu-page">
    <section class="hero-section">
        <h1>Menu Lezat Kami</h1>
        <p>Temukan berbagai pilihan makanan terbaik kami</p>
    </section>

    <div class="container">
        <div class="category-filter">
            <button class="filter-btn active" data-category="all">Semua</button>
            <button class="filter-btn" data-category="sarapan">Sarapan</button>
            <button class="filter-btn" data-category="makanan-utama">Makanan Utama</button>
            <button class="filter-btn" data-category="minuman">Minuman</button>
        </div>

        <div class="menu-grid">
            <!-- Item Menu 1 -->
            <div class="menu-item" data-category="sarapan">
                <div class="menu-card">
                    <div class="menu-image">
                        <img src="{{ asset('images/breakfast-food.jpg') }}" alt="Breakfast Food">
                    </div>
                    <div class="menu-details">
                        <h3>Breakfast Food</h3>
                        <p class="description">Menu sarapan sehat dengan bahan-bahan segar</p>
                        <div class="price-action">
                            <span class="price">Rp230.000</span>
                            <button class="order-btn">Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Item Menu 2 -->
            <div class="menu-item" data-category="sarapan">
                <div class="menu-card">
                    <div class="menu-image">
                        <img src="{{ asset('images/health-breakfast.jpg') }}" alt="Health Breakfast">
                    </div>
                    <div class="menu-details">
                        <h3>Health Breakfast</h3>
                        <p class="description">Sarapan bergizi untuk awal hari yang sehat</p>
                        <div class="price-action">
                            <span class="price">Rp230.000</span>
                            <button class="order-btn">Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Item Menu 3 -->
            <div class="menu-item" data-category="makanan-utama">
                <div class="menu-card">
                    <div class="menu-image">
                        <img src="{{ asset('images/burger.jpg') }}" alt="Burger">
                    </div>
                    <div class="menu-details">
                        <h3>Burger Juicy</h3>
                        <p class="description">Burger dengan patty juicy dan topping lezat</p>
                        <div class="price-action">
                            <span class="price">Rp180.000</span>
                            <button class="order-btn">Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tambahkan item menu lainnya sesuai kebutuhan -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const menuItems = document.querySelectorAll('.menu-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            button.classList.add('active');
            
            const category = button.dataset.category;
            
            // Filter menu items
            menuItems.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush