<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="/bkpm/acara14/si-akademik/public/">TIF - Politeknik Negeri Jember</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <?php if (!empty($_SESSION['logged_in'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/bkpm/acara14/si-akademik/public/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/bkpm/acara14/si-akademik/public/mahasiswa">Data Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/bkpm/acara14/si-akademik/public/prodi">Program Studi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/bkpm/acara14/si-akademik/public/matakuliah">Mata Kuliah</a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
                <?php if (!empty($_SESSION['logged_in'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/bkpm/acara14/si-akademik/public/logout">Logout (<?= htmlspecialchars($_SESSION['user_name']) ?>)</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/bkpm/acara14/si-akademik/public/login">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>