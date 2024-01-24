<?= $this->extend('frontend/layouts/template') ;?>

<?= $this->section('title') ;?>
Galeri
<?= $this->endSection() ;?>



<?= $this->section('content') ;?>
<section class="gallery-block compact-gallery">
    <div class="container">
        <div class="heading">
            <h2>Galeri Pasar</h2>
        </div>
        <div class="row no-gutters">
            <div class="col-md-6 col-lg-4 item zoom-on-hover">
                <a class="lightbox" href="https://www.yogyes.com/id/yogyakarta-tourism-object/shopping/beringharjo/1.jpg">
                    <img class="img-fluid image" src="https://www.yogyes.com/id/yogyakarta-tourism-object/shopping/beringharjo/1.jpg">
                    <span class="description">
                        <span class="description-heading">Lorem Ipsum</span>
                        <span class="description-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ;?>
