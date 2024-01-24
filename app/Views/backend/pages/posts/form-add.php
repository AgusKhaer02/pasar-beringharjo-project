<?= $this->extend('backend/layouts/template') ;?>

<?= $this->section('title') ;?>
Ubah Postingan
<?= $this->endSection() ;?>


<?= $this->section('content') ;?>

    <h1 class="mt-4">Postingan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Postingan</li>
        <li class="breadcrumb-item active">Tambah Postingan</li>
    </ol>
    <!-- form -->
    <div class="row">
        <div class="col-md-12">
            <form action="/admin/posts/insert" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="row">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="txtJudul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="txtJudul" name="title" value="<?= old('title') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="img" class="form-label">Gambar</label>
                            <br>
                            <img id="imgPreview" src="#" alt="pic" width="150" height="100"/>
                            <br>
                            <input type="file" class="form-control" id="img" name="image">
                            
                        </div>

                        <div class="mb-3">
                            <label for="txtTags" class="form-label">Tag</label>
                            <textarea name="tags" class="form-control" cols="30" rows="3"><?= old('tags') ?></textarea>
                            <small>*Dipisahkan dengan tanda koma (,)</small>
                        </div>
                    </div>
                    
                </div>
                
                <div class="mb-3">
                    <label for="txtContent" class="form-label">Isi Konten</label>
                    <textarea name="content" id="content" class="form-control" cols="30" rows="3"><?= old('content') ?></textarea>
                </div>

                <button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> Tambah</button>
            </form>
        </div>
    </div>

<?= $this->endSection() ;?>

<?= $this->section('script-js') ;?>
<script>
    $(document).ready(function() {
        const photoInp = $("#img");
        let file;
        photoInp.change(function (e) {
            file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $("#imgPreview")
                        .attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        tinymce.init({
            selector: 'textarea#content',
        });

        if ($('.dropzone').length) {
            $("form.dropzone").dropzone({ url: "/file/post" });
            // other code here
        }
    });
</script>
<?= $this->endSection() ;?>

