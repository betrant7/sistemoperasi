<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VM Console</title>
    <script type="module">
        import RFB from './public/novnc/core/rfb.js';

        // Mengambil data tiket dan port dari controller
        const url = `wss://203.194.112.201:<?php echo $data['data']['port']; ?>/?vncticket=<?php echo $data['data']['ticket']; ?>`;

        // Menampilkan noVNC pada elemen canvas
        const screen = document.getElementById('noVNC_canvas');

        const rfb = new RFB(screen, url, {
            credentials: {
                password: '' // kosongkan, karena menggunakan tiket
            }
        });

        // Menyesuaikan pengaturan noVNC
        rfb.viewOnly = false;
        rfb.scaleViewport = true;
    </script>
</head>
<body>
    <div id="noVNC_canvas" style="width: 100%; height: 600px; background: black;"></div>
</body>
</html>
