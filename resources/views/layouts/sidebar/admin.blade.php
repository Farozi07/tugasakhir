@if (Auth::user()->role->name == 'admin')
    <li>
        <a href="{{ route('admin.dashboard') }}">
            <i class="mdi mdi-view-dashboard-outline"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> Dashboard </span>
        </a>
    </li>
    <li>
        <a href="">
            <i class="fe-user-check"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> Booked </span>
        </a>
    </li>
    <li>
        <a href="">
            <i class="mdi mdi-account-alert-outline"></i>
            <span> List Pemesan </span>
        </a>
    </li>
    <li>
        <a href="">
            <i class="fe-user-plus"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> Tambah Pemesan </span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.create.employee') }}">
            <i class="fe-user-plus"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> Tambah Karyawan </span>
        </a>
    </li>
    <li>
        <a href="">
            <i class="fe-archive"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> Arsip Pemesan </span>
        </a>
    </li>
@endif
