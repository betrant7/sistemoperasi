<div class="main-content">
                    <div class="container-fluid">
                        <h2>Tambah Data Sub Materi</h2>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" class="my-login-validation" action="<?php echo base_url('datasubmateri/tambah/tambahproses') ?>">
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
                                                <textarea id="dataMateri" type="text" class="form-control" name="dataMateri" required placeholder="Masukkan Data Kategori"></textarea>
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

    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'dataMateri' );
    </script>
</body>
</html>