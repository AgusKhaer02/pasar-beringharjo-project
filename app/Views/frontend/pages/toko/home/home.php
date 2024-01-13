<?= $this->extend('frontend/layouts/template'); ?>


<?= $this->section('title'); ?>
Toko Saya
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<section class="h-100 gradient-custom-2">

  <div class="container py-5 h-100">
    <?= $this->include('frontend/layouts/message'); ?>
    <div class="row d-flex justify-content-center align-items-center h-100">


      <div class="col col-lg-12 col-xl-12">
        <div class="card">
          <div class="rounded-top text-white d-flex flex-row" style="background: url('https://batikkhasdaerah.com/wp-content/uploads/2022/06/Kesan-dari-batik-Jogja-dan-Solo-memiliki-perbedaan.jpg') no-repeat fixed center; background-size:cover; height:200px;">

            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
              <img src="<?= (isset($toko['img_profile'])) ? base_url('images/toko/profile/' . $toko['img_profile']) : base_url('assets/images/toko-placeholder.png'); ?>" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
              <a href="<?= base_url('toko/edit-profile') ?>" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1;">
                Ubah Profil
              </a>
            </div>


            <div class="ml-3 text-light" style="margin-top: 130px;">
              <h1 class="text-light" style="text-shadow: 2px 2px #023300;"><?= $toko['name']; ?></h1>
            </div>
          </div>

          <div class="p-4 text-black" style="background-color: #f8f9fa;">
            <div class="d-flex justify-content-end text-center py-1">
              <div>
                <p class="mb-1 h2">253</p>
                <p class="small text-muted mb-0">Produk</p>
              </div>
            </div>
          </div>
          <div class="card-body p-4 text-black">

            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0">Produk Anda</p>
              <p class="mb-0"><a href="#!" class="text-muted">Tampilkan Semua</a></p>
            </div>

            <a href="<?= base_url('toko/product/add-product') ?>" class="btn btn-primary mb-3">Tambahkan Produk Anda</a>

            <div class="row g-3">
              <?php foreach ($produk as $item) : ?>
                <div class="col-md-3 mb-2">
                  <a href="<?= base_url('toko/product/' . $item['slug']) ?>">
                    <img src="<?= base_url('images/toko/produk/' . $item['img_produk']) ?>" alt="image 1" class="w-100 rounded-3">
                    <h3><?= $item['nama']; ?></h3>
                    <h3>Rp <?= $item['harga']; ?></h3>
                    <?php if ($item['stok'] == "tersedia") : ?>
                      <h3>
                        <div class="badge badge-success">Tersedia</div>
                      </h3>
                    <?php elseif ($item['stok'] == "habis") : ?>
                      <h3>
                        <div class="badge badge-secondary">Habis</div>
                      </h3>
                    <?php endif ?>
                  </a>
                </div>
              <?php endforeach ?>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<script>
  $(document).ready(function() {
    var slideIndex = 1;
    showSlides(slideIndex);

    function showSlides(n) {
      var slides = $(".mySlides");
      var dots = $(".demo");
      var captionText = $("#caption");
      if (n > slides.length) {
        slideIndex = 1;
      }
      if (n < 1) {
        slideIndex = slides.length;
      }
      slides.hide();
      dots.removeClass("active");
      $(slides[slideIndex - 1]).show();
      $(dots[slideIndex - 1]).addClass("active");
      captionText.html($(dots[slideIndex - 1]).attr("alt"));
    }

    function plusSlides(n) {
      showSlides((slideIndex += n));
    }

    function currentSlide(n) {
      showSlides((slideIndex = n));
    }

    $(".openModalBtn").click(function() {
      $("#myModal").css("display", "block");
    });

    $(".closeModalBtn").click(function() {
      $("#myModal").css("display", "none");
    });

    $(".prev").click(function() {
      plusSlides(-1);
    });

    $(".next").click(function() {
      plusSlides(1);
    });

    $(".demo").click(function() {
      currentSlide($(this).data("slide-index"));
    });
  });
</script>

<?= $this->endSection(); ?>