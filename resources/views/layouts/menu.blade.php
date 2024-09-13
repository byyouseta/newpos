<ul class="nav pcoded-inner-navbar ">
    <li class="nav-item pcoded-menu-caption">
        <label>Navigation</label>
    </li>
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link "><span class="pcoded-micon"><img
                    src="{{ asset('template/dist/assets/images/menu/performance.png') }}" alt=""></span><span
                class="pcoded-mtext">Dashboard</span></a>
    </li>
    <li class="nav-item pcoded-hasmenu">
        <a href="#!" class="nav-link "><span class="pcoded-micon"><img
                    src="{{ asset('template/dist/assets/images/menu/shopping-cart.png') }}" alt=""></span><span
                class="pcoded-mtext">Transaksi</span></a>
        <ul class="pcoded-submenu">
            <li><a href="layout-vertical.html">Penjualan</a></li>
            <li><a href="layout-vertical.html">Retur Penjualan</a></li>
            <li><a href="{{ route('pembelian_index') }}">Pembelian</a></li>
            <li><a href="layout-horizontal.html">Retur Pembelian</a></li>
        </ul>
    </li>
    <li class="nav-item pcoded-hasmenu">
        <a href="#!" class="nav-link "><span class="pcoded-micon"><img
                    src="{{ asset('template/dist/assets/images/menu/report.png') }}" alt=""></span><span
                class="pcoded-mtext">Laporan</span></a>
        <ul class="pcoded-submenu">
            <li><a href="layout-vertical.html">Laporan Penjualan</a></li>
            <li><a href="layout-vertical.html">Laporan Retur Penjualan</a></li>
            <li><a href="layout-horizontal.html">Laporan Pembelian</a></li>
            <li><a href="layout-horizontal.html">Laporan Retur Pembelian</a></li>
            <li><a href="layout-horizontal.html">Laporan Laba Rugi</a></li>
        </ul>
    </li>
    <li class="nav-item pcoded-hasmenu">
        <a href="#!" class="nav-link "><span class="pcoded-micon"><img
                    src="{{ asset('template/dist/assets/images/menu/database.png') }}" alt=""></span><span
                class="pcoded-mtext">Master</span></a>
        <ul class="pcoded-submenu">
            <li><a href="{{ route('master_barang') }}">Data Barang</a></li>
            <li><a href="{{ route('master_pelanggan') }}">Data Pelanggan</a></li>
            <li><a href="{{ route('master_supplier') }}">Data Supplier</a></li>
        </ul>
    </li>
    <li class="nav-item pcoded-hasmenu">
        <a href="#!" class="nav-link "><span class="pcoded-micon"><img
                    src="{{ asset('template/dist/assets/images/menu/configuration.png') }}" alt=""></span><span
                class="pcoded-mtext">Setting</span></a>
        <ul class="pcoded-submenu">
            <li><a href="{{ route('setting_toko') }}">Setting Toko</a></li>
            {{-- <li><a href="{{ route('setting_user') }}">Setting User</a></li> --}}
        </ul>
    </li>
</ul>
