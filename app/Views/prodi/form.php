<?php
$isEdit = $prodi !== null;
$action = $isEdit
    ? "/bkpm/acara15/si-akademik/public/prodi/{$prodi['id']}/update"
    : "/bkpm/acara15/si-akademik/public/prodi";
?>
<h5 class="mb-3"><?= $isEdit ? 'Edit' : 'Tambah' ?> Program Studi</h5>

<form action="<?= $action ?>" method="POST">
    <div class="mb-3">
        <label class="form-label">Kode</label>
        <input type="text" name="kode" class="form-control" maxlength="10" value="<?= htmlspecialchars($prodi['kode'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Program Studi</label>
        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($prodi['nama'] ?? '') ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/bkpm/acara15/si-akademik/public/prodi" class="btn btn-secondary">Batal</a>
</form>