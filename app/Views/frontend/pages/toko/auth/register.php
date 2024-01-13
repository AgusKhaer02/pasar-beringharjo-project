<?= $this->extend('frontend/layouts/template'); ?>
<?= $this->section('title') ;?>
Daftar
<?= $this->endSection() ;?>


<?= $this->section('content') ;?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= base_url('assets-toko-login/images/icons/favicon.ico') ?>"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets-toko-login/vendor/bootstrap/css/bootstrap.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets-toko-login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets-toko-login/fonts/iconic/css/material-design-iconic-font.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets-toko-login/vendor/animate/animate.css') ?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets-toko-login/vendor/css-hamburgers/hamburgers.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets-toko-login/vendor/animsition/css/animsition.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets-toko-login/vendor/select2/select2.min.css') ?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets-toko-login/vendor/daterangepicker/daterangepicker.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets-toko-login/css/util.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets-toko-login/css/main.css') ?>">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url(<?= base_url('assets-toko-login/images/bg-01.jpg')?>);">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" action="<?= base_url('toko/auth/submit-register')?>" method="post">
					<span class="login100-form-title p-b-49">
						Daftar
					</span>

					<?= $this->include('frontend/layouts/message') ;?>
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Nama Toko Dibutuhkan!">
						<span class="label-input100">Nama Toko</span>
						<input class="input100" type="text" name="name" placeholder="Masukkan Nama Toko Anda">
						<span class="focus-input100" data-symbol="&#xf1d4;"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Email Dibutuhkan!">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Masukkan Email Anda">
						<span class="focus-input100" data-symbol="&#xf159;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Password Dibutuhkan">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Masukkan Password Anda">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
				
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Daftar
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
	<!--===============================================================================================-->
	<script src="<?= base_url('assets-toko-login/vendor/jquery/jquery-3.2.1.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets-toko-login/vendor/animsition/js/animsition.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets-toko-login/vendor/bootstrap/js/popper.js')?>"></script>
	<script src="<?= base_url('assets-toko-login/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets-toko-login/vendor/select2/select2.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets-toko-login/vendor/daterangepicker/moment.min.js')?>"></script>
	<script src="<?= base_url('assets-toko-login/vendor/daterangepicker/daterangepicker.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets-toko-login/vendor/countdowntime/countdowntime.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets-toko-login/js/main.js')?>"></script>

</body>
</html>
<?= $this->endSection() ;?>
