<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
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
            p { font-size: 15px; }
            a { color: #2874a6; text-decoration: none; font-weight: 600; }
            a:hover { text-decoration: underline; }
            .nav-link {
                display: inline-block;
                margin-top: 20px;
                margin-right: 10px;
                padding: 8px 16px;
                background-color: #1a5276;
                color: #ffffff !important;
                border-radius: 6px;
            }
            .nav-link:hover { background-color: #154360; text-decoration: none; }
            .nav-link.logout { background-color: #c0392b; }
            .nav-link.logout:hover { background-color: #922b21; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Politeknik Negeri Jember</h1>

            <h2>Dashboard</h2>
            <p>Selamat datang, <strong><?= htmlspecialchars($username) ?></strong>.</p>

            <a class="nav-link" href="/si-akademik/public/mahasiswa">Mahasiswa</a>
            <a class="nav-link" href="/si-akademik/public/dosen">Dosen</a>
            <a class="nav-link logout" href="/si-akademik/public/logout">Logout</a>
        </div>
    </body>
</html>