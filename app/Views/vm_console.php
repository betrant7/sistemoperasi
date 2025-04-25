<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VM Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Virtual Machine Mahasiswa</h1>

        <?php if ($vm): ?>
            <h2>VM ID: <?= $vm['idVmProxmox'] ?></h2>
            <p>Status: <?= ucfirst($vm['status']) ?></p>

            <!-- Jika VM aktif, tampilkan tombol untuk stop -->
            <?php if ($vm['status'] == 'aktif'): ?>
                <a href="<?= base_url('/vm/stop/' . $vm['idVM']) ?>" class="btn btn-danger">Stop VM</a>
            <?php else: ?>
                <!-- Jika VM nonaktif, tampilkan tombol untuk start -->
                <a href="<?= base_url('/vm/start/' . $vm['idVM']) ?>" class="btn btn-success">Start VM</a>
            <?php endif; ?>

            <!-- Display noVNC Console atau Iframe VM -->
            <div class="mt-4">
                <h3>Console VM</h3>
                <iframe src="https://203.194.112.201:8006/?console=1&vmid=<?= $vm['idVmProxmox'] ?>" width="100%" height="500px"></iframe>
            </div>
        <?php else: ?>
            <p>Belum ada VM yang terdaftar. Harap coba lagi nanti.</p>
        <?php endif; ?>
    </div>
</body>
</html>
