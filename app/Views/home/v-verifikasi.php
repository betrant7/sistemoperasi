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
						<div class="card ">
							<div class="card-body">
								<h4 class="card-title">Verifikasi Akun Google</h4>
								<?php if(session()->getFlashdata('error')) : ?>
								<div class="alert alert-denger alert-dismissible show fade p-0 text-center">
									<div class="alert-body">
										<b style="color: red;">Error !</b>
										<span style="color: red;"><?= session()->getFlashdata('error')?></span>
									</div>
								</div>
								<?php endif ?>
								<form method="POST" class="my-login-validation" action="<?php echo base_url('/verifikasi/proses') ?>">
									<div class="form-group">
										<span><strong>Email</strong></span>
										<span style="color:red">*</span>
										<input id="email" type="text" class="form-control email" name="email" value="" required placeholder="Masukkan email">
                                    </div>									
									<div class="form-group m-0">
										<button type="submit" class="btn btn-primary btn-flat btn-block btn-login">Masuk</button>
									</div>
                                    <div class="form-group m-0">
										<a class="btn btn-secondary btn-flat btn-block btn-login" href="<?php echo base_url('/login') ?>">Batal</a>
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