        <div class="container py-5 vh-100">
            <div class="row align-items-center py-5 g-5">
                <div class="col-12 col-md-6 align-items-start">
                    <img src="/img/OS.png" class="img-fluid"/>
                </div>
                <div class="col-12 col-md-6">
                    <div class="text-center text-md-end">
                        <h1 class="display-md-2 display-4 fw-bold text-dark mb-0">
                            <span class="text-primary">Selamat Datang !</span><br>
                            <h2 class=" display-6 fw-bold text-dark pb-2"><?php echo session()->get('namaLengkap') ?></h2>
                        </h1>
                        <p class="lead">
                            Website Media Pembelajaran Sistem Operasi <br> Politeknik Negeri Madiun
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5 py-3">
        <div class="row align-items-center gx-3 gy-5 py-5 my-5">
            <div class="col-12 col-md-12 col-lg-5 mt-0 mb-5">
                <img src="/img/banner2.png" class="img-fluid mx-auto d-block" alt="a man using vr gadget"/>
            </div>
            <div class="col-12 col-md-12 text-center text-lg-start col-lg-7 mt-0 mb-5">
                <h2 class="fw-bold text-primary fs-1 pb-3">Tentang Sistem Operasi</h2>
                <p class="about-text">
                    Sistem operasi adalah komponen perangkat lunak dari sebuah sistem komputer yang bertanggung
                    jawab untuk mengatur dan mengkoordinasikan aktivitas-aktivitas dan pembagian resource
                    komputer. Sistem operasi bertindak sebagai host dari program aplikasi yang berjalan di mesin.
                </p>
                <p class="about-text">
                    Sistem operasi menawarkan berbagai service bagi program aplikasi dan pengguna. Aplikasi
                    mengakses service ini melalui application programming interfaces (APIs) atau system calls. Dengan
                    menggunakan interface ini, aplikasi dapat meminta service dari sistem operasi, melewatkan
                    parameter, dan menerima hasil dari suatu operasi.
                </p>
            </div>
        </div>
    </div>

    <footer class="bg-dark mt-5">
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
                        <h5 style="color: aliceblue;">Services</h5>
                        <div class="line"></div>
                        <ul>
                            <li>
                                <a href="">AB</a>
                                <a href="">BC</a>
                                <a href="">CD</a>
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
                        <p class="mb-0 fs-6">© 2025, Team IT Politeknik Negeri Madiun</p>
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
