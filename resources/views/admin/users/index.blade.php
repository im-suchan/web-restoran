@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Data User</h4>
        <a href="#" class="btn btn-primary">+ Tambah</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Email</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    <span class="badge {{ $user->role == 'Admin' ? 'bg-purple' : 'bg-success' }}">
                        {{ $user->role }}
                    </span>
                </td>
                <td>
                    <span class="badge bg-success">{{ $user->status }}</span>
                </td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info btn-sm">Ubah</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
