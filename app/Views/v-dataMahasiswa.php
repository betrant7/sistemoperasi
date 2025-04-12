                <div class="main-content">
                    <div class="container-fluid">
                        <h2>Data Mahasiswa</h2>
                        <p class="text-primary">
                            <a class="text-url" href="<?php echo base_url('/adminberanda') ?>">Beranda</a>
                             > 
                             <a class="text-url" href="<?php echo base_url('/datamahasiswa') ?>">Data Mahasiswa</a>
                        </p>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Mahasiswa</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered" id="example" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-start">No</th>
                                                <th>Nama</th>
                                                <th class="text-start">NIM</th>
                                                <th>Kelas</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($user  as $k => $item) : ?>
                                            <tr>
                                                <td class="text-center"><?= $k + 1; ?></td>
                                                <td><?= $item['namaLengkap']; ?></td>
                                                <td class="text-center"><?= $item['nim']; ?></td>
                                                <td class="text-center"><?= $item['kelas']; ?></td>
                                                <td><?= $item['username']; ?></td>
                                                <td><?= $item['email']; ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('datamahasiswa/delete/' . $item['idUser']) ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus" id="hapus"><i class="fas fa-trash"></i></a>
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