<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cloud.OS</title>
    <link rel="icon" href="/img/ikon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style.css"/>
    <script>const baseUrl = "<?= base_url() ?>";</script>
</head>
<body>
    <div class="head-section d-flex">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container container-nav">
                <a class="navbar-brand fw-bold" href="#">Cloud.OS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                                    <a class="nav-link" href="<?= base_url('pilihos') ?>">Pilihan OS</a>
                                <?php else: ?>
                                    <a class="nav-link" href="<?= base_url('lengkapidata?redirect=pilihos') ?>" data-toast="lengkapi-data">Pilih OS</a>
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
                                    <a class="nav-link" href="<?= base_url('lengkapidata?redirect=materi') ?>" data-toast="lengkapi-data">Materi</a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a class="nav-link" href="<?= base_url('login') ?>" data-toast="login-dulu">Materi</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item dropdown ms-0 ms-md-3">
                            <?php if (session()->get('idUser')): ?>
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Akun
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="<?= base_url('profil') ?>">Profil</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('frondend/logout') ?>">Logout</a></li>
                                </ul>
                            <?php else: ?>
                                <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>