<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">Daftar Mata Kuliah</h5>
    <a href="/bkpm/acara15/si-akademik/public/matakuliah/create" class="btn btn-primary btn-sm">+ Tambah Mata Kuliah</a>
</div>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Program Studi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($daftarMatakuliah)): ?>
            <tr><td colspan="6" class="text-center text-muted">Belum ada data</td></tr>
        <?php endif; ?>

        <?php foreach ($daftarMatakuliah as $i => $m): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($m['kode']) ?></td>
                <td><?= htmlspecialchars($m['nama']) ?></td>
                <td><?= htmlspecialchars($m['sks']) ?></td>
                <td><?= htmlspecialchars($m['prodi']) ?></td>
                <td>
                    <a href="/bkpm/acara15/si-akademik/public/matakuliah/<?= $m['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/bkpm/acara15/si-akademik/public/matakuliah/<?= $m['id'] ?>/delete" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>