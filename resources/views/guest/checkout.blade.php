@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="card shadow-lg border-0">
        <div class="card-body text-center">
            <h3 class="card-title mb-4">Pembayaran Booking Aula</h3>
            <p class="card-text mb-3 font-20">
                Anda akan melakukan pembayaran booking <strong>{{ $bookings->aula->nama }}</strong> dengan harga
                <strong>Rp{{ number_format($bookings->transaction['price'], 0, ',', '.') }}</strong>
            </p>
            <button type="button" class="btn btn-primary btn-lg mt-3" id="pay-button">
                Bayar Sekarang
            </button>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $bookings->transaction->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    // /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    window.location.href =
                        '{{ route('guest.transaction.success', $bookings->id) }}';

                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endsection
