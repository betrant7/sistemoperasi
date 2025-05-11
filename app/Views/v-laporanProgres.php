                <div class="main-content">
                    <div class="container-fluid">
                        <h2>Laporan Progres Mahasiswa</h2>
                        <p class="text-primary">
                            <a class="text-url" href="<?php echo base_url('/adminberanda') ?>">Beranda</a>
                             > 
                             <a class="text-url" href="<?php echo base_url('/laporan') ?>">Laporan Progres Mahasiswa</a>
                        </p>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Data Laporan Progres Mahasiswa</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered" id="example" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="w-5">No</th>
                                                <th class="w-30">Nama</th>
                                                <th class="w-10">Kelas</th>
                                                <th class="w-15">Materi</th>
                                                <th class="w-10">Waktu Mulai</th>
                                                <th class="w-10">Waktu Selesai</th>
                                                <th class="w-30">Progres</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($progres as $k => $item) : ?>
                                            <tr>
                                                <td class="text-center"><?= $k + 1; ?></td>
                                                <td><?= esc($item['namaLengkap']); ?></td>
                                                <td class="text-center"><?= esc($item['kelas']); ?></td>
                                                <td>
                                                    <select class="form-select materi-select" data-user="<?= esc($item['idUser']); ?>">
                                                        <?php foreach ($materiList as $materi) : ?>
                                                            <option value="<?= esc($materi['idMateri']); ?>" <?= ($materi['idMateri'] == $item['idMateri']) ? 'selected' : ''; ?>>
                                                                <?= esc($materi['namaMateri']); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>                                        
                                                <td class="text-center waktu-mulai-<?= esc($item['idUser']); ?>"><?= esc($item['waktuMulai']); ?></td>
                                                <td class="text-center waktu-selesai-<?= esc($item['idUser']); ?>"><?= esc($item['waktuSelesai']); ?></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success progres-bar-<?= esc($item['idUser']); ?>" role="progressbar" style="width: <?= esc($item['progres']); ?>%;" aria-valuenow="<?= esc($item['progres']); ?>" aria-valuemin="0" aria-valuemax="100">
                                                            <?= esc($item['progres']); ?>%
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

    <!-- JavaScript -->
    <script src="/js/admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        
            $('.materi-select').on('change', function () {
                const idUser = $(this).data('user');
                const idMateri = $(this).val();
                const $progressBar = $('.progres-bar-' + idUser);
                const $waktuMulai = $('.waktu-mulai-' + idUser);
                const $waktuSelesai = $('.waktu-selesai-' + idUser);

                fetch("<?= base_url('/laporan/getprogres'); ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        idUser: idUser,
                        idMateri: idMateri
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const progres = data.progres || 0;
                    $progressBar.css('width', progres + '%');
                    $progressBar.attr('aria-valuenow', progres);
                    $progressBar.text(progres + '%');
                    
                    // Update waktu mulai dan selesai
                    $waktuMulai.text(data.waktuMulai || '-');
                    $waktuSelesai.text(data.waktuSelesai || '-');
                })
                .catch(error => {
                    console.error('Gagal mengambil progres:', error);
                });
            });
        });
    </script>

</body>
</html>