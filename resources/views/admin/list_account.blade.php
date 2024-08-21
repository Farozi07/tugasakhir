@extends('layouts.app')
@section('title', 'Daftar Akun')
@section('pagetitle', 'Daftar Akun')
@section('content')
    <div class="row">
        <div class="col-12">
            <table id="responsive-datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $p)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->role->display_name }}</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal-{{ $p->id }}">
                                    Delete Account
                                </button>
                                <button type="button" class="btn btn-warning ms-1" data-bs-toggle="modal"
                                    data-bs-target="#editModal-{{ $p->id }}">
                                    Edit Akun
                                </button>

                                <!-- Edit Account Modal -->
                                <div class="modal fade" id="editModal-{{ $p->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Account</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Checking Role and Displaying the Appropriate Form -->
                                                <form action="{{ route('admin.edit.akun') }}" method="POST"
                                                    id="update-{{ $p->id }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $p->id }}">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" value="{{ $p->name }}">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" value="{{ $p->email }}">
                                                        </div>
                                                        <div class="col-md-6 mb-1">
                                                            <label for="password" class="form-label">Password</label>
                                                            <input type="password" class="form-control" id="password"
                                                                name="password" value="">
                                                            <span class="badge bg-danger mt-1">Abaikan jika tidak ingin
                                                                mengubah
                                                                password</span>
                                                        </div>
                                                    </div>

                                                    @if ($p->guest)
                                                        <div class="mb-3">
                                                            <label for="no_ktp" class="form-label">No KTP</label>
                                                            <input type="text" class="form-control" id="no_ktp"
                                                                name="no_ktp" value="{{ $p->guest->no_ktp }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="telp">No Telp</label>
                                                            <input type="text" id="telp" name="telp"
                                                                value="{{ $p->guest->telp }}" class="form-control"
                                                                id="telp">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="alamat">Alamat</label>
                                                            <textarea name="alamat" id="alamat" cols="6" rows="3" class="form-control">{{ $p->guest->alamat }}</textarea>
                                                        </div>
                                                    @elseif($p->employee)
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="nama_bidang" class="form-label">Nama
                                                                    Bidang</label>
                                                                <input type="nama_bidang" class="form-control"
                                                                    id="nama_bidang" name="nama_bidang"
                                                                    value="{{ $p->employee->nama_bidang }}">
                                                            </div>
                                                        </div>
                                                    @endif
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="button"
                                                    onclick="document.getElementById('update-{{ $p->id }}').submit();"
                                                    class="btn btn-warning">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                                Apakah anda yakin ingin menghapus akun dengan nama
                                                <b>{{ $p->name }}</b>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <!-- Form to trigger deleteAkun function -->
                                                <form action="{{ route('admin.hapus.akun', ['id' => $p->id]) }}"
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
