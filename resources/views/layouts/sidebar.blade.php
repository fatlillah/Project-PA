<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{ url('dashboard') }}" class="" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-info-circle"></i>
                    <span class="nav-text">Master</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('kategori') }}">Kategori</a></li>
                    <li><a href="post-details.html">Produk</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-info-circle"></i>
                    <span class="nav-text">Pengaturan</span>
                </a>
                <ul aria-expanded="false">
                    <!-- <li><a href="">User</a></li> -->
                    <li><a href="{{ url('icon') }}">Icon</a></li>
                    <li><a href="{{ url('menu') }}">Menu</a></li>
                </ul>
            </li>
        </ul>

        <div class="copyright">
            <p><strong>Fillow Saas Admin</strong> © 2021 All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by DexignLabs</p>
        </div>
    </div>
</div>