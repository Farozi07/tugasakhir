@extends('layouts.app')
@section('title', 'Tambah Pemesan')
@section('pagetitle', 'Tambah Pemesan')
@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-6 mx-auto">
            <form action="{{ route('admin.store.guest') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="no_ktp" class="form-label">No KTP</label>
                        <input type="text" id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}"
                            class="form-control @error('no_ktp') is-invalid @enderror">
                        @error('no_ktp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="telp">No Telp</label>
                        <input type="text" id="telp" name="telp" value="{{ old('telp') }}"
                            class="form-control @error('telp') is-invalid @enderror">
                        @error('telp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="20" rows="5" class="form-control"></textarea>
                    @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    @endsection
