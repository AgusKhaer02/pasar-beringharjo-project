<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>(admin) Pasar Beringharjo</title>
        <link href="<?= base_url('backend/css/styles.css')?>" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">

                                        <center>
                                            <img src="<?= base_url('assets/images/logo.png')?>" alt="logo" width="80" height="100" >
                                            <h5 class="mt-2">Pasar Beringharjo Barat</h5>
                                        </center>
                                        
                                        <h3 class="text-center font-weight-light mb-4">Login Admin</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?= base_url('admin/auth/authenticate')?>" method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputUsername" type="username" name="username" placeholder="Username Anda..." />
                                                <label for="inputUsername">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password Anda ..." />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('backend/js/scripts.js')?>"></script>
    </body>
</html>
