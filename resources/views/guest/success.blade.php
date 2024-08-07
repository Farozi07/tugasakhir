@extends('layouts.app')

@section('title', 'Checkout Berhasil')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                <h1 class="text-success">Pembayaran Berhasil</h1>
                <p class="text-success">Terima kasih telah melakukan pembayaran</p>
                <a href="{{ route('guest.list.booking') }}" class="btn btn-primary mt-3">Kembali ke Daftar Booking</a>
            </div>
        </div>
    </div>
@endsection
