@extends('layouts.app')
@section('title', 'Daftar Booking')
@section('pagetitle', 'Daftar Booking')
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
                        <th>#</th>
                        <th>Aula</th>
                        <th>Mulai</th>
                        <th>Berakhir</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $p)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $p->aula->nama }}</td>
                            <td>{{ $p->start }}</td>
                            <td>{{ $p->end }}</td>
                            <td>{{ $p->status }}</td>
                            <td>
                                <a href="{{ route('guest.checkout.id', ['id' => $p->id]) }}" class="btn btn-success">Bayar</a>

                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancelBookingModal">
                                    Batalkan Pesanan
                                </button>

                                <!-- The Modal -->
                                <div class="modal fade" id="cancelBookingModal" tabindex="-1" role="dialog"
                                    aria-labelledby="cancelBookingModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cancelBookingModalLabel">Request Booking
                                                    Cancellation</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('guest.req.cancel', $p->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="cancellation_reason">Reason for Cancellation:</label>
                                                        <textarea id="cancellation_reason" name="cancellation_reason" class="form-control" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Submit Request</button>
                                                </div>
                                                <!-- Include jQuery and Bootstrap's JS -->
                                                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
