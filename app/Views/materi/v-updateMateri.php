<div class="main-content">
                    <div class="container-fluid">
                        <h2>Update Data Materi</h2>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" class="my-login-validation" action="<?php echo base_url('datamateri/update/updateproses') ?>">
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" name="idMateri" value="<?= $materi['idMateri']; ?>">
                                            <div class="form-group">
                                                <span><strong>Kategori Materi</strong></span>
                                                <span style="color:red">*</span>
                                                <input id="kategoriMateri" type="text" class="form-control" name="kategoriMateri" required placeholder="Masukkan Data Kategori" value="<?= $materi['namaMateri']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mb-3">
                                    <div class="form-group m-0" style="text-align: end;">
                                        <button type="reset" class="btn btn-secondary btn-flat btn-block btn-daftar" onclick="history.back()">Batal</button>
                                        <button type="submit" class="btn btn-primary btn-flat btn-block btn-daftar">Update</button>
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
</body>
</html>