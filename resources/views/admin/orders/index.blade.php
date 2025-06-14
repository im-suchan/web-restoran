@extends('layouts.admin')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container">
    <div class="header">
        <h1>Daftar Pesanan Masuk</h1>
        <p>Berikut adalah semua pesanan yang telah dibuat oleh pelanggan.</p>
    </div>

    {{-- Menampilkan pesan sukses setelah menghapus --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama Pelanggan</th>
                        <th>No. Meja</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                        <th style="width: 180px;">Aksi</th> {{-- Beri sedikit lebar agar tombol pas --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->table_number }}</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="actions-cell">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-action btn-view">Detail</a>
                                
                                {{-- Tombol Hapus dibungkus dalam form --}}
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada pesanan yang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .header { margin-bottom: 2rem; }
    .header h1 { font-size: 2rem; font-weight: 600; }
    .card { background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .card-body { padding: 2rem; }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 1rem; text-align: left; border-bottom: 1px solid #e2e8f0; vertical-align: middle; }
    .table thead { background-color: #f7fafc; }
    .table th { font-weight: 600; font-size: 0.875rem; text-transform: uppercase; }
    .text-center { text-align: center; }

    /* Styling untuk tombol aksi */
    .actions-cell { display: flex; gap: 0.5rem; align-items: center; }
    .btn-action { padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; color: white; font-weight: 500; border: none; cursor: pointer; font-family: inherit; font-size: 0.875rem;}
    .btn-view { background-color: #3490dc; }
    .btn-view:hover { background-color: #2779bd; }
    .btn-delete { background-color: #e53e3e; }
    .btn-delete:hover { background-color: #c53030; }

    /* Styling untuk notifikasi */
    .alert { padding: 1rem; margin-bottom: 1rem; border-radius: 8px; }
    .alert-success { background-color: #c6f6d5; color: #2f855a; }
</style>
@endpush