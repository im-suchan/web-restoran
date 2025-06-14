@extends('layouts.app')

@section('title', 'Laporan Reservasi')

@section('content')
<div class="container">
    <h1>Laporan Reservasi</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="reservation-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Waktu Reservasi</th>
                    <th>Jumlah Orang</th>
                    <th>Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $index => $reservation)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $reservation->name }}</td>
                    <td>{{ $reservation->phone }}</td>
                    <td>{{ $reservation->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('d M Y H:i') }}</td>
                    <td>{{ $reservation->people_count }}</td>
                    <td>{{ $reservation->created_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection