<?= $this->extend('v-header'); ?>

<?= $this->Section('content'); ?>
<div class="main-content">
    <div class="container-fluid">
        <h2>Detail Sub Materi</h2>
        <p class="text-primary">
            <a class="text-url" href="<?= base_url('/adminberanda') ?>">Beranda</a>
            >
            <a class="text-url" href="<?= base_url('/datamateri') ?>">Data Materi</a>
            >
            <a class="text-url" href="<?= base_url('/datasubmateri/' . $materi['idMateri']) ?>">Data Sub Materi</a>
            >
            Detail Sub Materi
        </p>
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Detail Sub Materi</h6>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Judul Sub Materi</dt>
                    <dd class="col-sm-9"><?= esc($subMateri['judulMateri']) ?></dd>
                    <dt class="col-sm-3">Materi Induk</dt>
                    <dd class="col-sm-9"><?= esc($materi['namaMateri']) ?></dd>
                    <dt class="col-sm-3">Isi Sub Materi</dt>
                    <dd class="col-sm-9">
                        <?php if (pathinfo($subMateri['dataMateri'], PATHINFO_EXTENSION) === 'pdf') : ?>
                            <a href="<?= base_url('materipdf/' . $subMateri['dataMateri']) ?>" target="_blank" class="btn btn-primary btn-sm mb-2">Download PDF</a>
                            <br>
                            <iframe src="<?= base_url('materipdf/' . $subMateri['dataMateri']) ?>" width="100%" height="600px" style="border:1px solid #eee;"></iframe>
                        <?php else : ?>
                            <div style="white-space: pre-wrap; border:1px solid #eee; padding:10px; background:#fafafa; border-radius:4px;">
                                <?= esc($subMateri['dataMateri']) ?>
                            </div>
                        <?php endif; ?>
                    </dd>
                </dl>
                <a href="<?= base_url('datasubmateri/' . $materi['idMateri']) ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(''); ?> 