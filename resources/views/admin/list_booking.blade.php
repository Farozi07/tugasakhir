@extends('layouts.app')
@section('title', 'Daftar Booking')
@section('pagetitle', 'Daftar Booking')
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
                        <th>Keperluan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($booking as $p)
                        <tr>
                            <th>{{ $p->user->name }}</th>
                            <td>{{ $p->aula->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->start)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->end)->format('d-m-Y') }}</td>
                            <td>{{ $p->keperluan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
