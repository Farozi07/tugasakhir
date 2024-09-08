@if (Auth::user()->role->name == 'admin')
    <li>
        <a href="{{ route('admin.dashboard') }}">
            <span> Dashboard </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.pictures') }}">
            <span> Upload Gambar Aula </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.list.booking') }}">
            <span> List Booking </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.list.booking.pending') }}">
            <span> List Booking Pending </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.list.booking.employee') }}">
            <span> List Kegiatan </span>
        </a>
    </li>
    <li>
    <li>
        <a href="{{ route('admin.list.booking.cancel.guest') }}">
            <span> List Permintaan Batal </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.create.guest') }}">
            <span> Tambah Pemesan </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.create.booking.guest') }}">
            <span> Tambah Booking </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.create.booking.employee') }}">
            <span> Tambah Kegiatan </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.create.employee') }}">
            <span> Tambah Karyawan </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.daftar.akun') }}">
            <span> List Akun </span>
        </a>
    </li>
@endif
