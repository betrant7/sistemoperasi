                    <div class="main-content">
                        <div class="container-fluid">
                            <h2><?= $materi['namaMateri']; ?></h2>
                            <p class="text-primary">
                                <a class="text-url" href="<?php echo base_url('/adminberanda') ?>">Beranda</a>
                                > 
                                <a class="text-url" href="<?php echo base_url('/datamateri') ?>">Data Materi</a>
                                >
                                <a class="text-url" href="<?php echo base_url('/datasubmateri/'. $materi['idMateri']) ?>">Data Sub Materi</a>
                            </p>                            
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data Sub Materi</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <a href="<?= base_url('datasubmateri/tambah/'. $materi['idMateri']); ?>" class="btn btn-primary btn-sm ml-3"><i class="fas fa-plus"></i> Tambah</a>
                                        <table class="table table-striped table-hover table-bordered" id="example" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="w-10">No</th>
                                                    <th class="w-25">Judul Sub Materi</th>
                                                    <th class="w-50">Data Sub Materi</th>
                                                    <th class="w-15">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($submateri as $k => $item) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $k + 1 ?></td>
                                                    <td><?= $item['judulMateri']; ?></td>
                                                    <td><?= $item['dataMateri']; ?></td>
                                                    <td class="text-center">
                                                        <a href="<?= base_url('datasubmateri/update/' . $item['idSubMateri']) ?>" class="btn btn-sm btn-warning" title="Update"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="<?= base_url('datasubmateri/delete/' . $item['idSubMateri']) ?>" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
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
                                    © 2025, Team IT Politeknik Negeri Madiun
                                </p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

    <script src="/js/admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
</body>
</html>