@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Produk</h2>

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

    <form action="{{ route('produk.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="form-produk" style="display: flex; gap: 30px; align-items: flex-start;">
        @csrf
        @method('PUT')

        {{-- Kolom Preview Foto (Kiri) --}}
        <div class="preview-area">
            <label for="fotoInput">Preview Foto</label><br>
            <img id="fotoPreview" 
                 src="{{ $product->foto ? asset('storage/' . $product->foto) : '#' }}" 
                 alt="Preview Foto" 
                 class="foto-preview {{ $product->foto ? 'show' : 'hide' }}">
            <div id="noImageText" class="no-image-placeholder {{ $product->foto ? 'hide' : 'show' }}">
                Tidak ada gambar
            </div>
            @if($product->foto)
                <div style="margin-top: 10px;">
                    <small>Foto saat ini: {{ basename($product->foto) }}</small>
                </div>
            @endif
        </div>

        {{-- Kolom Formulir (Kanan) --}}
        <div class="form-area" style="flex: 1;">
            <div class="form-group">
                <label for="fotoInput">Foto Baru (Opsional)</label>
                <input type="file" name="foto" id="fotoInput" accept="image/*">
                <small style="color: #666;">Biarkan kosong jika tidak ingin mengubah foto</small>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item }}" {{ (old('kategori', $product->category) == $item) ? 'selected' : '' }}>
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Produk" value="{{ old('nama', $product->nama) }}" required>
            </div>

            <div class="form-group">
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" placeholder="Detail Produk" rows="4">{{ old('detail', $product->detail) }}</textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number" name="harga" id="harga" placeholder="Masukkan Harga Produk" value="{{ old('harga', $product->harga) }}" min="0" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-simpan">Update</button>
                <a href="{{ route('produk.index') }}" class="btn-kembali">Kembali</a>
            </div>
        </div>
    </form>
</div>

{{-- Hidden data for JavaScript --}}
<div id="photoData" 
     data-has-photo="{{ $product->foto ? 'true' : 'false' }}" 
     data-photo-url="{{ $product->foto ? asset('storage/' . $product->foto) : '' }}" 
     style="display: none;">
</div>

{{-- Script preview foto --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get data from hidden div
        const photoData = document.getElementById('photoData');
        const hasExistingPhoto = photoData.getAttribute('data-has-photo') === 'true';
        const existingPhotoUrl = photoData.getAttribute('data-photo-url');
        
        document.getElementById('fotoInput').addEventListener('change', function(event){
            const file = event.target.files[0];
            const preview = document.getElementById('fotoPreview');
            const noImageText = document.getElementById('noImageText');
            
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hide');
                preview.classList.add('show');
                noImageText.classList.remove('show');
                noImageText.classList.add('hide');
            } else {
                // Jika tidak ada file baru, kembali ke foto asli atau no image
                if (hasExistingPhoto) {
                    preview.src = existingPhotoUrl;
                    preview.classList.remove('hide');
                    preview.classList.add('show');
                    noImageText.classList.remove('show');
                    noImageText.classList.add('hide');
                } else {
                    preview.classList.remove('show');
                    preview.classList.add('hide');
                    noImageText.classList.remove('hide');
                    noImageText.classList.add('show');
                }
            }
        });
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

.form-group small {
    display: block;
    margin-top: 5px;
    font-size: 12px;
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

.preview-area small {
    color: #666;
    font-size: 11px;
}

/* Fixed CSS classes for image preview */
.foto-preview {
    max-height: 200px;
    border: 1px solid #ccc;
    padding: 5px;
}

.foto-preview.show {
    display: block;
}

.foto-preview.hide {
    display: none;
}

.no-image-placeholder {
    width: 200px;
    height: 200px;
    border: 1px solid #ccc;
    align-items: center;
    justify-content: center;
    color: #666;
}

.no-image-placeholder.show {
    display: flex;
}

.no-image-placeholder.hide {
    display: none;
}
</style>
@endsection