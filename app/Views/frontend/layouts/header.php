<header class="navigation">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light px-0">
            <a class="navbar-brand order-1 py-0 d-flex align-items-center" href="<?= base_url('/') ?>">
                <img loading="prelaod" decoding="async" class="img-fluid mr-2" src="<?= base_url('assets/images/logo.png') ?>" width="50" height="50" alt="Logo DI Yogyakarta"><h4>Pasar Beringharjo</h4>
            </a>
            <div class="navbar-actions order-3 ml-0 ml-md-4">
                <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navigation"> <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <!-- <form action="#!" class="search order-lg-3 order-md-2 order-3 ml-auto">
                <input id="search-query" name="s" type="search" placeholder="Search..." autocomplete="off">
            </form> -->

            <a href="<?= base_url('/toko/auth/login') ?>" class="btn btn-outline-success order-lg-3 order-md-2 order-3">Toko Saya</a>
            
            <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
                <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('/') ?>">Home</a>
                    </li>
                   
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('/gallery') ?>">Galeri</a>
                    </li>

                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('/info') ?>">Info Selengkapnya</a>
                    </li>

                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('/denah') ?>">Denah Pasar</a>
                    </li>
                    <!-- <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Home
                        </a>
                        <div class="dropdown-menu"> <a class="dropdown-item" href="travel.html">Travel</a>
                            <a class="dropdown-item" href="travel.html">Lifestyle</a>
                            <a class="dropdown-item" href="travel.html">Cruises</a>
                        </div>
                    </li> -->
                </ul>
            </div>
        </nav>
    </div>
</header>