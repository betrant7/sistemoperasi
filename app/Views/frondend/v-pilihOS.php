    </div>
    <div class="container my-5 pt-4">
        <div class="card" style="border: none;">
            <div class="card-body">
                <?php if (!empty($vmData)): ?>
                    <div class="mb-4">
                        <h5>Virtual Machine Status:</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Basic Information</h6>
                                        <p class="mb-1">VM ID: <?= $vmData['idVmProxmox'] ?></p>
                                        <p class="mb-1">Status: <span class="badge <?= $vmData['status'] == 'aktif' ? 'bg-success' : 'bg-danger' ?>"><?= ucfirst($vmData['status']) ?></span></p>
                                        <p class="mb-1">Node: <?= $vmData['node'] ?></p>
                                        <p class="mb-1">OS Type: <?= ucfirst($vmData['jenisVM']) ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($vmDetails)): ?>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Resource Usage</h6>
                                        <p class="mb-1">CPU Usage: <?= number_format($vmDetails['cpu'] ?? 0, 2) ?>%</p>
                                        <p class="mb-1">Memory Usage: <?= number_format(($vmDetails['mem'] ?? 0) / 1024 / 1024, 2) ?> GB</p>
                                        <p class="mb-1">Disk Usage: <?= number_format(($vmDetails['disk'] ?? 0) / 1024 / 1024, 2) ?> GB</p>
                                        <p class="mb-1">Uptime: <?= isset($vmDetails['uptime']) ? gmdate("H:i:s", $vmDetails['uptime']) : 'N/A' ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">Console Access</h6>
                                <?php if($ticket): ?>
                                <iframe 
                                    src="<?= base_url('noVNC/vnc.html?host=' . $_SERVER['SERVER_NAME'] . '&port=6081&path=api2/json/nodes/server/qemu/' . $vmData['idVmProxmox'] . '/vncproxy&ticket=' . urlencode($ticket)) ?>"
                                    width="100%" 
                                    height="600px" 
                                    frameborder="0"
                                    allow="fullscreen">
                                </iframe>
                                <?php else: ?>
                                <div class="alert alert-warning">
                                    Unable to establish VNC connection. Please check if:
                                    <ul>
                                        <li>The VM is running</li>
                                        <li>VNC service is enabled on Proxmox</li>
                                        <li>Network connectivity between client and server</li>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if($vmData['status'] == 'aktif'): ?>
                            <a href="<?= base_url('pilihos/stopvm') ?>" class="btn btn-danger mt-3">Stop VM</a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        Please select an operating system below to create your virtual machine.
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
                                    <a href="<?= base_url('pilihos/createvm/' . $osName) ?>" class="btn btn-primary mt-auto" style="width: 70%;">Pilih</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>                
            </div>
        </div>
    </div>
    
    <footer class="bg-dark">
        <div class="footer-top">
            <div class="container p-0 mb-4">
                <div class="row gy-5">
                    <div class="col-lg-4 col-sm-6">
                        <a class="text-white d-flex" href="<?php echo base_url('/beranda') ?>">
                            <img style="width: 25px; height: 25px;" src="/img/ikon.png" alt="">
                             <h5 style="padding-left: 5px;">Clous.OS</h5>
                        </a>
                        <div class="line mt-1 mb-3"></div>
                        <p class="fs-6">Cloud.OS memberikan kemudahan dalam mengakses berbagai sistem operasi melalui cloud. <br>
                        Digunakan sebagai media pembelajaran mata kuliah <br> sistem operasi pada prodi D3-Teknologi Informasi, Politeknik Negeri Madiun.</p>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <h5 class="pb-1" style="color: aliceblue;">Sistem Operasi</h5>
                        <div class="line mt-1 mb-3"></div>
                        <p class="fs-6 mb-2">Beberapa sistem operasi yang digunakan :</p>
                        <ul class="text-white">
                            <li>
                                <a href="https://www.debian.org/intro/about" target="_blank">Debian</a>
                            </li>
                            <li>
                                <a href="https://ubuntu.com/about" terget="_blank">Ubuntu</a>
                            </li>
                            <li>
                                <a href="https://www.centos.org/about/" target="_blank">CentOs</a>
                            </li>
                            <li>
                                <a href="https://www.kali.org/docs/introduction/what-is-kali-linux/" target="_blank">Kali Linux</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <h5 class="pb-1" style="color: aliceblue;">Fitur Utama</h5>
                        <div class="line mt-1 mb-3"></div>
                        <ul class="text-white">
                            <li>
                                <a href="<?php echo base_url('/pilihos') ?>">Pilih OS</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('/materi') ?>">Materi Pembelajaran</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom border-top border-secondary border-opacity-50">
            <div class="container p-0">
                <div class="row justify-content-between">
                    <div class="col-12">
                        <p class="mb-0 fs-6">© 2025, Politeknik Negeri Madiun</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="/js/frondend.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>
