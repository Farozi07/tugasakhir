@extends('layouts.app')
@section('title', 'Daftar Pemesan')
@section('pagetitle', 'Daftar Pemesan')
@section('content')
    <div class="row">
        <div class="col-12">
            <table id="responsive-datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $p)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $p->user->name }}</td>
                            <td>{{ $p->status }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#detail-{{ $p->id }}">Detail</button>
                                <!-- Standard modal content -->
                                <div id="detail-{{ $p->id }}" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="standard-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">Detail Pemesan</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><b>Nama Penanggung Jawab :</b> {{ $p->user->employee->penanggung_jawab }}
                                                </p>
                                                <p><b>Bidang :</b> {{ $p->user->employee->nama_bidang }}</p>
                                                <p><b>Mulai :</b> {{ $p->start }}</p>
                                                <p><b>Selesai :</b> {{ $p->end }}</p>
                                                <p><b>Keperluan :</b> {{ $p->keperluan }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-success">Terima</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->


                                    <!-- Bootstrap 4 requires Popper.js and Bootstrap.js -->
                                    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
                                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
