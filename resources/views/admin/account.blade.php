@extends('layouts.admin')

@section('content')
<div class="dashboard-content">
    <h2>Manajemen Akun Admin</h2>

    <div class="account-info">
        <h3>Informasi Akun</h3>
        <p><strong>Nama:</strong> {{ Auth::guard('admin')->user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::guard('admin')->user()->email }}</p>
    </div>

    <div class="account-actions">
        <h3>Ubah Password</h3>
        <form action="{{ route('admin.password.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="current_password">Password Lama:</label>
                <input type="password" name="current_password" id="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Password Baru:</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>
            <div class="form-group">
                <label for="new_password_confirmation">Konfirmasi Password Baru:</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required>
            </div>
            <button type="submit" class="save-btn">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
