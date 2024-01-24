<?= $this->extend('backend/layouts/template') ;?>

<?= $this->section('title') ;?>
Ubah Postingan
<?= $this->endSection() ;?>


<?= $this->section('content') ;?>

    <h1 class="mt-4">Postingan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Postingan</li>
        <li class="breadcrumb-item active">Ubah Postingan</li>
    </ol>
    <!-- form -->
    <div class="row">
        <div class="col-md-12">
            <form action="/admin/posts/update" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="<?= $post['id']?>">
                <input type="hidden" name="slug" value="<?= $post['slug']?>">

                <div class="row">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="txtJudul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="txtJudul" name="title" value="<?= (old('title')) ? old('title') : $post['title'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="img" class="form-label">Gambar</label>
                            <br>
                            <img id="imgPreview" src="<?= $post['img'] ?>" alt="pic" width="150" height="100"/>
                            <br>
                            <input type="file" class="form-control" id="img" name="image">
                            
                        </div>

                        <div class="mb-3">
                            <label for="txtTags" class="form-label">Tag</label>
                            <textarea name="tags" class="form-control" cols="30" rows="3"><?= (old('tags')) ? old('tags') : $post['tags'] ?></textarea>
                            <small>*Dipisahkan dengan tanda koma (,)</small>
                        </div>
                    </div>
                    
                </div>
                
                <div class="mb-3">
                    <label for="txtContent" class="form-label">Isi Konten</label>
                    <textarea name="content" id="content" class="form-control" cols="30" rows="3"><?= (old('content')) ? old('content') : $post['content'] ?></textarea>
                </div>

                <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</button>
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

