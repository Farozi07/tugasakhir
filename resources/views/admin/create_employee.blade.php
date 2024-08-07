@extends('layouts.app')
@section('title', 'Tambah Pegawai')
@section('pagetitle', 'Tambah Pegawai')
@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-6 mx-auto">
            <form action="{{ route('admin.store.employee') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" type="password" required="" id="password"
                        placeholder="Enter your password" name="password">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nama_bidang">Nama Bidang</label>
                    <input type="text" id="nama_bidang" name="nama_bidang" value="{{ old('nama_bidang') }}"
                        class="form-control @error('nama_bidang') is-invalid @enderror">
                    @error('nama_bidang')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="penanggung_jawab">Penanggung Jawab</label>
                    <input type="text" id="penanggung_jawab" name="penanggung_jawab"
                        value="{{ old('penanggung_jawab') }}"
                        class="form-control @error('penanggung_jawab') is-invalid @enderror">
                    @error('penanggung_jawab')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"> Tambahkan User</button>
            </form>
        </div>

    </div>
@endsection
