@if (Auth::user()->role->name == 'guest')
    <li>
        <a href="{{ route('guest.dashboard') }}">
            <i class="mdi mdi-view-dashboard-outline"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> Dashboard </span>
        </a>
    </li>
    <li>
        <a href="{{ route('guest.fillData') }}">
            <i class="fe-user-plus"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> Edit Profil </span>
        </a>
    </li>
    <li>
        <a href="{{ route('guest.list.booking') }}">
            <i class="fe-user-check"></i>
            {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
            <span> List Pesanan </span>
        </a>
    </li>
    <li>
        <a href="{{ route('guest.create.booking') }}">
            <i class="mdi mdi-account-alert-outline"></i>
            <span> Buat Pesanan </span>
        </a>
    </li>
@endif
