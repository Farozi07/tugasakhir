@extends('layouts.app')
@section('title', 'Informasi')
@section('pagetitle', 'Informasi Aula')
@section('content')
    <div class="container mt-3">
        <h1 class="text-center mb-4">Informasi Pemesanan Aula</h1>
        <div class="row">
            <!-- Aula Bhinneka Tunggal Ika -->
            <div class="col-md-4">
                <div class="card">
                    <div id="carouselAulaBhinneka" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="path_to_your_image1.jpg" class="d-block w-100 slider-img" alt="Aula Bhinneka">
                            </div>
                            <div class="carousel-item">
                                <img src="path_to_your_image2.jpg" class="d-block w-100 slider-img" alt="Aula Bhinneka">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAulaBhinneka"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselAulaBhinneka"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Aula Bhinneka Tunggal Ika</h5>
                        <p class="card-text">Kapasitas: 100 orang</p>
                        <p class="card-text">Harga: Rp 3.000.000 per hari (maks. 8 jam)</p>
                        <p class="card-text">Fasilitas: Kursi rangka stainless/jok busa, sound system,
                            AC, meja panggung, proyektor + layar, whiteboard.</p>
                        <p class="card-text text-danger">Biaya tambahan: Rp 250.000 per jam untuk
                            setiap kelebihan waktu.</p>
                    </div>
                </div>
            </div>

            <!-- Aula Garuda -->
            <div class="col-md-4">
                <div class="card">
                    <div id="carouselAulaGaruda" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="path_to_your_image3.jpg" class="d-block w-100 slider-img" alt="Aula Garuda">
                            </div>
                            <div class="carousel-item">
                                <img src="path_to_your_image4.jpg" class="d-block w-100 slider-img" alt="Aula Garuda">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAulaGaruda"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselAulaGaruda"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Aula Garuda</h5>
                        <p class="card-text">Kapasitas: 150 orang</p>
                        <p class="card-text">Harga: Rp 3.000.000 per hari (maks. 8 jam)</p>
                        <p class="card-text">Fasilitas: Kursi rangka stainless/jok busa, sound system,
                            AC, meja panggung, proyektor + layar, whiteboard.</p>
                        <p class="card-text text-danger">Biaya tambahan: Rp 250.000 per jam untuk
                            setiap kelebihan waktu.</p>
                    </div>
                </div>
            </div>

            <!-- Aula Akcaya -->
            <div class="col-md-4">
                <div class="card">
                    <div id="carouselAulaAkcaya" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="path_to_your_image5.jpg" class="d-block w-100 slider-img" alt="Aula Akcaya">
                            </div>
                            <div class="carousel-item">
                                <img src="path_to_your_image6.jpg" class="d-block w-100 slider-img" alt="Aula Akcaya">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAulaAkcaya"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselAulaAkcaya"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Aula Akcaya</h5>
                        <p class="card-text">Kapasitas: 40 orang</p>
                        <p class="card-text">Harga: Rp 3.000.000 per hari (maks. 8 jam)</p>
                        <p class="card-text">Fasilitas: Meja dan kursi rapat berhadapan, sound system,
                            AC, meja panggung, proyektor + layar, whiteboard.</p>
                        <p class="card-text text-danger">Biaya tambahan: Rp 250.000 per jam untuk
                            setiap kelebihan waktu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
