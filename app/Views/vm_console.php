<!DOCTYPE html>
<html>
<head>
    <title>VM Console</title>
</head>
<body>
    <h2>Console VM - ID <?= esc($vncticket) ?></h2>
    <iframe 
        src="<?= base_url('novnc/vnc_lite.html') ?>?host=<?= esc($host) ?>&port=<?= esc($port) ?>&token=<?= esc($vncticket) ?>&path=<?= esc($path) ?>"
        width="100%" height="600" frameborder="0" allowfullscreen>
    </iframe>
</body>
</html>
