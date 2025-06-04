@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')
<div class="container">
    <section class="contact-section">
        <h1 class="section-title">Saran dan Kritik</h1>

        {{-- Pesan sukses --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Menampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <div class="contact-form">
                <h2>Kirim Pesan</h2>
                <form action="{{ route('kontak.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                        @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="subjek" placeholder="Subjek" value="{{ old('subjek') }}" required>
                        @error('subjek')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea name="pesan" rows="5" placeholder="Pesan Anda" required>{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="submit-btn">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </section>

    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.85421431537024!3d-6.194741662247247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4256c5e3b9d%3A0x8e6f7d2d5e0d4c5b!2sBSI%20Bekasi!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid" 
            width="100%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>
</div>
@endsection


@push('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush
