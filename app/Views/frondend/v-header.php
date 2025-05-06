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
    <link rel="stylesheet" href="/css/style.css"/>
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
                            <a class="nav-link" href="<?php echo base_url('beranda') ?>">Beranda</a>
                        </li>
                        <li class="nav-item ms-0 ms-md-3">
                            <?php if (session()->get('idUser')): ?>
                                <?php if (session()->get('isDataComplete')): ?>
                                    <a class="nav-link" href="<?= base_url('pilihos') ?>">Pilihan OS</a>
                                <?php else: ?>
                                    <a class="nav-link" href="<?= base_url('lengkapidata?redirect=pilihos') ?>" onclick="alert('Silakan lengkapi data Anda terlebih dahulu!')">Pilih OS</a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a class="nav-link" href="<?= base_url('login') ?>" onclick="alert('Silakan login terlebih dahulu!')">Pilih OS</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item ms-0 ms-md-3">
                            <?php if (session()->get('idUser')): ?>
                                <?php if (session()->get('isDataComplete')): ?>
                                    <a class="nav-link" href="<?= base_url('materi') ?>">Materi</a>
                                <?php else: ?>
                                    <a class="nav-link" href="<?= base_url('lengkapidata?redirect=materi') ?>" onclick="alert('Silakan lengkapi data Anda terlebih dahulu!')">Materi</a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a class="nav-link" href="<?= base_url('login') ?>" onclick="alert('Silakan login terlebih dahulu!')">Materi</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item dropdown ms-0 ms-md-3">
                            <?php if (session()->get('idUser')): ?>
                                <a class="nav-link" href="<?= base_url('frondend/logout') ?>">Logout</a>
                            <?php else: ?>
                                <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>