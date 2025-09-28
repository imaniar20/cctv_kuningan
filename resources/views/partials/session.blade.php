@php
    if ($menu != 'Pengguna') {
        session()->forget(['username', 'name', 'level']);
    }

    if ($menu != 'Ref. SKPD') {
        session()->forget(['nameperangkatdaerah']);
    }
@endphp