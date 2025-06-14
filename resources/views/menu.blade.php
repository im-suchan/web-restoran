@extends('layouts.app')

@section('title', 'Menu Kami')

@section('content')
<div class="menu-page">
    <section class="hero-section text-center py-8 bg-yellow-100">
        <h1 class="text-4xl font-bold">Menu Lezat Kami</h1>
        <p class="text-lg text-gray-600 mt-2">Temukan berbagai pilihan makanan terbaik kami</p>
    </section>

    <div class="container-menu-makan">
        <div class="category-filter flex justify-center gap-4 mb-6">
            <a href="{{ route('menu') }}" class="filter-btn {{ request()->is('menu') && !request()->has('kategori') ? 'active' : '' }}">Semua</a>
            <a href="{{ route('menu.kategori', 'Daging') }}" class="filter-btn {{ request()->is('menu/kategori/Daging') ? 'active' : '' }}">Daging</a>
            <a href="{{ route('menu.kategori', 'Sayuran') }}" class="filter-btn {{ request()->is('menu/kategori/Sayuran') ? 'active' : '' }}">Sayuran</a>
            <a href="{{ route('menu.kategori', 'Minuman') }}" class="filter-btn {{ request()->is('menu/kategori/Minuman') ? 'active' : '' }}">Minuman</a>
        </div>

        @if($products->isEmpty())
            <div class="empty-menu text-center py-12">
                <h3 class="text-xl text-gray-600">Belum ada produk tersedia</h3>
                <p class="text-gray-500 mt-2">Silakan kembali lagi nanti</p>
            </div>
        @else
            <div class="menu-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="menu-item" data-category="{{ Str::slug($product->category, '-') }}">
                        <div class="menu-card bg-white shadow rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="menu-image">
                                @if($product->foto)
                                    <img src="{{ asset('storage/' . $product->foto) }}" 
                                         alt="{{ $product->nama }}" 
                                         class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="category-badge absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                    {{ $product->category }}
                                </div>
                            </div>
                            <div class="menu-details p-4">
                                <h3 class="text-xl font-semibold mb-2">{{ $product->nama }}</h3>
                                @if($product->detail)
                                    <p class="description text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->detail }}</p>
                                @else
                                    <p class="description text-gray-400 text-sm mb-3 italic">Tidak ada deskripsi</p>
                                @endif
                                <div class="price-action flex justify-between items-center">
                                    <span class="price text-lg font-bold text-green-600">
                                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                                    </span>
                                    <form action="{{ route('cart.add') }}" method="POST">
  @csrf
  <input type="hidden" name="product_id" value="{{ $product->id }}">
  <button type="submit" 
          class="order-btn bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded transition-colors duration-200">
    Pesan Sekarang
  </button>
</form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
.menu-image {
    position: relative;
}

.category-badge {
    z-index: 10;
}

.filter-btn {
    padding: 10px 20px;
    background-color: #f8f9fa;
    color: #333;
    text-decoration: none;
    border-radius: 25px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.filter-btn:hover {
    background-color: #e9ecef;
    transform: translateY(-2px);
}

.filter-btn.active {
    background-color: #e74a3b;
    color: white;
    border-color: #e74a3b;
}

.menu-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.menu-card:hover {
    transform: translateY(-5px);
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.container-menu-makan {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

@media (max-width: 768px) {
    .category-filter {
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .filter-btn {
        padding: 8px 16px;
        font-size: 14px;
    }
    
    .menu-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}
</style>
@endsection