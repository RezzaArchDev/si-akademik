<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">Daftar Mahasiswa</h5>
    <a href="/bkpm/acara10/si-akademik/public/mahasiswa/create" class="btn btn-primary btn-sm">+ Tambah Mahasiswa</a>
</div>

<!-- ===== TUGAS MANDIRI: form pencarian ===== -->
<form method="GET" action="/bkpm/acara10/si-akademik/public/mahasiswa" class="row g-2 mb-3">
    <div class="col-md-5">
        <input type="text" name="q" class="form-control" placeholder="Cari nama atau NIM..."
               value="<?= htmlspecialchars($keyword ?? '') ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-outline-primary">Cari</button>
        <a href="/bkpm/acara10/si-akademik/public/mahasiswa" class="btn btn-outline-secondary">Reset</a>
    </div>
</form>
<!-- ===== AKHIR TUGAS MANDIRI ===== -->

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Program Studi</th>
            <th>Angkatan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($daftarMahasiswa)): ?>
            <tr><td colspan="8" class="text-center text-muted">Belum ada data</td></tr>
        <?php endif; ?>

        <?php foreach ($daftarMahasiswa as $i => $mhs): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($mhs['nim']) ?></td>
                <td><?= htmlspecialchars($mhs['nama']) ?></td>
                <td><?= htmlspecialchars($mhs['email']) ?></td>
                <td><?= htmlspecialchars($mhs['prodi']) ?></td>
                <td><?= htmlspecialchars($mhs['angkatan']) ?></td>
                <?php $warna = ['aktif' => 'success', 'cuti' => 'warning', 'lulus' => 'primary'][$mhs['status']] ?? 'secondary'; ?>
                <td><span class="badge bg-<?= $warna ?>"><?= htmlspecialchars($mhs['status']) ?></span></td>
                <td>
                    <a href="/bkpm/acara10/si-akademik/public/mahasiswa/<?= $mhs['id'] ?>" class="btn btn-sm btn-info">Detail</a>
                    <a href="/bkpm/acara10/si-akademik/public/mahasiswa/<?= $mhs['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/bkpm/acara10/si-akademik/public/mahasiswa/<?= $mhs['id'] ?>/delete" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>