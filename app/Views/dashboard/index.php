<h5 class="mb-3">Dashboard</h5>
<p>Halo, <strong><?= htmlspecialchars($_SESSION['user_name'] ?? '') ?></strong>.
    Halaman ini hanya bisa diakses setelah login.</p>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="card-title">Data Mahasiswa</h6>
                <p class="card-text text-muted">Kelola data mahasiswa.</p>
                <a href="/bkpm/acara13/si-akademik/public/mahasiswa" class="btn btn-primary btn-sm">Buka</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="card-title">Program Studi</h6>
                <p class="card-text text-muted">Kelola data program studi.</p>
                <a href="/bkpm/acara13/si-akademik/public/prodi" class="btn btn-primary btn-sm">Buka</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="card-title">Mata Kuliah</h6>
                <p class="card-text text-muted">Kelola data mata kuliah.</p>
                <a href="/bkpm/acara13/si-akademik/public/matakuliah" class="btn btn-primary btn-sm">Buka</a>
            </div>
        </div>
    </div>
</div>