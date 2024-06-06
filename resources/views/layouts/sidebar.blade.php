<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{ url('/dashboard') }}" class="" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-bars"></i>
                    <span class="nav-text">Master</span>
                </a>
                <ul aria-expanded="false">
                    @if (auth()->user()->hasRole('admin'))
                    <li><a href="{{ url('kategori') }}">Kategori</a></li>
                    @endif
                    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('kasir'))
                    <li><a href="{{ url('produk') }}">Produk</a></li>
                    <li><a href="{{ url('pelanggan') }}">Pelanggan</a></li>
                    @endif
                </ul>
            </li>
        @if (auth()->user()->hasRole('admin'))
        <li><a href="{{ url('produksi') }}" class="" aria-expanded="false">
            <i class="fa fa-calculator"></i>
            <span class="nav-text">Biaya Produksi</span>
        </a>
        </li>
        @endif
       
        <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
            <i class="fa fa-shopping-cart"></i>
            <span class="nav-text">Transaksi</span>
        </a>
            <ul aria-expanded="false">
                @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('kasir'))
                <li><a href="{{ url('transaksi-penjualan/awal') }}">Penjualan</a></li>
                <li><a href="{{ url('transaksi-pemesanan/awal') }}">Pemesanan</a></li>
                @endif
            </ul>
        </li>
        <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
            <i class="fa fa-clipboard-list"></i>
            <span class="nav-text">Daftar Transaksi</span>
        </a>
        <ul aria-expanded="false">
            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('kasir'))
            <li><a href="{{ url('daftar-penjualan') }}">Penjualan</a></li>
            <li><a href="{{ url('daftar-pemesanan') }}">Pesanan</a></li>
            @endif
        </ul>
        </li>
        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('kasir'))
        <li><a href="{{ url('pengeluaran') }}" class="" aria-expanded="false">
            <i class="fas fa-credit-card"></i>
            <span class="nav-text">Pengeluaran</span>
        </a>
        </li>
        @endif
        @if (auth()->user()->hasRole('admin'))
        <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
            <i class="fa fa-chart-line"></i>
            <span class="nav-text">Laporan</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{ url('laporan') }}">Laporan Pendapatan</a></li>
        </ul>
        </li>
        @endif
    @if (auth()->user()->hasRole('admin'))
    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
        <i class="fa fa-cog"></i>
        <span class="nav-text">Pengaturan</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{ url('users') }}">User</a></li>
        {{-- <li><a href="{{ url('menu') }}">Menu</a></li> --}}
    </ul>
</li>
    @endif
</ul>
    </div>
</div>