<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cloud.OS</title>
    <link rel="icon" href="/img/ikon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style.css" />
    <script>const baseUrl = "<?= base_url() ?>";</script>
</head>

<body>
    <div class="head-section d-flex">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container container-nav">
                <a class="navbar-brand fw-bold" href="#">Cloud.OS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item ms-0 ms-md-3">
                            <?php if (session()->get('idUser')): ?>
                                <a class="nav-link" href="<?php echo base_url('beranda') ?>">Beranda</a>
                            <?php else: ?>
                                <a class="nav-link" href="<?php echo base_url('/') ?>">Beranda</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item ms-0 ms-md-3">
                            <?php if (session()->get('idUser')): ?>
                                <?php if (session()->get('isDataComplete')): ?>
                                    <a class="nav-link" href="<?= base_url('pilihos') ?>">Pilih OS</a>
                                <?php else: ?>
                                    <a class="nav-link" href="<?= base_url('lengkapidata?redirect=pilihos') ?>"
                                        data-toast="lengkapi-data">Pilih OS</a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a class="nav-link" href="<?= base_url('login') ?>" data-toast="login-dulu">Pilih OS</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item ms-0 ms-md-3">
                            <?php if (session()->get('idUser')): ?>
                                <?php if (session()->get('isDataComplete')): ?>
                                    <a class="nav-link" href="<?= base_url('materi') ?>">Materi</a>
                                <?php else: ?>
                                    <a class="nav-link" href="<?= base_url('lengkapidata?redirect=materi') ?>"
                                        data-toast="lengkapi-data">Materi</a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a class="nav-link" href="<?= base_url('login') ?>" data-toast="login-dulu">Materi</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item dropdown ms-0 ms-md-3">
                            <?php if (session()->get('idUser')): ?>
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Akun
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="<?= base_url('profil') ?>">Profil</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#logoutModal">Logout</a></li>
                                </ul>
                            <?php else: ?>
                                <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?= $this->renderSection('content'); ?>

        <footer class="bg-dark">
            <div class="footer-top">
                <div class="container p-0 mb-4">
                    <div class="row gy-5">
                        <div class="col-lg-4 col-sm-6">
                            <a class="text-white d-flex" href="<?php echo base_url('/beranda') ?>">
                                <img style="width: 25px; height: 25px;" src="/img/ikon.png" alt="">
                                <h5 style="padding-left: 5px;">Clous.OS</h5>
                            </a>
                            <div class="line mt-1 mb-3"></div>
                            <p class="fs-6">Cloud.OS memberikan kemudahan dalam mengakses berbagai sistem operasi
                                melalui cloud. <br>
                                Digunakan sebagai media pembelajaran mata kuliah <br> sistem operasi pada prodi
                                D3-Teknologi Informasi, Politeknik Negeri Madiun.</p>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <h5 class="pb-1" style="color: aliceblue;">Sistem Operasi</h5>
                            <div class="line mt-1 mb-3"></div>
                            <p class="fs-6 mb-2">Beberapa sistem operasi yang digunakan :</p>
                            <ul class="text-white">
                                <li>
                                    <a href="https://www.debian.org/intro/about" target="_blank">Debian</a>
                                </li>
                                <li>
                                    <a href="https://ubuntu.com/about" terget="_blank">Ubuntu</a>
                                </li>
                                <li>
                                    <a href="https://www.centos.org/about/" target="_blank">CentOs</a>
                                </li>
                                <li>
                                    <a href="https://www.kali.org/docs/introduction/what-is-kali-linux/"
                                        target="_blank">Kali Linux</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <h5 class="pb-1" style="color: aliceblue;">Fitur Utama</h5>
                            <div class="line mt-1 mb-3"></div>
                            <ul class="text-white">
                                <li>
                                    <a href="<?php echo base_url('/pilihos') ?>">Pilih OS</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('/materi') ?>">Materi Pembelajaran</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom border-top border-secondary border-opacity-50">
                <div class="container p-0">
                    <div class="row justify-content-between">
                        <div class="col-12">
                            <p class="mb-0 fs-6">© 2025, Politeknik Negeri Madiun</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Login & Lengkapi Data Modal -->
        <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="actionModalLabel">Pemberitahuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="modalMessage">Pesan akan muncul di sini.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <a id="modalAction" href="#" class="btn btn-primary">Take action</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin logout?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary"
                            onclick="window.location.href='<?php echo base_url('logout') ?>'">Logout</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="/js/frondend.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>