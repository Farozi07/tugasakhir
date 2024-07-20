@extends('layouts.app')
@section('title', 'Tambah Pesanan')
@section('pagetitle', 'Tambah Pemesan')
@section('content')
    <div class="row">
        <div class="col-md-7 col-xl-7 mx-auto">
            <form action="{{ route('admin.store.booking.guest') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="data" class="form-label">Pilih Pemesan:</label>
                    <select class="form-select" id="data" name="name" required>
                        <option value="" selected disabled>Pilih Pemesan</option>
                        @foreach ($data as $a)
                            <option value="{{ $a->id }}">{{ $a->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="aula" class="form-label">Pilih Aula:</label>
                    <select class="form-select" id="aula" name="aula" required>
                        <option value="" selected disabled>Pilih Aula</option>
                        @foreach ($aula as $a)
                            <option value="{{ $a->id }}">{{ $a->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="start" class="form-label" id="start">Tanggal Mulai:</label>
                    <input type="date" class="form-control" id="start" name="start" required>
                </div>
                <div class="mb-3">
                    <label for="end" class="form-label" id="end">Tanggal Selesai:</label>
                    <input type="date" class="form-control" id="end" name="end" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="keperluan">Keperluan</label>
                    <input type="text" id="keperluan" name="keperluan" value="{{ old('keperluan') }}"
                        class="form-control @error('keperluan') is-invalid @enderror">
                    @error('keperluan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"> Tambahkan</button>
            </form>
        </div>
    </div>
@endsection
