<?= $this->extend('v-header'); ?>

<?= $this->Section('content'); ?>
    <div class="main-content">
        <div class="container-fluid">
            <h2>Tambah Data Materi</h2>
            <div class="card">
                <div class="card-body">
                    <form method="POST" class="my-login-validation" action="<?php echo base_url('datamateri/tambah/tambahproses') ?>">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span><strong>Kategori Materi</strong></span>
                                    <span style="color:red">*</span>
                                    <input id="kategoriMateri" type="text" class="form-control" name="kategoriMateri" required placeholder="Masukkan Data Kategori">
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