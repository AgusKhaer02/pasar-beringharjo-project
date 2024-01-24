<?= $this->extend('frontend/layouts/template'); ?>

<?= $this->section('title'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<style>
    .upload__box {
        
    }

    .upload__inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .upload__btn {
        display: inline-block;
        font-weight: 600;
        color: #fff;
        text-align: center;
        min-width: 116px;
        padding: 5px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid;
        background-color: #4045ba;
        border-color: #4045ba;
        border-radius: 10px;
        line-height: 26px;
        font-size: 14px;
    }

    .upload__btn:hover {
        background-color: unset;
        color: #4045ba;
        transition: all 0.3s ease;
    }

    .upload__btn p {

        color: white;
    }

    .upload__btn p:hover {

        color: #4045ba;
    }

    .upload__btn-box {
        margin-bottom: 10px;
    }

    .upload__img-wrap {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }

    .upload__img-box {
        width: 200px;
        padding: 0 10px;
        margin-bottom: 12px;
    }

    .upload__img-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
    }

    .upload__img-close:after {
        content: '\2716';
        font-size: 14px;
        color: white;
    }

    .img-bg {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        padding-bottom: 100%;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="text-center text-primary">Tambah Produk</h2>

            <!-- 
                data yang dibutuhkan
                - nama produk
                - jenis
                - foto galeri
                - harga
                - stok (tersedia/tidak)
             -->


            <form action="<?= base_url('toko/product/insert-product')?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txtNamaProduk">Nama Produk</label>
                            <input type="text" name="nama" class="form-control" id="txtNamaProduk" placeholder="Nama produk...">
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis Produk</label>
                            <select name="jenis" id="jenis" class="form-control">
                                <option value="#" selected disabled>== Pilih jenisnya ==</option>
                                <option value="sepatu">Sepatu</option>
                                <option value="baju">Baju</option>
                                <option value="dompet">Dompet</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Produk</label>
                            <input type="number" name="harga" id="actualHarga" hidden>
                            <input type="text" id="harga" class="form-control">
                        </div>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="option1" name="stok" value="tersedia" checked>
                            <label class="form-check-label mr-5" for="option1">Tersedia</label>

                            <input type="radio" class="form-check-input" id="option2" name="stok" value="habis">
                            <label class="form-check-label" for="option2">Habis</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Gambar</label>
                        <div class="upload__box">
                            <div class="upload__btn-box">
                                <label class="upload__btn">
                                    
                                    <p><i class="fas fa-image"></i> Unggah Foto Anda</p>
                                    <input type="file" name="imgProduk[]" data-max_length="20" class="upload__inputfile" multiple>
                                </label>
                            </div>
                            <div class="upload__img-wrap"></div>
                        </div>
                    </div>

                </div>


                <button class="btn btn-primary mt-5" type="submit">Tambahkan</button>
            </form>


        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {

        ImgUpload();
        /* Dengan Rupiah */
        $('#harga').on('keyup', function() {
            $(this).val(formatRupiah($(this).val(), 'Rp. '));
        });
    });

    function ImgUpload() {
        var imgWrap = "";
        var imgArray = [];

        $('.upload__inputfile').each(function() {
            $(this).on('change', function(e) {
                imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                var maxLength = $(this).data('max_length');

                var files = e.target.files;
                var filesArr = Array.from(files);
                var iterator = 0;

                filesArr.forEach(function(f, index) {

                    if (!f.type.match('image.*')) {
                        return;
                    }

                    if (imgArray.length > maxLength) {
                        return false;
                    } else {
                        var len = imgArray.filter(function(el) {
                            return el !== undefined;
                        }).length;

                        if (len > maxLength) {
                            return false;
                        } else {
                            imgArray.push(f);

                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                imgWrap.append(html);
                                iterator++;
                            };
                            reader.readAsDataURL(f);
                        }
                    }
                });
            });
        });

        $('body').on('click', ".upload__img-close", function(e) {
            var file = $(this).parent().data("file");
            imgArray = imgArray.filter(function(el) {
                return el.name !== file;
            });
            $(this).parent().parent().remove();
        });
    }

    /* Fungsi */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        $('#actualHarga').val(number_string);
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<?= $this->endSection(); ?>