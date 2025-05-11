                <div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card shadow border-0 h-100">
                                    <div class="card-body">
                                        <h2 class="card-title">Foto Profil</h2><hr>
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <img src="<?= base_url('/img/logo.png'); ?>" alt="Foto Profil" class="img-fluid rounded-circle w-75 mb-3 mt-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card shadow border-0 h-100">
                                    <div class="table-responsive">
                                        <div class="card-body">
                                            <h2 class="card-title mb-3">Data Dosen</h2><hr>
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th width="30%" class="fs-5"><i class="bi bi-person-fill me-2"></i>Nama Lengkap</th>
                                                        <td width="70%" class="fs-5">: <?= $user['namaLengkap']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="30%" class="fs-5"><i class="bi bi-card-heading me-2"></i>NIP / NIDN</th>
                                                        <td width="70%" class="fs-5">: <?= $user['nim']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fs-5"><i class="bi bi-envelope-fill me-2"></i>Email</th>
                                                        <td class="fs-5">: <?= $user['email']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fs-5"><i class="bi bi-person-fill me-2"></i>Username</th>
                                                        <td class="fs-5">: <?= $user['username']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fs-5"><i class="bi bi-key-fill me-2"></i>Password</th>
                                                        <td class="fs-5">: <?= substr($user['password'], 0, 1) . '********' . substr($user['password'], -1); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3 mb-3">
                                        <a href="<?php echo base_url('/UbahPassword'); ?>" class="btn btn-primary"><i class="bi bi-key-fill me-2"></i>Ganti Password</a>                        
                                        <a href="<?php echo base_url('/editadminprofil'); ?>" class="btn btn-primary"><i class="bi bi-pencil-square me-2"></i>Edit Profil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div>
                            <p class="copyright d-flex justify-content-end">
                                © 2025, Politeknik Negeri Madiun
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

<script src="/js/admin.js"></script>
</body>
</html>