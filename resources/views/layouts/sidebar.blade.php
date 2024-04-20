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
                @endif
            </ul>
        </li>
        <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
            <i class="fa fa-sort"></i>
            <span class="nav-text">Transaksi</span>
        </a>
        <ul aria-expanded="false">
            @if (auth()->user()->hasRole('admin'))
            <li><a href="{{ url('produksi') }}">Biaya Produksi</a></li>
            @endif
            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('kasir'))
            <li><a href="{{ url('pengeluaran') }}">Pengeluaran</a></li>
            @endif
            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('kasir'))
            <li><a href="{{ url('penjualan') }}">Penjualan</a></li>
            <li><a href="{{ url('pemesanan') }}">Pemesanan</a></li>
            @endif
        </ul>
    </li>
    @if (auth()->user()->hasRole('admin'))
    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
        <i class="fa fa-cogs"></i>
        <span class="nav-text">Pengaturan</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{ url('user') }}">User</a></li>
        {{-- <li><a href="{{ url('menu') }}">Menu</a></li> --}}
    </ul>
    @endif
</li>
</ul>
    </div>
</div>