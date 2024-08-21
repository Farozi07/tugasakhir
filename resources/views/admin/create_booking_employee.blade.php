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
                    <select id="selectize-select2" name="name">
                        <option value="" selected disabled>Pilih Pegawai</option>
                        @foreach ($data as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Pilih Aula</label> <br />
                    <select id="selectize-select" name="aula">
                        <option value="" selected disabled>Pilih Aula</option>
                        @foreach ($aula as $b)
                            <option value="{{ $b->id }}">{{ $b->nama }}</option>
                        @endforeach
                    </select>
                    @error('aula')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mulai</label>
                        <input type="text" id="disable-datepicker-start" class="form-control" placeholder=""
                            name="start">
                        @error('start')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Berakhir</label>
                        <input type="text" id="disable-datepicker-end" class="form-control" placeholder=""
                            name="end">
                        @error('end')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="keperluan">Keperluan</label>
                    <input type="text" id="keperluan" name="keperluan" value="{{ old('keperluan') }}"
                        class="form-control @error('keperluan') is-invalid @enderror">
                    @error('keperluan')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"> Tambah Kegiatan</button>
            </form>
        </div>
    @endsection
