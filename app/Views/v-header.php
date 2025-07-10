<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Beranda</title>
    <link rel="icon" href="/img/ikon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/css/admin.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
</head>
<body>
    <div id="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><img src="/img/ikon.png" class="img-fluid"/><span>Cloud.Os</span></h3>
            </div>
            <ul class="list-unstyled components">
                <li class="<?= (strpos(uri_string(), 'adminberanda') !== false) ? 'active' : '' ?>">
                    <a href="<?php echo base_url('adminberanda') ?>">
                        <i class="fa fa-home"></i>
                        <span>Beranda</span>
                    </a>
                </li>               
                <li class="<?= (strpos(uri_string(), 'datamahasiswa') !== false) ? 'active' : '' ?>">
                    <a href="<?php echo base_url('datamahasiswa') ?>">
                        <i class="fa fa-users"></i>
                        <span>Data Mahasiswa</span>
                    </a>
                </li>
                <li class="<?= (strpos(uri_string(), 'datamateri') !== false || strpos(uri_string(), 'datasubmateri') !== false) ? 'active' : '' ?>">
                    <a href="<?php echo base_url('datamateri') ?>">
                        <i class="fa fa-layer-group"></i>
                        <span>Data Materi</span>
                    </a>
                </li>
                <li class="<?= (strpos(uri_string(), 'laporan') !== false) ? 'active' : '' ?>">
                    <a href="<?php echo base_url('laporan') ?>">
                        <i class="fa fa-clipboard-list"></i>
                        <span>Laporan Pembelajaran</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <ul>
                    <li>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="fa fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>                
        </nav>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="top-navbar" id="top">
                    <nav class="navbar navbar-expand-lg" id="navbar">
                        <div class="container-fluid">        
                            <button type="button" id="sidebarCollapse" class="">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="d-flex align-items-center">
                                <span class="text-black small me-2">
                                    Hallo, <?php echo session()->get('namaLengkap') ?>
                                </span>
                                <a href="<?php echo base_url('/adminprofil')?>"><img src="/img/logo.png" alt="Profile Image" class="rounded-circle" width="40" height="40"></a>
                            </div>
                        </div>
                    </nav>
                </div>

            <?= $this->renderSection('content'); ?>
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
                    <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo base_url('logout') ?>'">Logout</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletUserModal" tabindex="-1" aria-labelledby="deletUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletUserModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Menghapus User Mahasiswa Akan Menghilangkan Seluruh datanya, Apakah Anda Yakin?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    
</body>
</html>
