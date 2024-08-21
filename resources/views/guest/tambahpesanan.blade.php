@extends('layouts.app')
@section('title', 'Buat Pesanan')
@section('pagetitle', 'Buat Pesanan')
@section('content')
    <div class="row">
        <div class="col-md-7 col-xl-7 mx-auto">
            <div id="error-message" style="display:none; color: red;"></div>
            <form action="{{ route('guest.store.booking') }}" method="POST">
                @csrf
                <div class="form-container mx-auto">
                    <div class="mb-3">
                        <label class="form-label">Pilih Aula</label> <br />
                        <select id="selectize-select" name="aula" class="required">
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
                    <button type="submit" class="btn btn-primary w-100">Tambah Booking</button>
                </div>
            </form>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="errorMessage"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
