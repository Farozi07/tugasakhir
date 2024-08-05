@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-xl-6 mx-auto">
                <h2>Lengkapi Data Profil Anda</h2>
                <form action="{{ route('guest.saveData') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="no_ktp" class="form-label">No KTP</label>
                        <input type="text" id="no_ktp" name="no_ktp" value="{{ old('no_ktp', $guest->no_ktp) }}"
                            class="form-control @error('no_ktp') is-invalid @enderror">
                        @error('no_ktp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="telp">No Telp</label>
                        <input type="text" id="telp" name="telp" value="{{ old('telp', $guest->telp) }}"
                            class="form-control @error('telp') is-invalid @enderror">
                        @error('telp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control">{{ old('alamat', $guest->alamat) }}</textarea>
                        @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
