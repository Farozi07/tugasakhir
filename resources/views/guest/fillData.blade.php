@extends('layouts.app')
@section('title', 'Profile')
@section('pagetitle', 'Edit Profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xl-6 mx-auto">
                <h2>Edit Data Profil Anda</h2>
                <form action="{{ route('guest.saveData') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $guest->user->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $guest->user->email }}" readonly>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            <span class="badge bg-danger mt-1">Abaikan jika tidak ingin mengubah password</span>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="no_ktp" class="form-label">No KTP</label>
                            <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp"
                                name="no_ktp" value="{{ old('no_ktp', $guest->no_ktp) }}">
                            @error('no_ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="telp">No Telp</label>
                            <input type="text" id="telp" name="telp" value="{{ old('telp', $guest->telp) }}"
                                class="form-control @error('telp') is-invalid @enderror">
                            @error('telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="6" rows="4"
                            class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $guest->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
