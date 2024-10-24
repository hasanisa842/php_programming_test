@extends('layouts.editLayout')

@section('title')
    All Users
@endsection

@section('name')
    {{ Auth::check() ? Auth::user()->name : 'Guest' }}
@endsection

@section('content')
<div class="container mt-3">
    <h2 class="fw-bold text-info">User List</h2>
    <p class="fw-bold text-secondary">Admin pusat, anda bisa melihat user website disini.
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('users.create') }}" class="btn btn-primary fw-bold text-white mb-3">Add User</a>
        </div>
        <div class="col-md-3">
            <form action="{{ route('users.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Cari User Disini"
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>
            @if(request('search'))
                <a href="{{ route('users.index') }}" class="btn btn-primary mt-2">Kembali</a>
            @endif
        </div>
    </div>

    <p class="fw-bold text-secondary">Daftar user saat ini:</p>
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">KTP</th>
                        <th scope="col">Role</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->ktp }}</td>
                            <td>
                                {{ $user->is_admin == 2 ? 'Admin Provinsi' : ($user->is_admin == 3 ? 'Admin Kabupaten' : ($user->is_admin == 4 ? 'Admin Kecamatan' : ($user->is_admin == 5 ? 'Admin Kelurahan' : 'User'))) }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="btn btn-primary fw-bold text-white btn-sm">Ubah</a>
                                <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-primary fw-bold text-white btn-sm">
                                    @method('delete')
                                    @csrf
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
<div class="d-flex justify-content-center">
    {{ $users->links('pagination::bootstrap-4') }}
</div>
        </div>
    </div>
</div>
@endsection