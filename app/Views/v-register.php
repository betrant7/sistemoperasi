<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Register - Page</title>
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
				<div class="card-wrapper-register">
					<div class="card card-register">
						<div class="card-body">
							<h4 class="card-title">Pendaftaran</h4>
                            <?php if(session()->getFlashdata('error')) : ?>
                            <div class="alert alert-denger alert-dismissible show fade p-0 text-center">
                                <div class="alert-body">
                                    <b>Error !</b>
                                    <?= session()->getFlashdata('error')?>
                                </div>
                            </div>
                            <?php endif ?>
                            <h6>Lengkapi data di bawah ini dengan benar!</h6>
							<form method="POST" class="my-login-validation" action="<?php echo base_url('/registerproses') ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <span><strong>Email</strong></span>
                                            <span style="color:red">*</span>
                                            <input id="email" type="text" class="form-control" name="email" value="" required placeholder="Masukkan Email">
                                        </div>
                                        <div class="form-group">
                                            <span><strong>NIM</strong></span>
                                            <span style="color:red">*</span>
                                            <input id="nim" type="number" class="form-control" name="nim" required placeholder="Masukkan Nomor Induk Mahasiswa">
                                        </div>
										<div class="form-group">
                                            <span><strong>Kelas</strong></span>
                                            <span style="color:red">*</span>
                                            <input id="kelas" type="text" class="form-control" name="kelas" placeholder="Masukkan Kelas">
                                        </div>
                                    </div>
                                    <div class="col">
										<div class="form-group">
                                            <span><strong>Nama</strong></span>
                                            <span style="color:red">*</span>
                                            <input id="namaLengkap" type="text" class="form-control" name="namaLengkap" required placeholder="Masukkan Nama">
                                        </div>
                                        <div class="form-group">
                                            <span><strong>Username</strong></span>
                                            <span style="color:red">*</span>
                                            <input id="username" type="text" class="form-control" name="username" value="" required placeholder="Masukkan Username">
                                        </div>
                                        <div class="form-group">
                                            <span><strong>Password</strong></span>
                                            <span style="color:red">*</span>
                                            <i class="fa fa-eye-slash mata" id="togglePassword" style="cursor: pointer;"></i>
                                            <input id="password" type="password" class="form-control" name="password" required placeholder="Masukkan Password">
                                        </div>
                                    </div>
                                </div>
								<hr class="mb-0">
								<div class="form-group m-0" style="text-align: end;">
									<button type="reset" class="btn btn-secondary btn-flat btn-block btn-daftar" onclick="history.back()">Batal</button>
									<button type="submit" class="btn btn-primary btn-flat btn-block btn-daftar">Daftar</button>
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