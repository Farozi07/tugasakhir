@extends('layouts.app')
@section('title', 'Tambah Pesanan')
@section('pagetitle', 'Tambah Pemesan')
@section('content')
    <div class="row">
        <div class="col-md-4 col-xl-8 mx-auto mt-4">
            <form action="{{ route('admin.store.booking.employee') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="data" class="form-label">Pilih Pegawai:</label>
                    <select class="form-select" id="data" name="name" required>
                        <option value="" selected disabled>Pilih Pemesan</option>
                        @foreach ($data as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Start</label>
                    <input type="text" id="start-humanfd-datepicker" class="form-control" placeholder="" name="start">
                </div>
                <div class="mb-3">
                    <label class="form-label">End</label>
                    <input type="text" id="end-humanfd-datepicker" class="form-control" placeholder="" name="end">
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
                    <label class="form-label" for="keperluan">Keperluan</label>
                    <input type="text" id="keperluan" name="keperluan" value="{{ old('keperluan') }}"
                        class="form-control @error('keperluan') is-invalid @enderror">
                    @error('keperluan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"> Tambah Kegiatan</button>
            </form>
        </div>
    @endsection
