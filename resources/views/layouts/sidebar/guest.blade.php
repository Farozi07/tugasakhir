@if (Auth::user()->role->name == 'guest')
    <li>
        <a href="{{ route('guest.dashboard') }}">
            <span> Dashboard </span>
        </a>
    </li>
    <li>
        <a href="{{ route('guest.list.booking') }}">
            <span> List Pesanan </span>
        </a>
    </li>
    <li>
        <a href="{{ route('guest.info') }}">
            <span> Informasi Pemesanan </span>
        </a>
    </li>
    <li>
        <a href="{{ route('guest.create.booking') }}">
            <span> Buat Pesanan </span>
        </a>
    </li>
    <li>
        <a href="{{ route('guest.fillData') }}">
            <span> Data Diri </span>
        </a>
    </li>
@endif
