<?= $this->extend('frontend/layouts/template'); ?>

<?= $this->section('title'); ?>
Detail produk
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- content -->
<section class="py-5">
    <div class="container">
        <div class="row gx-5">
            <aside class="col-lg-6">
                <div class="border rounded-4 mb-3 d-flex justify-content-center">
                    <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="<?= base_url('images/toko/produk/' . $images[0]['img']) ?>">
                        <img style="max-width: 100%; max-height: 100vh; margin: auto; object-fit:cover;" class="rounded-4" src="<?= base_url('images/toko/produk/' . $images[0]['img']) ?>" />
                    </a>
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <?php foreach ($images as $item) : ?>
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="<?= base_url('images/toko/produk/' . $item['img']) ?>" class="item-thumb">
                            <img width="60" height="60" class="rounded-2" src="<?= base_url('images/toko/produk/' . $item['img']) ?>" />
                        </a>
                    <?php endforeach ?>

                </div>
                <!-- thumbs-wrap.// -->
                <!-- gallery-wrap .end// -->
            </aside>
            <main class="col-lg-6">
                <div class="ps-lg-3">
                    <h1 class="title text-dark">
                        <?= $detail['nama']; ?>
                    </h1>
                    <div class="d-flex flex-row my-3">

                        <span class="<?= ($detail['stok'] == "tersedia") ? 'text-success' : 'text-secondary' ?> ms-2">Stok <?= $detail['stok'] ?></span>
                    </div>

                    <div class="mb-3">
                        <span class="h2">Rp <?= $detail['harga']; ?></span>
                    </div>


                    <h3>Deskripsi</h3>
                    <!-- <p>
                        
                    </p> -->    
                </div>
            </main>
        </div>
    </div>
</section>
<!-- content -->
<?= $this->endSection(); ?>