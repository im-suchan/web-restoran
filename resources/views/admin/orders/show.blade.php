@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="container">
    <div class="header">
        <a href="{{ route('admin.orders.index') }}" class="back-link">&larr; Kembali ke Daftar Pesanan</a>
        <h1>Detail Pesanan #{{ $order->id }}</h1>
        <p>Dipesan oleh <strong>{{ $order->customer_name }}</strong> pada tanggal {{ $order->created_at->format('d F Y, H:i') }}</p>
    </div>

    <div class="order-layout">
        {{-- Detail Item Pesanan --}}
        <div class="card order-items">
            <div class="card-header">
                <h3>Item yang Dipesan</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Kuantitas</th>
                            <th class="text-right">Harga Satuan</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Ringkasan Pesanan --}}
        <div class="card order-summary">
            <div class="card-header">
                <h3>Ringkasan</h3>
            </div>
            <div class="card-body">
                <div class="summary-line">
                    <span>Nama Pelanggan:</span>
                    <strong>{{ $order->customer_name }}</strong>
                </div>
                <div class="summary-line">
                    <span>Nomor Meja:</span>
                    <strong>{{ $order->table_number }}</strong>
                </div>
                <div class="summary-line total-line">
                    <span>Total Pesanan:</span>
                    <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                </div>

                {{-- Tambahkan tombol aksi lain di sini jika perlu, misalnya "Cetak Struk" --}}
                <div class="actions">
                    <button class="btn-action btn-print" onclick="window.print()">Cetak Pesanan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .header { margin-bottom: 2rem; }
    .header h1 { font-size: 2rem; font-weight: 600; }
    .back-link { display: inline-block; margin-bottom: 1rem; color: #3490dc; text-decoration: none; }
    .back-link:hover { text-decoration: underline; }

    .order-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        align-items: flex-start;
    }

    .card { background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .card-header { padding: 1rem 1.5rem; border-bottom: 1px solid #e2e8f0; }
    .card-header h3 { font-size: 1.25rem; font-weight: 600; margin: 0; }
    .card-body { padding: 1.5rem; }
    
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem 0; border-bottom: 1px solid #e2e8f0; }
    .table tbody tr:last-child td { border-bottom: none; }
    .table thead th { font-weight: 600; font-size: 0.875rem; text-transform: uppercase; color: #718096; }
    
    .text-center { text-align: center; }
    .text-right { text-align: right; }

    .summary-line { display: flex; justify-content: space-between; margin-bottom: 1rem; }
    .summary-line.total-line { font-size: 1.25rem; font-weight: bold; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; }

    .actions { margin-top: 2rem; }
    .btn-action { width: 100%; text-align: center; padding: 0.75rem 1rem; border-radius: 6px; text-decoration: none; color: white; font-weight: 500; border: none; cursor: pointer; }
    .btn-print { background-color: #38c172; }
    .btn-print:hover { background-color: #2d995b; }

    @media (max-width: 992px) {
        .order-layout { grid-template-columns: 1fr; }
    }
</style>
@endpush
