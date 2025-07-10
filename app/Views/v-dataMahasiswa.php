<?= $this->extend('v-header'); ?>

<?= $this->Section('content'); ?>
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
                                    <th>Status</th>
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
                                    <td>
                                        <div class="form-check form-switch d-flex justify-content-center align-items-center"  data-toggle="tooltip" data-placement="top" title="<?= $item['status'] ?>">
                                            <input class="form-check-input" type="checkbox" <?= $item['status'] == 'aktif' ? 'checked' : ''; ?> disabled>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#deletUserModal" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus" id="hapus" onclick="setDeleteId(<?= $item['idUser'] ?>)"><i class="fas fa-trash"></i></a>
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
<?= $this->endSection(''); ?>