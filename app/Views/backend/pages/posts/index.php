<?= $this->extend('backend/layouts/template') ;?>

<?= $this->section('title') ;?>
Postingan
<?= $this->endSection() ;?>

<?= $this->section('content') ;?>
    <h1 class="mt-4">Postingan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Postingan</li>
    </ol>
    
    <a href="<?= base_url('admin/posts/new-post') ?>" class="btn btn-primary btn-float">
        <h4><i class="fa fa-plus btn-content-float"></i></h4>
    </a>

    <div class="row">
        <?php foreach ($posts as $item) : ?>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?= $item['img'] ?>" class="img-fluid rounded-start" style="height:100%;width:100%;object-fit:cover;" alt="...">  
                        </div>
                        
                        <div class="col-md-8">
                            <div class="float-end m-2">
                                <a href="<?= base_url('admin/posts/update-post/' . $item['slug']) ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                
                                <form action="<?= base_url('admin/posts/delete-post/' . $item['slug']) ?>" method="post" id="delete-post-form">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger" id="btnDelete"><i class="fa fa-close"></i></button>
                                </form>
                                
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $item['title'] ?></h5>
                                <p><small><?= $item['content'] ?></small></p>
                                <small class="text-body-secondary"><i class="fa fa-user"></i> Author : <?= $item['fullname'] ?></small> <br>
                                <small class="text-body-secondary"><i class="fa fa-calendar"></i> Tanggal Post : <?= $item['created_at'] ?></small> <br>
                                <small class="text-body-secondary"><i class="fa fa-check"></i> Status : <div class="badge bg-primary"><?= $item['status'] ?></div></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?= $this->endSection() ;?>


<?= $this->section('script-js') ;?>
<script>
    $(document).ready(function(){
        $("#btnDelete").click(function (e) { 
            e.preventDefault();
            
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#delete-post-form").submit();
                }
            });   
        });     
    });
</script>
<?= $this->endSection() ;?>
