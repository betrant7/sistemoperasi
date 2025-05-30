<?= $this->extend('v-header'); ?>

<?= $this->Section('content'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Mahasiswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($users) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Materi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($materi) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total VM Aktif</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= count($activeVMs) ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-server fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">List Virtual Mesin Aktif</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered" id="example" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Jenis VM</th>
                                        <th>Status</th>
                                        <th>Node</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($activeVMs as $k => $vm): ?>
                                        <tr>
                                            <td><?= $k + 1 ?></td>
                                            <td><?= $vm['namaLengkap'] ?></td>
                                            <td><?= $vm['jenisVM'] ?></td>
                                            <td><span class="badge bg-success"><?= $vm['status'] ?></span></td>
                                            <td><?= $vm['node'] ?></td>
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
</div>
<?= $this->endSection(''); ?>