<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ProdiModel;
use PDOException;

class ProdiController extends BaseController
{
    public function index(): void
    {
        $daftarProdi = (new ProdiModel())->all();

        $this->view('prodi/index', compact('daftarProdi'));
    }

    public function create(): void
    {
        $prodi = null;   // null = form tambah

        $this->view('prodi/form', compact('prodi'));
    }

    public function store(): void
    {
        $data = $this->input();

        if ($data['kode'] === '' || $data['nama'] === '') {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Kode dan nama prodi wajib diisi'];
            $this->redirect('/bkpm/acara10/si-akademik/public/prodi/create');
        }

        try {
            (new ProdiModel())->create($data);
        } catch (PDOException $e) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Gagal menyimpan: kode prodi sudah dipakai'];
            $this->redirect('/bkpm/acara10/si-akademik/public/prodi/create');
        }

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Prodi berhasil ditambahkan'];
        $this->redirect('/bkpm/acara10/si-akademik/public/prodi');
    }

    public function edit(int $id): void
    {
        $prodi = (new ProdiModel())->find($id);

        if ($prodi === null) {
            http_response_code(404);
            echo "404 - Prodi dengan ID {$id} tidak ditemukan";
            return;
        }

        $this->view('prodi/form', compact('prodi'));
    }

    public function update(int $id): void
    {
        $data = $this->input();

        if ($data['kode'] === '' || $data['nama'] === '') {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Kode dan nama prodi wajib diisi'];
            $this->redirect("/bkpm/acara10/si-akademik/public/prodi/{$id}/edit");
        }

        try {
            (new ProdiModel())->update($id, $data);
        } catch (PDOException $e) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Gagal mengubah: kode prodi sudah dipakai'];
            $this->redirect("/bkpm/acara10/si-akademik/public/prodi/{$id}/edit");
        }

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Prodi berhasil diubah'];
        $this->redirect('/bkpm/acara10/si-akademik/public/prodi');
    }

    public function destroy(int $id): void
    {
        try {
            (new ProdiModel())->delete($id);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Prodi berhasil dihapus'];
        } catch (PDOException $e) {
            // Foreign key RESTRICT: prodi masih dipakai mahasiswa / mata kuliah
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Prodi tidak dapat dihapus karena masih dipakai'];
        }

        $this->redirect('/bkpm/acara10/si-akademik/public/prodi');
    }

    private function input(): array
    {
        return [
            'kode' => trim($_POST['kode'] ?? ''),
            'nama' => trim($_POST['nama'] ?? ''),
        ];
    }
}