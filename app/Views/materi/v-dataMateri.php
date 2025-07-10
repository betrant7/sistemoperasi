<?= $this->extend('v-header'); ?>

<?= $this->Section('content'); ?>
    <div class="main-content">
        <div class="container-fluid">
            <h2>Data Materi</h2>
            <p class="text-primary">
                <a class="text-url" href="<?php echo base_url('/adminberanda') ?>">Beranda</a>
                > 
                <a class="text-url" href="<?php echo base_url('/datamateri') ?>">Data Materi</a>
            </p>                            
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data Materi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <a href="<?= base_url('datamateri/tambah/'); ?>" class="btn btn-primary btn-sm ml-3"><i class="fas fa-plus"></i> Tambah</a>
                        <table class="table table-striped table-hover table-bordered" id="example" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th class="w-10">No</th>
                                    <th class="w-20">Kategori Materi</th>
                                    <th class="w-40">Judul Sub Materi</th>
                                    <th class="w-10">Status</th>
                                    <th class="w-20">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($materi as $k => $item) : ?>
                                <tr>
                                    <td class="text-center"><?= $k + 1; ?></td>
                                    <td><?= $item['namaMateri']; ?></td>
                                    <td>
                                        |<?php foreach ($item['judulMateri'] as $index => $judul) : ?>
                                            <?= $judul; ?> |
                                        <?php endforeach; ?>
                                    </td>
                                    <td>
                                        <form action="<?= base_url('datamateri/updatestatus/' . $item['idMateri']) ?>" method="post">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="status" value="1" <?= ($item['status'] == 1) ? 'checked' : ''; ?> onchange="this.form.submit()">
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('datamateri/detail/' . $item['idMateri']) ?>" class="btn btn-sm btn-primary" title="Detail subMateri"><i class="fas fa-clone"></i></a>
                                        <a href="<?= base_url('datamateri/update/' . $item['idMateri']) ?>" class="btn btn-sm btn-warning" title="Update"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="<?= base_url('datamateri/delete/' . $item['idMateri']) ?>" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
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