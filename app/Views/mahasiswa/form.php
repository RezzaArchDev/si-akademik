<?php
$isEdit = $mhs !== null;
$action = $isEdit
    ? "/bkpm/acara15/si-akademik/public/mahasiswa/{$mhs['id']}/update"
    : "/bkpm/acara15/si-akademik/public/mahasiswa";
?>
<h5 class="mb-3"><?= $isEdit ? 'Edit' : 'Tambah' ?> Mahasiswa</h5>

<form action="<?= $action ?>" method="POST">
    <div class="mb-3">
        <label class="form-label">NIM</label>
        <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($mhs['nim'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($mhs['nama'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($mhs['email'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Program Studi</label>
        <select name="prodi_id" class="form-select" required>
            <option value="">-- Pilih Program Studi --</option>
            <?php foreach ($prodiList as $p): ?>
                <option value="<?= $p['id'] ?>" <?= ($mhs['prodi_id'] ?? '') == $p['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nama']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Angkatan</label>
        <input type="number" name="angkatan" class="form-control" value="<?= htmlspecialchars($mhs['angkatan'] ?? date('Y')) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <?php foreach (['aktif', 'cuti', 'lulus'] as $s): ?>
                <option value="<?= $s ?>" <?= ($mhs['status'] ?? 'aktif') === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/bkpm/acara15/si-akademik/public/mahasiswa" class="btn btn-secondary">Batal</a>
</form>