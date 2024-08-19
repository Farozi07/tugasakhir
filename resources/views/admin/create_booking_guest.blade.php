@extends('layouts.app')
@section('title', 'Tambah Booking')
@section('pagetitle', 'Tambah Booking')
@section('content')
    <div class="row">
        <div class="col-md-7 col-xl-7 mx-auto">
            <form action="{{ route('admin.store.booking.guest') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Pilih Pemesan</label> <br />
                    <select id="selectize-select2" name="name" required>
                        <option value="" selected disabled>Pilih Pemesan</option>
                        @foreach ($data as $a)
                            <option value="{{ $a->id }}">{{ $a->name }}</option>
                        @endforeach
                    </select>
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
