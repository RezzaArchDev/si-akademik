<!DOCTYPE html>
<html>
    <head>
        <title>Daftar Dosen</title>
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
                max-width: 800px;
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
            h2 { color: #2874a6; margin-top: 25px; }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 15px;
            }
            table, th, td { border: 1px solid #d5dbdb; }
            th, td { padding: 10px 14px; text-align: left; }
            th { background-color: #1a5276; color: #ffffff; }
            tr:nth-child(even) { background-color: #f2f6fa; }
            tr:hover { background-color: #eaf2f8; }
            a { color: #2874a6; text-decoration: none; font-weight: 600; }
            a:hover { text-decoration: underline; }
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
            <h1>Politeknik Negeri Jember</h1>

            <h2>Daftar Dosen</h2>
            <table>
                <tr>
                    <th>NIDN</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Aksi</th>
                </tr>

                <?php foreach ($dosenList ?? [] as $dosen) : ?>

                    <tr>
                        <td><?= $dosen['nidn'] ?></td>
                        <td><?= $dosen['nama'] ?></td>
                        <td><?= $dosen['prodi'] ?></td>
                        <td>
                            <a href="/si-akademik/public/dosen/detail?nidn=<?= $dosen['nidn'] ?>">Detail</a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </table>

            <a class="nav-link" href="/si-akademik/public/dashboard">Dashboard</a>
            <a class="nav-link" href="/si-akademik/public/mahasiswa">Lihat Daftar Mahasiswa</a>
            <a class="nav-link" href="/si-akademik/public/logout">Logout</a>
        </div>
    </body>
</html>