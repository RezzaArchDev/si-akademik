<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\MatakuliahModel;
use App\Models\ProdiModel;
use PDOException;

class MatakuliahController extends BaseController
{
    public function index(): void
    {
        $daftarMatakuliah = (new MatakuliahModel())->all();

        $this->view('matakuliah/index', compact('daftarMatakuliah'));
    }

    public function create(): void
    {
        $mk = null;   // null = form tambah
        $prodiList = (new ProdiModel())->all();

        $this->view('matakuliah/form', compact('mk', 'prodiList'));
    }

    public function store(): void
    {
        $data = $this->input();

        if ($data['kode'] === '' || $data['nama'] === '' || $data['sks'] < 1 || $data['prodi_id'] < 1) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Semua kolom wajib diisi dengan benar'];
            $this->redirect('/bkpm/acara13/si-akademik/public/matakuliah/create');
        }

        try {
            (new MatakuliahModel())->create($data);
        } catch (PDOException $e) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Gagal menyimpan: kode mata kuliah sudah dipakai'];
            $this->redirect('/bkpm/acara13/si-akademik/public/matakuliah/create');
        }

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Mata kuliah berhasil ditambahkan'];
        $this->redirect('/bkpm/acara13/si-akademik/public/matakuliah');
    }

    public function edit(int $id): void
    {
        $mk = (new MatakuliahModel())->find($id);

        if ($mk === null) {
            http_response_code(404);
            echo "404 - Mata kuliah dengan ID {$id} tidak ditemukan";
            return;
        }

        $prodiList = (new ProdiModel())->all();

        $this->view('matakuliah/form', compact('mk', 'prodiList'));
    }

    public function update(int $id): void
    {
        $data = $this->input();

        if ($data['kode'] === '' || $data['nama'] === '' || $data['sks'] < 1 || $data['prodi_id'] < 1) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Semua kolom wajib diisi dengan benar'];
            $this->redirect("/bkpm/acara13/si-akademik/public/matakuliah/{$id}/edit");
        }

        try {
            (new MatakuliahModel())->update($id, $data);
        } catch (PDOException $e) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Gagal mengubah: kode mata kuliah sudah dipakai'];
            $this->redirect("/bkpm/acara13/si-akademik/public/matakuliah/{$id}/edit");
        }

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Mata kuliah berhasil diubah'];
        $this->redirect('/bkpm/acara13/si-akademik/public/matakuliah');
    }

    public function destroy(int $id): void
    {
        (new MatakuliahModel())->delete($id);

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Mata kuliah berhasil dihapus'];
        $this->redirect('/bkpm/acara13/si-akademik/public/matakuliah');
    }

    private function input(): array
    {
        return [
            'kode'     => trim($_POST['kode'] ?? ''),
            'nama'     => trim($_POST['nama'] ?? ''),
            'sks'      => (int) ($_POST['sks'] ?? 0),
            'prodi_id' => (int) ($_POST['prodi_id'] ?? 0),
        ];
    }
}