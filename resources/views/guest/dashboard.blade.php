@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Fake Shop</h1>
                <p>Belanja online murah, aman dan nyaman dari berbagai toko online di Indonesia.</p>
            </div>
            <div class="col-md-12">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->id }}</h5>
                                    <p class="card-text">{{ $product->aula->nama }}</p>
                                    <p class="card-text">{{ $product->keperluan }}</p>
                                    <p class="card-text">{{ $product->start }}</p>
                                    <p class="card-text">{{ $product->end }}</p>
                                    <a href="{{ route('guest.product', $product['id']) }}"
                                        class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
