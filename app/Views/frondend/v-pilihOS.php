<?= $this->extend('frondend/v-template'); ?>

<?= $this->Section('content'); ?>
</div>
    <div class="container my-5 pt-4">
        <div class="card" style="border: none;">
            <div class="card-body">
                <?php if (!empty($vmData)): ?>
                    <div class="mb-4">
                        <div class="card mb-3" style="border: none;">
                            <div class="card-body">
                                <?php if($vmData['status'] == 'aktif'): ?>
                                    <iframe src="<?= $novnc_url ?>" width="100%" height="600px" frameborder="0" allow="fullscreen"></iframe>                                
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        Silakan pilih sistem operasi di bawah ini untuk membuat mesin virtual Anda.
                    </div>
                <?php endif; ?>
                <p class="mb-0 p-4 pb-0">Select OS :</p>
                <?php
                    $osList = [
                        'debian' => '/img/debian.svg',
                        'ubuntu' => '/img/ubuntu.svg',
                        'centos' => '/img/centos.svg',
                        'kalilinux' => '/img/kalilinux.svg',
                    ];
                ?>
                <div class="row mb-4 justify-content-center g-4">
                    <?php foreach ($osList as $osName => $osImage) : ?>
                        <div class="col-6 col-md-2">
                            <div class="card text-center h-100">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <img src="<?= $osImage ?>" class="w-100 mb-3" alt="<?= ucfirst($osName) ?>">
                                    <h6 class="mb-2"><?= ucfirst($osName) ?></h6>
                                    <a href="<?= base_url('pilihos/createvm/' . $osName) ?>" class="btn btn-primary mt-auto" style="width: 70%;">Pilih</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>                
            </div>
        </div>
    </div>
<?= $this->endSection(''); ?>