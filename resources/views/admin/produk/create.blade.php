@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Tambah Produk Baru</h2>

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

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="form-produk" style="display: flex; gap: 30px; align-items: flex-start;">
        @csrf

        {{-- Kolom Preview Foto (Kiri) --}}
        <div class="preview-area">
            <label for="fotoInput">Preview Foto</label><br>
            <img id="fotoPreview" src="#" alt="Preview Foto" style="display:none; max-height: 200px; border: 1px solid #ccc; padding: 5px;">
            <div id="noImageText" style="width: 200px; height: 200px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; color: #666;">
                Tidak ada gambar
            </div>
        </div>

        {{-- Kolom Formulir (Kanan) --}}
        <div class="form-area" style="flex: 1;">
            <div class="form-group">
                <label for="fotoInput">Foto</label>
                <input type="file" name="foto" id="fotoInput" accept="image/*">
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item }}" {{ old('kategori') == $item ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Produk" value="{{ old('nama') }}" required>
            </div>

            <div class="form-group">
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" placeholder="Detail Produk" rows="4">{{ old('detail') }}</textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number" name="harga" id="harga" placeholder="Masukkan Harga Produk" value="{{ old('harga') }}" min="0" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-simpan">Simpan</button>
                <a href="{{ route('produk.index') }}" class="btn-kembali">Kembali</a>
            </div>
        </div>
    </form>
</div>

{{-- Script preview foto --}}
<script>
    document.getElementById('fotoInput').addEventListener('change', function(event){
        const file = event.target.files[0];
        const preview = document.getElementById('fotoPreview');
        const noImageText = document.getElementById('noImageText');
        
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
            noImageText.style.display = 'none';
        } else {
            preview.style.display = 'none';
            noImageText.style.display = 'flex';
        }
    });
</script>

<style>
.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.form-actions {
    margin-top: 20px;
}

.btn-simpan {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 10px;
}

.btn-simpan:hover {
    background-color: #218838;
}

.btn-kembali {
    background-color: #6c757d;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 4px;
}

.btn-kembali:hover {
    background-color: #5a6268;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
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