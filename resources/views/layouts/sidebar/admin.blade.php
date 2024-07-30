@if (Auth::user()->role->name == 'admin')
    <li>
        <a href="{{ route('admin.dashboard') }}">
            <i class="mdi mdi-view-dashboard-outline"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> Dashboard </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.list.booking.guest') }}">
            <i class="fe-user-plus"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> List Booking Pemesan </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.list.booking.employee') }}">
            <i class="fe-user-plus"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> List Kegiatan </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.create.guest') }}">
            <i class="fe-user-plus"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> Tambah Pemesan </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.create.booking.guest') }}">
            <i class="fe-user-check"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> Tambah Pesanan </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.create.booking.employee') }}">
            <i class="fe-user-check"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> Tambah Kegiatan </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.create.employee') }}">
            <i class="fe-user-plus"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> Tambah Karyawan </span>
        </a>
    </li>
@endif
