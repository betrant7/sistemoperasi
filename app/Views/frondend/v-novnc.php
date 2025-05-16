<!DOCTYPE html>
<html>
<head>
    <title>noVNC Console</title>
    <style>
        html, body { height: 100%; margin: 0; padding: 0; }
        iframe { width: 100vw; height: 100vh; border: none; }
    </style>
</head>
<body>
    <iframe src="<?= $novnc_url ?>" width="100%" height="600px" frameborder="0" allow="fullscreen"></iframe>
</body>
</html>
