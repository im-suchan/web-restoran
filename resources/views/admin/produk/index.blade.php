@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Data Produk</h2>
    
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="header-actions">
        <a href="{{ route('produk.create') }}" class="btn-tambah">+ Tambah Produk</a>
    </div>

    <table class="tabel-produk">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Kategori</th>
                <th>Nama Produk</th>
                <th>Detail</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $produk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($produk->foto)
                            <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                        @else
                            <span class="no-image">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>{{ $produk->category }}</td>
                    <td>{{ $produk->nama }}</td>
                    <td>{{ Str::limit($produk->detail, 50) }}</td>
                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn-ubah">Edit</a>
                            @if($produk->foto)
                                <a href="{{ asset('storage/' . $produk->foto) }}" target="_blank" class="btn-gambar">Lihat</a>
                            @endif
                            <form method="POST" action="{{ route('produk.destroy', $produk->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn-hapus" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 20px; color: #666;">
                        Belum ada data produk. <a href="{{ route('produk.create') }}">Tambah produk pertama</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
.header-actions {
    margin-bottom: 20px;
}

.btn-tambah {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 4px;
    display: inline-block;
}

.btn-tambah:hover {
    background-color: #0056b3;
}

.tabel-produk {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.tabel-produk th,
.tabel-produk td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

.tabel-produk th {
    background-color: #f8f9fa;
    font-weight: bold;
}

.tabel-produk tr:nth-child(even) {
    background-color: #f8f9fa;
}

.action-buttons {
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
}

.btn-ubah {
    background-color: #28a745;
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
    font-size: 12px;
}

.btn-ubah:hover {
    background-color: #218838;
}

.btn-gambar {
    background-color: #17a2b8;
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
    font-size: 12px;
}

.btn-gambar:hover {
    background-color: #138496;
}

.btn-hapus {
    background-color: #dc3545;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 12px;
}

.btn-hapus:hover {
    background-color: #c82333;
}

.no-image {
    color: #6c757d;
    font-style: italic;
    font-size: 12px;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

.alert ul {
    margin: 0;
    padding-left: 20px;
}
</style>
@endsection