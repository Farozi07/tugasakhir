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
                    <input type="text" id="name" name="name"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control  @error('password') is-invalid @enderror" type="password" id="password"
                        placeholder="Enter your password" name="password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="nama_bidang">Nama Bidang</label>
                    <input type="text" id="nama_bidang" name="nama_bidang"
                        class="form-control @error('nama_bidang') is-invalid @enderror">
                    @error('nama_bidang')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"> Tambahkan Karyawan</button>
            </form>
        </div>

    </div>
@endsection
