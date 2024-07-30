@extends('layouts.app')
@section('title', 'Daftar Booking')
@section('pagetitle', 'Daftar Booking')
@section('content')
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
                                <a href="{{ route('guest.checkout.id', ['id' => $p->id]) }}"
                                    class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
