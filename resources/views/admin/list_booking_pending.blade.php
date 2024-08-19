@extends('layouts.app')
@section('title', 'Daftar Booking Pending')
@section('pagetitle', 'Daftar Booking yang belum dibayar')
@section('content')
    <div class="row">
        <div class="col-12">
            <table id="responsive-datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Aula</th>
                        <th>Mulai</th>
                        <th>Berakhir</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($booking as $p)
                        <tr>
                            <th>{{ $p->user->name }}</th>
                            <td>{{ $p->aula->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->start)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->end)->format('d-m-Y') }}</td>
                            <td>{{ ucfirst($p->transaction->status) }}</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal-{{ $p->id }}">Hapus</button>
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal-{{ $p->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data booking ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <!-- Form to trigger deleteAkun function -->
                                                <form action="{{ route('admin.list.booking.delete', ['id' => $p->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
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
