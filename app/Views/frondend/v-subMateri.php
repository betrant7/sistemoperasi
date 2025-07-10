<?= $this->extend('frondend/v-template'); ?>

<?= $this->Section('content'); ?>
</div>
    <div class="container my-5 pt-5">
        <div class="row">
            <div class="col-4 pt-3">
                <div class="card" style="box-shadow: 0 8px 8px rgba(0,0,0,0.1); border: none;">
                    <div class="card-body" style="max-height: 100vh; overflow-y: auto; width: 100%;">
                        <?php foreach ($submateri as $k => $item) : ?>
                            <div class="submateri-content" id="submateri-<?= $k; ?>" style="<?= $k === 0 ? '' : 'display: none;' ?>">
                                <embed src="<?= base_url('materipdf/' . $item['dataMateri']); ?>" type="application/pdf" width="100%" height="600px">
                            </div>
                        <?php endforeach; ?>
                        <div class="d-flex justify-content-between mt-3">
                            <button class="btn btn-secondary me-auto" id="prevBtn" style="display: none;">Previous</button>
                            <button class="btn btn-primary ms-auto" id="nextBtn" <?= count($submateri) > 1 ? '' : 'style="display: none;"' ?>>Next</button>
                            <button class="btn btn-success" id="finishBtn" <?= count($submateri) === 1 ? '' : 'style="display: none;"' ?>>Selesai</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card" style="border: none;">
                    <div class="card-body">
                        <?php if (!empty($vmData)): ?>
                            <div class="mb-4">
                                <div class="card mb-3" style="border: none;">
                                    <div class="card-body">
                                        <?php if($vmData['status'] == 'aktif'): ?>
                                            <iframe src="<?= $novnc_url ?>" width="100%" height="600px" frameborder="0" allow="fullscreen"></iframe>                                
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                Silakan pilih sistem operasi di bawah ini untuk membuat mesin virtual Anda.
                            </div>
                        <?php endif; ?>
                        <p class="mb-0 p-4 pb-0">Select OS :</p>
                        <?php
                            $osList = [
                                'debian' => '/img/debian.svg',
                                'ubuntu' => '/img/ubuntu.svg',
                                'centos' => '/img/centos.svg',
                                'kalilinux' => '/img/kalilinux.svg',
                            ];
                        ?>
                        <div class="row mb-4 justify-content-center g-4">
                            <?php foreach ($osList as $osName => $osImage) : ?>
                                <div class="col-6 col-md-2">
                                    <div class="card text-center h-100">
                                        <div class="card-body d-flex flex-column align-items-center">
                                            <img src="<?= $osImage ?>" class="w-100 mb-3" alt="<?= ucfirst($osName) ?>">
                                            <h6 class="mb-2"><?= ucfirst($osName) ?></h6>
                                            <a href="<?= base_url('materi/cekvm/' . $osName . '/' . $idMateri) ?>" class="btn btn-primary mt-auto" style="width: 70%;">Pilih</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentIndex = 0;
        const total = <?= count($submateri); ?>;
        const idUser = <?= session()->get('idUser'); ?>;
        const idMateri = <?= $idMateri; ?>;
        const submateriList = <?= json_encode($submateri); ?>;

        // Jika hanya ada satu submateri, langsung set progres 100%
        if (total === 1) {
            const idSubMateri = submateriList[0]['idSubMateri'];
            fetch("<?= base_url('/materi/upprogres'); ?>", {
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
            
        }

        document.getElementById("prevBtn").addEventListener("click", async function() {
            // Sembunyikan submateri saat ini
            document.getElementById("submateri-" + currentIndex).style.display = "none";
            currentIndex--;
            // Tampilkan submateri sebelumnya
            document.getElementById("submateri-" + currentIndex).style.display = "block";

            // Kirim pengurangan progres ke controller
            const idSubMateri = submateriList[currentIndex]['idSubMateri'];
            try {
                const response = await fetch("<?= base_url('/materi/downprogres'); ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({
                        idUser: idUser,
                        idMateri: idMateri,
                        idSubMateri: idSubMateri,
                        decrement: true
                    })
                });
            } catch (error) {
                console.error('Error:', error);
            }

            // Atur tombol navigasi
            if (currentIndex === 0) {
                document.getElementById("prevBtn").style.display = "none";
            }

            document.getElementById("nextBtn").style.display = "inline-block";
            document.getElementById("finishBtn").style.display = "none";
        });

        document.getElementById("nextBtn").addEventListener("click", async function () {  
            // Kirim progres ke controller
            const idSubMateri = submateriList[currentIndex]['idSubMateri'];
            try {
                const response = await fetch("<?= base_url('/materi/upprogres'); ?>", {
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
<?= $this->endSection(''); ?>