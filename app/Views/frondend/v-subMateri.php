    </div>
    <div class="container my-5 pt-5">
        <div class="row">
            <div class="col-4 pt-3">
                <div class="card">
                    <div class="card-body">
                        <?php foreach ($submateri as $k => $item) : ?>
                            <div class="submateri-content" id="submateri-<?= $k; ?>" style="<?= $k === 0 ? '' : 'display: none;' ?>">
                                <h5><?= $item['judulMateri']; ?></h5>
                                <p><?= $item['dataMateri']; ?></p>
                            </div>
                        <?php endforeach; ?>
                        <div class="d-flex justify-content-between mt-3">
                            <button class="btn btn-secondary me-auto" id="prevBtn" style="display: none;">Previous</button>
                            <button class="btn btn-primary ms-auto"id="nextBtn" <?= count($submateri) > 1 ? '' : 'style="display: none;"' ?>>Next</button>
                            <button class="btn btn-success" id="finishBtn" style="display: none;">Selesai</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card" style="border: none;">
                    <div class="card-body">
                        <iframe 
                            src="https://203.194.112.201:8006/?console=kvm&novnc=1&vmid=100&vmname=coba&node=server&resize=scale" 
                            width="100%" 
                            height="600px" 
                            frameborder="0">
                        </iframe>
                        <p class="mb-0 p-4 pb-0">Select OS :</p>
                        <div class="row mb-4 justify-content-center">
                            <div class="col-2">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img src="/img/debian.svg" class="w-100 mb-3">
                                        <button class="btn btn-primary" style="width: 70%;">Pilih</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-2 pr-0">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img src="/img/ubuntu.svg" class="w-100 mb-3">
                                        <button class="btn btn-primary" style="width: 70%;">Pilih</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 p-0"></div>
                            <div class="col-2">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img src="/img/centos.svg" class="w-100 mb-3">
                                        <button class="btn btn-primary" style="width: 70%;">Pilih</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-2">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img src="/img/kalilinux.svg" class="w-100 mb-3">
                                        <button class="btn btn-primary" style="width: 70%;">Pilih</button>
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
                        <p class="mb-0 fs-6">© 2025, Mahasiswa Politeknik Negeri Madiun</p>
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

    <script>
        let currentIndex = 0;
        const total = <?= count($submateri); ?>;
        const idUser = <?= session()->get('idUser'); ?>;
        const idMateri = <?= $idMateri; ?>;
        const submateriList = <?= json_encode($submateri); ?>;

        document.getElementById("nextBtn").addEventListener("click", async function () {  
            // Kirim progres ke controller
            const idSubMateri = submateriList[currentIndex]['idSubMateri'];
            try {
                const response = await fetch("<?= base_url('/materi/progres'); ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({
                        idUser: idUser,
                        idMateri: idMateri,
                        idSubMateri: idSubMateri
                    })
                });

                // Tampilkan submateri berikutnya
                document.getElementById("submateri-" + currentIndex).style.display = "none";
                currentIndex++;
                document.getElementById("submateri-" + currentIndex).style.display = "block";

                // Atur tombol navigasi
                if (currentIndex > 0) {
                    document.getElementById("prevBtn").style.display = "inline-block";
                }

                if (currentIndex === total - 1) {
                    document.getElementById("nextBtn").style.display = "none";
                    document.getElementById("finishBtn").style.display = "inline-block";
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });

        document.getElementById("finishBtn").addEventListener("click", async function() {
            try {
                const response = await fetch("<?= base_url('/materi/selesai'); ?>", {
                    method: "POST", 
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({
                        idUser: idUser,
                        idMateri: idMateri
                    })
                });

                // Redirect ke halaman materi
                window.location.href = "<?= base_url('/materi'); ?>";
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>
</body>
</html>