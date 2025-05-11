    </div>
    <div class="container my-5 pt-5">
        <div class="card" style="border: none;">
            <div class="card-body">
                <h3 class="text-header"><i class="fa fa-image" aria-hidden="true"></i> Materi Sistem Operasi</h3>
                <hr>
                <div class="row font-roboto">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card mb-3" style="border: none; border-radius: 0;">
                            <div class="card-body image-responsive2">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4" data-wow-duration="1.4s">
                                                    <?php foreach ($materi as $item) : ?>                                         
                                                    <div class="card mb-4">
                                                        <a class="nav-link <?= $item['status'] == 1 ? '': 'disabled'; ?>" href="<?= base_url('materi/pilih/' . $item['idMateri']) ?>">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col <?= $item['status'] == 1 ? '': 'text-secondary'; ?>">
                                                                        <?= $item['namaMateri']; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <p class="fs-6">Cloud.OS memberikan kemudahan dalam mengakses berbagai sistem operasi melalui cloud. <br>
                        Digunakan sebagai media pembelajaran mata kuliah <br> sistem operasi pada prodi D3-Teknologi Informasi, Politeknik Negeri Madiun.</p>
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
                                <a href="https://www.kali.org/docs/introduction/what-is-kali-linux/" target="_blank">Kali Linux</a>
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
    <script src="/js/frondend.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>