<?php
$isEdit = $mk !== null;
$action = $isEdit
    ? "/bkpm/acara13/si-akademik/public/matakuliah/{$mk['id']}/update"
    : "/bkpm/acara13/si-akademik/public/matakuliah";
?>
<h5 class="mb-3"><?= $isEdit ? 'Edit' : 'Tambah' ?> Mata Kuliah</h5>

<form action="<?= $action ?>" method="POST">
    <div class="mb-3">
        <label class="form-label">Kode</label>
        <input type="text" name="kode" class="form-control" maxlength="10" value="<?= htmlspecialchars($mk['kode'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Mata Kuliah</label>
        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($mk['nama'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">SKS</label>
        <input type="number" name="sks" class="form-control" min="1" max="6" value="<?= htmlspecialchars($mk['sks'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Program Studi</label>
        <select name="prodi_id" class="form-select" required>
            <option value="">-- Pilih Program Studi --</option>
            <?php foreach ($prodiList as $p): ?>
                <option value="<?= $p['id'] ?>" <?= ($mk['prodi_id'] ?? '') == $p['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nama']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/bkpm/acara13/si-akademik/public/matakuliah" class="btn btn-secondary">Batal</a>
</form>