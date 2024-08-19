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
                                @if ($p->status == true)
                                    <!-- Jika status true, tampilkan button bayar -->
                                @elseif ($p->status == false)
                                    <!-- Jika status false, tampilkan button batalkan pesanan -->
                                    <a href="{{ route('guest.checkout.id', ['id' => $p->id]) }}"
                                        class="btn btn-success">Bayar</a>
                                @endif
                                @if ($p->cancellation_requested == false && $p->transaction->status == 'pending')
                                    <button type="button" class="btn btn-danger waves-effect waves-light"
                                        data-bs-toggle="modal" data-bs-target="#con-close-modal">Batalkan Pesanan</button>
                                    <!-- sample modal content -->
                                    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
