<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Kodinger">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Login - Page</title>
		<link rel="icon" href="/img/ikon.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="/css/signin.css">
	</head>
	<body class="my-page">
		<section>
			<div class="container">
				<div class="row justify-content-md-center">
					<div class="card-wrapper">
						<div class="brand mb-3">
							<img src="/img/logo.png" alt="">
						</div>
						<div class="card ">
							<div class="card-body">
								<h4 class="card-title">Masuk dan Verifikasi</h4>
								<?php if(session()->getFlashdata('error')) : ?>
								<div class="alert alert-denger alert-dismissible show fade p-0 text-center">
									<div class="alert-body">
										<b>Error !</b>
										<?= session()->getFlashdata('error')?>
									</div>
								</div>
								<?php endif ?>
								<form method="POST" class="my-login-validation" action="<?php echo base_url('/loginproses') ?>">
									<div class="form-group">
										<span><strong>Email/akun pengguna</strong></span>
										<span style="color:red">*</span>
										<input id="email" type="text" class="form-control email" name="email" value="" required placeholder="Masukkan email/NIM/NIP/username yang terdaftar">
									</div>
									<div class="form-group password-container">
										<span><strong>Password</strong></span>
										<span style="color:red">*</span>
										<input id="password" type="password" class="form-control password" name="password" required placeholder="Masukkan Password">
										<i class="fa fa-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
										<a class="reset" href="">Lupa Password?</a>
									</div>
									<div class="form-group m-0">
										<button type="submit" class="btn btn-primary btn-flat btn-block btn-login">Masuk</button>
									</div>
									<div class="mt-1 mb-4 text-center">
										Belum Punya Akun? <a class="register" href="<?php echo base_url('register') ?>">Daftar</a>
									</div>
									<div class="mx-3 my-2 py-2 bordert">
										<div class="mt-3 google">
											<a href="<?= $link; ?>" class="btn btn-default btn-block btn-google">
												<img src="https://quantum.sevima.com/assets/images/logo-google.svg" alt=""> Masuk dengan Google
											</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<script src="/js/java.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
	</body>
</html>