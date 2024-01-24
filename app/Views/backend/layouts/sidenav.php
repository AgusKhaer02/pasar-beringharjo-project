<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Halaman Utama</div>
                <a class="nav-link <?= activePage('dashboard')?>" href="<?= base_url('admin/dashboard') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <a class="nav-link <?= activePage('posts')?>" href="<?=  base_url('admin/posts') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Posts
                </a>

                <a class="nav-link <?= activePage('denah')?>" href="<?=  base_url('admin/denah') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-map"></i></div>
                    Denah
                </a>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= session('username') ?> <br>
            <a href="<?= base_url('admin/auth/logout')?>" onclick="return confirm('Apakah anda ingin logout?')" class="btn btn-danger btn-sm"><i class="fa fa-power-off"></i> Logout</a>
        </div>
    </nav>
</div>