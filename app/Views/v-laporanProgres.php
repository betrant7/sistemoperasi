                <div class="main-content">
                    <div class="container-fluid">
                        <h2>Laporan Progres Mahasiswa</h2>
                        <p>Berikut adalah laporan progres pembelajaran mahasiswa:</p>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
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
                                                <th class="w-30">Progres</th>
                                                <th class="w-10">Aksi</th>
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
                                                            <option value="<?= esc($materi['idMateri']); ?>" <?= ($materi['idMateri'] == $item['idMateri']) ? 'selected' : ''; ?> data-progres="<?= esc($item['progres']); ?>">
                                                                <?= esc($materi['namaMateri']); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success progres-bar-<?= esc($item['idUser']); ?>" role="progressbar" style="width: <?= esc($item['progres']); ?>%;" aria-valuenow="<?= esc($item['progres']); ?>" aria-valuemin="0" aria-valuemax="100">
                                                            <?= esc($item['progres']); ?>%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('datamahasiswa/delete/' . esc($item['idUser'])); ?>" class="btn btn-sm btn-danger hapus-mahasiswa" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
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
                                &copy; 2025 Mahasiswa IT
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();

            // Event listener untuk mengganti progres saat materi berubah
            $('.materi-select').on('change', function () {
                let userId = $(this).data('user');
                let selectedOption = $(this).find(':selected');
                let newProgress = selectedOption.data('progres');

                // Update tampilan progress bar
                let progressBar = $('.progres-bar-' + userId);
                progressBar.css('width', newProgress + '%').attr('aria-valuenow', newProgress);
                progressBar.text(newProgress + '%');

                // Kirim perubahan progres ke backend
                $.ajax({
                    url: "<?= base_url('laporan/updateProgres') ?>",
                    type: "POST",
                    data: {
                        idUser: userId,
                        idMateri: selectedOption.val(),
                        idSubMateri: 1 // Sesuaikan dengan logika perhitungan sub-materi
                    },
                    success: function(response) {
                        console.log("Progres diperbarui:", response);
                    }
                });
            });
        });
    </script>

</body>
</html>