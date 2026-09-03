<!DOCTYPE html>
<html>
<head>
    <title>Detail Dosen</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f9;
            color: #2c3e50;
            margin: 0;
            padding: 40px 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        h1 {
            color: #1a5276;
            border-bottom: 3px solid #1a5276;
            padding-bottom: 10px;
            margin-top: 0;
        }
        .detail-item { margin-bottom: 14px; font-size: 16px; }
        .detail-item strong { display: inline-block; width: 90px; color: #1a5276; }
        a { color: #2874a6; text-decoration: none; font-weight: 600; }
        .nav-link {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 16px;
            background-color: #1a5276;
            color: #ffffff !important;
            border-radius: 6px;
        }
        .nav-link:hover { background-color: #154360; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Dosen</h1>

        <div class="detail-item">
            <strong>NIDN:</strong> <?= $dosen['nidn'] ?>
        </div>
        <div class="detail-item">
            <strong>Nama:</strong> <?= $dosen['nama'] ?>
        </div>
        <div class="detail-item">
            <strong>Prodi:</strong> <?= $dosen['prodi'] ?>
        </div>

        <a class="nav-link" href="?url=Dosen">Kembali</a>
    </div>
</body>
</html>