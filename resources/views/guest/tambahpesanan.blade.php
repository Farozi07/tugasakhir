@extends('layouts.app')
@section('title', 'Tambah Pesanan')
@section('pagetitle', 'Tambah Pesanan')
@section('content')
    <div class="row">
        <div class="col-md-7 col-xl-7 mx-auto">
            <form action="{{ route('guest.store.booking') }}" method="POST">
                @csrf
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
                    <label class="form-label">Start</label>
                    <input type="text" id="start-humanfd-datepicker" class="form-control" placeholder="" name="start">
                </div>
                <div class="mb-3">
                    <label class="form-label">End</label>
                    <input type="text" id="end-humanfd-datepicker" class="form-control" placeholder="" name="end">
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
