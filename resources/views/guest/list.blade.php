@extends('layouts.app')
@section('title', 'Daftar Pesanan')
@section('pagetitle', 'Daftar Pesanan')
@section('content')
    @if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <table id="responsive-datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Aula</th>
                        <th>Keperluan</th>
                        <th>Mulai</th>
                        <th>Berakhir</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $p)
                        <tr>
                            <td>{{ $p->aula->nama }}</td>
                            <th>{{ $p->keperluan }}</th>
                            <td>{{ \Carbon\Carbon::parse($p->start)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->end)->format('d-m-Y') }}</td>
                            <td>{{ ucfirst($p->transaction->status) }}</td>
                            <td>
                                @if ($p->cancellation_requested == false && $p->transaction->status == 'pending')
                                    <button type="button" class="btn btn-success ms-1" data-bs-toggle="modal"
                                        data-bs-target="#bayarModal-{{ $p->id }}">
                                        Bayar Sekarang
                                    </button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light"
                                        data-bs-toggle="modal"
                                        data-bs-target="#con-close-modal-{{ $p->id }}">Batalkan
                                        Pesanan</button>
                                    <!-- bayar Account Modal -->
                                    <div class="modal fade" id="bayarModal-{{ $p->id }}" tabindex="-1"
                                        aria-labelledby="bayarModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="bayarModalLabel">Pembayaran Aula</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Anda akan melakukan pembayaran booking
                                                        <strong>{{ $p->aula->nama }}</strong> dari tanggal
                                                        {{ \Carbon\Carbon::parse($p->start)->format('d-m-Y') }} sampai
                                                        {{ \Carbon\Carbon::parse($p->end)->format('d-m-Y') }} dengan harga
                                                        <strong>Rp{{ number_format($p->transaction['price'], 0, ',', '.') }}</strong>
                                                    </p>
                                                    <p>Apakah Anda yakin ingin melanjutkan pembayaran?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-success" id="pay-button">
                                                        Bayar Sekarang
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
                                        </script>
                                        <script type="text/javascript">
                                            document.getElementById('pay-button').onclick = function() {
                                                // SnapToken acquired from previous step
                                                snap.pay('{{ $p->transaction->snap_token }}', {
                                                    // Optional
                                                    onSuccess: function(result) {
                                                        // /* You may add your own js here, this is just example */
                                                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                                        window.location.href =
                                                            '{{ route('guest.transaction.success', $p->id) }}';

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
                                    </div>
                                    <!--modal content -->
                                    <div id="con-close-modal-{{ $p->id }}" class="modal fade" tabindex="-1"
                                        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                        style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Alasan Pembatalan</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('guest.req.cancel', $p->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="field-7" class="form-label">Alasan
                                                                    Pembatalan</label>
                                                                <textarea class="form-control" id="field-7" placeholder="" name="cancellation_reason" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Submit
                                                            Request</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal -->
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
