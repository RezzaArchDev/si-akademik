<h5 class="mb-3">Dashboard</h5>
<p>Halo, <strong><?= htmlspecialchars($_SESSION['user_name'] ?? '') ?></strong>.
    Halaman ini hanya bisa diakses setelah login.</p>
<a href="/bkpm/acara10/si-akademik/public/mahasiswa" class="btn btn-primary">Lihat Data Mahasiswa</a>