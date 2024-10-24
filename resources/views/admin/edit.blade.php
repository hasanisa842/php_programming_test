@extends('layouts.editLayout')

@section('title')
    Edit User
@endsection

@section('name')
    {{ Auth::check() ? Auth::user()->name : 'Guest' }}
@endsection

@section('content')
<div class="container mt-3">
    <h2 class="fw-bold text-info">Edit User</h2>
   <p class="fw-bold text-secondary">Admin pusat, silahkan mengubah data tersedia disini.
    <div class="row">
        <div class="col-md-7">
            <form method="POST" action="{{ route('users.update', $users->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $users->name) }}" placeholder="Nama Lengkap">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">No KTP</label>
                    <input type="text" name="ktp" class="form-control @error('name') is-invalid @enderror"
                        placeholder="No KTP" value="{{ old('ktp', $users->ktp) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Konfirmasi Kata Sandi">
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select id="role" name="role" class="form-control">
                        <option value="">Select Role</option>
                        <option value="provinsi">Provinsi</option>
                        <option value="kabupaten">Kabupaten</option>
                        <option value="kecamatan">Kecamatan</option>
                        <option value="kelurahan">Kelurahan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <select id="location" name="location" class="form-control">
                        <option value="">Select Location</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="phone_number"
                        class="form-control @error('phone_number') is-invalid @enderror"
                        value="{{ old('phone_number', $users->phone_number) }}" placeholder="Nomor Telepon">
                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary text-white fw-bold w-100">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#role').on('change', function () {
            var selectedRole = $(this).val();

            $('#location').html('<option value="">Select Location</option>');

            if (!selectedRole) {
                return;
            }

            $.ajax({
                url: "{{ route('locations.byRole') }}",
                type: 'GET',
                data: { role: selectedRole },
                success: function (data) {
                    $.each(data, function (key, location) {
                        $('#location').append('<option value="' + location.id + '">' + location.name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
@endsection