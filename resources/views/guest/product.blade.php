@extends('layouts.app')

@section('title', 'Detail')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('guest.dashboard') }}" class="btn btn-primary">Kembali</a>
            <div class="row mt-3">
                <div class="col-md-8">
                    <h1>{{ $product->id }}</h1>
                    <h1>{{ $product->aula->nama }}</h1>
                    <p>{{ $product->aula->deskripsi }}</p>
                    {{-- <p>Rp{{ number_format($product['price'], 0, ',', '.') }}</p> --}}
                    <form action="{{ route('guest.checkout-process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="product_id" value="{{ $product->end }}">
                        <input type="hidden" name="price" value="{{ $product['price'] }}">
                        @auth
                            <button type="submit" class="btn btn-primary">Beli Sekarang</button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Login untuk membeli</a>
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
