<?= $this->extend('v-header'); ?>

<?= $this->Section('content'); ?>
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
<?= $this->endSection(''); ?>