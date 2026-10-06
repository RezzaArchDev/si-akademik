<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">Daftar Program Studi</h5>
    <a href="/bkpm/acara10/si-akademik/public/prodi/create" class="btn btn-primary btn-sm">+ Tambah Prodi</a>
</div>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Program Studi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($daftarProdi)): ?>
            <tr><td colspan="4" class="text-center text-muted">Belum ada data</td></tr>
        <?php endif; ?>

        <?php foreach ($daftarProdi as $i => $p): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($p['kode']) ?></td>
                <td><?= htmlspecialchars($p['nama']) ?></td>
                <td>
                    <a href="/bkpm/acara10/si-akademik/public/prodi/<?= $p['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/bkpm/acara10/si-akademik/public/prodi/<?= $p['id'] ?>/delete" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>