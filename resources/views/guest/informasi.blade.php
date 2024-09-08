@extends('layouts.app')
@section('title', 'Informasi')
@section('pagetitle', 'Informasi Aula')
@section('content')
    <div class="container mt-3">
        <h1 class="text-center mb-4">Informasi Pemesanan Aula</h1>
        <div class="row">
            @foreach ($aulas as $aula)
                @php
                    $images = $aula->pictures;
                    $detail = $details[$aula->nama] ?? [];
                @endphp
                <div class="col-md-4">
                    <div class="card">
                        <div id="carousel{{ Str::slug($aula->nama) }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('/' . $image->image_path) }}" class="d-block w-100 slider-img"
                                            alt="{{ $aula->nama }}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carousel{{ Str::slug($aula->nama) }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carousel{{ Str::slug($aula->nama) }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $aula->nama }}</h5>
                            <p class="card-text">Kapasitas: {{ $detail['capacity'] ?? 'N/A' }}</p>
                            <p class="card-text">Harga: {{ $detail['price'] ?? 'N/A' }}</p>
                            <p class="card-text">Fasilitas: {{ $detail['facilities'] ?? 'N/A' }}</p>
                            <p class="card-text text-danger">Biaya tambahan:
                                {{ $detail['extra_cost'] ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @endsection
