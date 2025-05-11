    </div>
    <div class="container my-5 pt-3">
        <div class="row">
            <div class="col-md-3 my-5">
                <div class="card shadow border-0 h-100">
                    <div class="card-body">
                        <h2 class="card-title">Foto Profil</h2><hr>
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <img src="<?= base_url('/img/logo.png'); ?>" alt="Foto Profil" class="img-fluid rounded-circle w-75 mb-3 mt-3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 my-5">
                <div class="card shadow border-0 h-100">
                    <div class="table-responsive">
                        <div class="card-body">
                            <h2 class="card-title mb-3">Data Mahasiswa</h2><hr>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th width="30%" class="fs-5"><i class="bi bi-person-fill me-2"></i>Nama Lengkap</th>
                                        <td width="70%" class="fs-5">: <?= $user['namaLengkap']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="fs-5"><i class="bi bi-card-heading me-2"></i>NIM</th>
                                        <td class="fs-5">: <?= $user['nim']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="fs-5"><i class="bi bi-building me-2"></i>Kelas</th>
                                        <td class="fs-5">: <?= $user['kelas']; ?></td>
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
                        <a href="<?php echo base_url('/ubahPassword'); ?>" class="btn btn-primary"><i class="bi bi-key-fill me-2"></i>Ganti Password</a>                        
                        <a href="<?php echo base_url('/editprofil'); ?>" class="btn btn-primary"><i class="bi bi-pencil-square me-2"></i>Edit Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="/js/frondend.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>