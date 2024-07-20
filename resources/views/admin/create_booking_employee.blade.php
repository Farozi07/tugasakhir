@extends('layouts.app')
@section('title', 'Tambah Pesanan')
@section('pagetitle', 'Tambah Pemesan')
@section('content')
    <div class="row">
        <div class="col-md-4 col-xl-8 mx-auto mt-4">
            <form action="" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Bidang</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="nama_bidang" id="bidang1" value="Bidang 1"
                            required>
                        <label class="form-check-label" for="bidang1">
                            Bidang UMPAR
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="nama_bidang" id="bidang2" value="Bidang 2"
                            required>
                        <label class="form-check-label" for="bidang2">
                            Bidang SKPK
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="nama_bidang" id="bidang3" value="Bidang 3"
                            required>
                        <label class="form-check-label" for="bidang3">
                            Bidang PKT
                        </label>
                    </div>
                    <!-- Tambahkan opsi lain sesuai kebutuhan -->
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
                <div class="mb-3">
                    <label for="start" class="form-label" id="start">Tanggal Mulai:</label>
                    <input type="date" class="form-control" id="start" name="start" required>
                </div>
                <div class="mb-3">
                    <label for="end" class="form-label" id="start">Tanggal Selesai:</label>
                    <input type="date" class="form-control" id="end" name="end" required>
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
