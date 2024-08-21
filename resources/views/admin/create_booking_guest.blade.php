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
                    <select id="selectize-select2" name="name">
                        <option value="" selected disabled>Pilih Pemesan</option>
                        @foreach ($data as $a)
                            <option value="{{ $a->id }}">{{ $a->name }}</option>
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
                <button type="submit" class="btn btn-primary"> Tambahkan</button>
            </form>
        </div>
    </div>
@endsection
