<?= $this->extend('frondend/v-template'); ?>

<?= $this->Section('content'); ?>
        <div class="container py-5 dashboard">
            <div class="row align-items-center py-5 g-5">
                <div class="col-12 col-md-6 align-items-start">
                    <img src="/img/OS.png" class="img-fluid"/>
                </div>
                <div class="col-12 col-md-6">
                    <div class="text-center text-md-end">
                        <?php if (session()->get('namaLengkap')): ?>
                            <h1 class="display-md-2 display-4 fw-bold text-dark mb-0">
                                <span class="text-primary">Selamat Datang !</span><br>
                                <h2 class=" display-6 fw-bold text-dark pb-2"><?php echo session()->get('namaLengkap') ?></h2>
                            </h1>
                            <p class="lead">
                                Website Media Pembelajaran Sistem Operasi <br> Politeknik Negeri Madiun
                            </p>
                        <?php else: ?>
                            <h1 class="display-md-2 display-4 fw-bold text-dark mb-0">
                                <span class="text-primary">Selamat Datang !</span><br>
                                <h2 class=" display-6 fw-bold text-dark pb-2">Website Media Pembelajaran Sistem Operasi <br> Politeknik Negeri Madiun</h2>
                            </h1>
                        <?php endif; ?>
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
<?= $this->endSection(''); ?>
