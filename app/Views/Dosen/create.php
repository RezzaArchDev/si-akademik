<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Dosen</title>
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
            max-width: 500px;
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
        label { font-weight: 600; }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 6px 0 16px 0;
            border: 1px solid #d5dbdb;
            border-radius: 5px;
        }
        button {
            background-color: #1a5276;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover { background-color: #154360; }
        a { color: #2874a6; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Dosen</h1>
        <form method="post" action="/si-akademik/public/dosen/store">
            <label>NIDN</label><br>
            <input type="text" name="nidn" required><br>

            <label>Nama</label><br>
            <input type="text" name="nama" required><br>

            <label>Bidang Keahlian</label><br>
            <input type="text" name="bidang_keahlian" required><br>

            <button type="submit">Simpan</button>
        </form>
        <br>
        <a href="/si-akademik/public/dosen">Kembali ke Data Dosen</a>
    </div>
</body>
</html>