<?= $this->extend('frondend/v-template'); ?>

<?= $this->Section('content'); ?>
</div>
    <div class="container my-5 pt-5">
        <div class="card" style="border: none;">
            <div class="card-body">
                <h3 class="text-header"><i class="fa fa-image" aria-hidden="true"></i> Materi Sistem Operasi</h3>
                <hr>
                <div class="row font-roboto">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card mb-3" style="border: none; border-radius: 0;">
                            <div class="card-body image-responsive2">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4" data-wow-duration="1.4s">
                                                    <?php foreach ($materi as $item) : ?>                                         
                                                    <div class="card mb-4">
                                                        <a class="nav-link <?= $item['status'] == 1 ? '': 'disabled'; ?>" href="<?= base_url('materi/pilih/' . $item['idMateri']) ?>">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col <?= $item['status'] == 1 ? '': 'text-secondary'; ?>">
                                                                        <?= $item['namaMateri']; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(''); ?>