@extends('layouts.app')

@section('title', 'Reservasi')

@section('content')
<div class="container">
    <div class="form-box">
        @if(session('success'))
            <div style="background: #d4edda; padding: 10px; border-radius: 6px; margin-bottom: 20px; color: #155724;">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('reservation.store') }}">
            @csrf
            <label>Nama</label>
            <input type="text" name="name" placeholder="Ketik nama kamu" required>

            <label>No HP</label>
            <input type="text" name="phone" placeholder="+62" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="email@example.com" required>

            <label>Waktu Reservasi</label>
            <input type="datetime-local" name="reservation_time" required>

            <label>Jumlah Orang</label>
            <input type="number" name="people_count" placeholder="Contoh: 4" required>

            <button type="submit">Reservasi Sekarang</button>
        </form>
    </div>

    <div>
        <img class="pizza-img" src="/images/Reservasi.PNG" alt="Pizza Girl">
    </div>
</div>
@endsection
