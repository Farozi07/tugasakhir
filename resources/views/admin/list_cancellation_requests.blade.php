@extends('layouts.app')
@section('title', 'Daftar Permintaan Batal')
@section('pagetitle', 'Daftar Permintaan Batal')
@section('content')
    <div class="row">
        <div class="col-12">
            <table id="responsive-datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Aula</th>
                        <th>Mulai</th>
                        <th>Berakhir</th>
                        <th>Alasan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $p)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $p->user->name }}</td>
                            <td>{{ $p->aula->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->start)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->end)->format('d M Y') }}</td>
                            <td>{{ $p->cancellation_reason }}</td>
                            <td>
                                <form action="{{ route('admin.processCancellation', $p->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" name="action" value="approve"
                                        class="btn btn-success">Approve</button>
                                    <button type="submit" name="action" value="deny"
                                        class="btn btn-danger">Deny</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
