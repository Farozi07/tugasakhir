@extends('layouts.app')
@section('title', 'Tambah Kegiatan')
@section('pagetitle', 'Tambah Kegiatan')
@section('content')
    <div class="row">
        <div class="col-md-4 col-xl-8 mx-auto mt-4">
            <form action="{{ route('admin.store.booking.employee') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Pilih Pegawai</label> <br />
                    <select id="selectize-select2" name="name" required>
                        <option value="" selected disabled>Pilih Pegawai</option>
                        @foreach ($data as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start</label>
                        <input type="text" id="start-humanfd-datepicker" class="form-control" placeholder=""
                            name="start">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">End</label>
                        <input type="text" id="end-humanfd-datepicker" class="form-control" placeholder=""
                            name="end">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pilih Aula</label> <br />
                    <select id="selectize-select" name="aula" required>
                        <option value="" selected disabled>Pilih Aula</option>
                        @foreach ($aula as $b)
                            <option value="{{ $b->id }}">{{ $b->nama }}</option>
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
