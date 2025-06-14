@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="cart-container">
    <h1 class="cart-title">Keranjang Belanja Anda</h1>

    @if (session('success'))
        <div class="cart-alert cart-alert-success">
            {{ session('success') }}
        </div>
    @endif
     @if (session('error'))
        <div class="cart-alert cart-alert-danger"> {{-- Anda mungkin perlu menambahkan style untuk alert-danger --}}
            {{ session('error') }}
        </div>
    @endif

    @if(empty($cart))
        <div class="cart-empty">
            <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-cart-4085814-3385483.png" alt="Keranjang Kosong" class="empty-cart-img">
            <h2>Keranjang Anda masih kosong 😢</h2>
            <p>Sepertinya Anda belum menambahkan apapun ke keranjang.</p>
            <a href="{{ route('menu') }}" class="cart-btn cart-btn-primary">
                Lihat Menu
            </a>
        </div>
    @else
        <div class="cart-layout">
            {{-- Daftar Item Keranjang --}}
            <div class="cart-items-list">
                @php $total = 0; @endphp
                @foreach ($cart as $id => $item)
                    @php 
                        $subtotal = $item['harga'] * $item['qty']; 
                        $total += $subtotal; 
                    @endphp
                    <div class="cart-item">
                        @if(isset($item['foto_url']) && $item['foto_url'])
                            <img src="{{ $item['foto_url'] }}" alt="{{ $item['nama'] }}" class="cart-item-img">
                        @elseif(isset($item['foto']) && $item['foto'])
                            <img src="{{ asset('storage/' . $item['foto']) }}" alt="{{ $item['nama'] }}" class="cart-item-img">
                        @else
                            <img src="https://placehold.co/100x100/f0f0f0/333?text=Produk" alt="{{ $item['nama'] }}" class="cart-item-img">
                        @endif
                        <div class="cart-item-details">
                            <span class="cart-item-name">{{ $item['nama'] }}</span>
                            <span class="cart-item-price">Rp {{ number_format($item['harga'], 0, ',', '.') }}</span>
                            
                            <!-- FORM UNTUK UPDATE KUANTITAS -->
                            <form method="POST" action="{{ route('cart.update') }}" class="cart-quantity-control">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                
                                {{-- Tombol Kurang --}}
                                <button type="button" class="cart-quantity-btn minus" onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.dispatchEvent(new Event('change'));">-</button>
                                
                                <input 
                                    type="number" 
                                    name="quantity"
                                    class="cart-quantity-input" 
                                    value="{{ $item['qty'] }}" 
                                    min="1"
                                    onchange="this.form.submit()"
                                >
                                
                                {{-- Tombol Tambah --}}
                                <button type="button" class="cart-quantity-btn plus" onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.dispatchEvent(new Event('change'));">+</button>
                            </form>
                        </div>
                        <div class="cart-item-subtotal">
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            
                            <!-- FORM UNTUK HAPUS ITEM -->
                            <form method="POST" action="{{ route('cart.remove') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="cart-remove-item-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm-1.115 1.25a.5.5 0 0 1 .5.5v7.5a.5.5 0 0 1-1 0v-7.5a.5.5 0 0 1 .5-.5M8.5 4.75a.5.5 0 0 1 .5.5v7.5a.5.5 0 0 1-1 0v-7.5a.5.5 0 0 1 .5-.5m-2.5 0a.5.5 0 0 1 .5.5v7.5a.5.5 0 0 1-1 0v-7.5a.5.5 0 0 1 .5-.5"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Ringkasan Pesanan --}}
            <div class="cart-order-summary">
                <h3 class="cart-summary-title">Ringkasan Pesanan</h3>
                <div class="cart-summary-line">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="cart-summary-line">
                    <span>Biaya Layanan</span>
                    <span>Rp 2.000</span>
                </div>
                <div class="cart-summary-total">
                    <span>Total</span>
                    <span>Rp {{ number_format($total + 2000, 0, ',', '.') }}</span>
                </div>
                <button onclick="showCheckoutAlert({{ json_encode($cart) }}, {{ $total }})" class="cart-btn cart-btn-checkout">
                    Lanjutkan ke Checkout
                </button>
                <a href="{{ route('menu') }}" class="cart-back-to-menu">
                    &larr; Kembali ke Menu
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Modal Form Checkout -->
<div id="checkoutModal" class="cart-modal-overlay">
    <div class="cart-modal-content">
        <button onclick="toggleModal()" class="cart-modal-close-btn">&times;</button>
        <h2 class="cart-modal-title">Form Checkout</h2>
        <p class="cart-modal-subtitle">Lengkapi data diri Anda untuk melanjutkan proses.</p>
        <form action="{{ route('checkout.proses') }}" method="POST" class="cart-modal-form">
            @csrf
            <div class="cart-form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" required class="cart-form-input" placeholder="Masukkan nama Anda" />
            </div>
            <div class="cart-form-group">
                <label for="telepon">Nomor Meja</label>
                <input type="text" name="telepon" id="telepon" required class="cart-form-input" placeholder="Contoh: 14" />
            </div>
            <div class="cart-modal-actions">
                <button type="button" onclick="toggleModal()" class="cart-btn cart-btn-secondary">Batal</button>
                <button type="submit" class="cart-btn cart-btn-primary">Proses Pesanan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showCheckoutAlert(cart, total) {
        // Buat detail pesanan untuk alert
        let orderDetails = "DETAIL PESANAN ANDA:\n\n";
        
        // Loop through cart items
        Object.keys(cart).forEach(function(id) {
            const item = cart[id];
            const subtotal = item.harga * item.qty;
            orderDetails += `• ${item.nama}\n`;
            orderDetails += `  Qty: ${item.qty} x Rp ${item.harga.toLocaleString('id-ID')}\n`;
            orderDetails += `  Subtotal: Rp ${subtotal.toLocaleString('id-ID')}\n\n`;
        });
        
        orderDetails += `Subtotal: Rp ${total.toLocaleString('id-ID')}\n`;
        orderDetails += `Biaya Layanan: Rp 2.000\n`;
        orderDetails += `TOTAL: Rp ${(total + 2000).toLocaleString('id-ID')}\n\n`;
        orderDetails += "Apakah Anda yakin ingin melanjutkan ke checkout?";
        
        // Tampilkan alert dengan detail pesanan
        if (confirm(orderDetails)) {
            // Jika user mengklik OK, buka modal checkout
            toggleModal();
        }
        // Jika user mengklik Cancel, tidak ada aksi (tetap di halaman cart)
    }

    function toggleModal() {
        const modal = document.getElementById('checkoutModal');
        modal.classList.toggle('show');
    }
</script>
@endsection