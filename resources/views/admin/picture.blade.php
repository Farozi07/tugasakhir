@extends('layouts.app')

@section('content')
    <div class="container">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Gambar</button>

        <table id="responsive-datatable" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Aula</th>
                    <th>Gambar</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pictures as $picture)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $picture->nama_aula }}</td>
                        <td><img src="{{ asset($picture->image_path) }}" alt="{{ $picture->nama_aula }}" width="100"></td>
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $picture->id }}">Edit</button>
                            <button class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $picture->id }}">Hapus</button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $picture->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.pictures.update', $picture->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Picture</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama_aula" class="form-label">Nama Aula</label>
                                            <select class="form-select" id="nama_aula" name="nama_aula">
                                                <option value="Aula Bhinneka Tunggal Ika"
                                                    {{ $picture->nama_aula == 'Aula Bhinneka Tunggal Ika' ? 'selected' : '' }}>
                                                    Aula Bhinneka Tunggal Ika
                                                </option>
                                                <option value="Aula Garuda"
                                                    {{ $picture->nama_aula == 'Aula Garuda' ? 'selected' : '' }}>
                                                    Aula Garuda
                                                </option>
                                                <option value="Aula Akcaya"
                                                    {{ $picture->nama_aula == 'Aula Akcaya' ? 'selected' : '' }}>
                                                    Aula Akcaya
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Gambar</label>
                                            <input type="file" class="form-control" id="image" name="image"
                                                accept="image/png, image/jpeg">
                                            <img src="{{ asset($picture->image_path) }}" alt="{{ $picture->nama_aula }}"
                                                width="100" class="mt-2">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $picture->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.pictures.destroy', $picture->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Hapus Picture</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus picture ini?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.pictures.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Gambar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="example-select" class="form-label">Nama Aula</label>
                            <select class="form-select" id="example-select" name="nama_aula">
                                <option selected disabled>Pilih Aula</option>
                                <option value="Aula Bhinneka Tunggal Ika">Aula Bhinneka Tunggal Ika</option>
                                <option value="Aula Garuda">Aula Garuda</option>
                                <option value="Aula Akcaya">Aula Akcaya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="image" name="image"
                                accept="image/png, image/jpeg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
