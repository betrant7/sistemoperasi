<?= $this->extend('v-header'); ?>

<?= $this->Section('content'); ?>
    <div class="main-content">
        <div class="container-fluid">
            <h2>Tambah Data Sub Materi</h2>
            <div class="card">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" class="my-login-validation" action="<?php echo base_url('datasubmateri/tambah/tambahproses') ?>">
                        <div class="row">
                            <div class="col">
                            <input type="hidden" name="idMateri" value="<?= $idMateri; ?>">
                                <div class="form-group">
                                    <span><strong>Judul Materi</strong></span>
                                    <span style="color:red">*</span>
                                    <input id="judulMateri" type="text" class="form-control" name="judulMateri" required placeholder="Masukkan Data Kategori">
                                </div>
                                <div class="form-group">
                                    <span><strong>Data Materi</strong></span>
                                    <span style="color:red">*</span>
                                    <input class="form-control" type="file" id="dataMateri" name="dataMateri" multiple>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">
                        <div class="form-group m-0" style="text-align: end;">
                            <button type="reset" class="btn btn-secondary btn-flat btn-block btn-daftar" onclick="history.back()">Batal</button>
                            <button type="submit" class="btn btn-primary btn-flat btn-block btn-daftar">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(''); ?>