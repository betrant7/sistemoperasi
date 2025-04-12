<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="<?= base_url('/verifikasiProses') ?>">
        <input type="hidden" name="email" value="<?= session('email') ?>">
        <label>Masukkan Kode Verifikasi</label>
        <input type="text" name="verification_code" class="form-control" required>
        <button type="submit" class="btn btn-primary">Verifikasi</button>
    </form>
</body>
</html>