<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Logger;
use App\Services\MahasiswaService;
use PDOException;
use Throwable;

class MahasiswaController extends BaseController
{
    private const URL = '/bkpm/acara14/si-akademik/public/mahasiswa';

    // Controller hanya bergantung pada Service (tidak ada query / validasi di sini)
    public function __construct(private MahasiswaService $service)
    {
    }

        public function index(): void
    {
        $keyword = trim($_GET['q'] ?? '');

        try {
            $daftarMahasiswa = $this->service->all($keyword);
        } catch (Throwable $e) {
            Logger::error($e->getMessage(), ['aksi' => 'menampilkan daftar mahasiswa']);
            $this->flash('danger', 'Data gagal dimuat');
            $daftarMahasiswa = [];
        }

        $this->view('mahasiswa/index', compact('daftarMahasiswa', 'keyword'));
    }

    public function create(): void
    {
        $mhs       = null;   // null = form tambah
        $prodiList = $this->service->prodiOptions();

        $this->view('mahasiswa/form', compact('mhs', 'prodiList'));
    }

    public function store(): void
    {
        try {
            $hasil = $this->service->create($_POST);
        } catch (Throwable $e) {
            $this->tangani($e, 'menambah mahasiswa', 'Data gagal disimpan', self::URL . '/create');
        }

        if (!$hasil['success']) {
            $this->flash('danger', implode('; ', $hasil['errors']));
            $this->redirect(self::URL . '/create');
        }

        $this->flash('success', 'Data mahasiswa berhasil ditambahkan');
        $this->redirect(self::URL);
    }

    public function show(int $id): void
    {
        $mhs = $this->service->find($id);

        if ($mhs === null) {
            http_response_code(404);
            echo "404 - Mahasiswa dengan ID {$id} tidak ditemukan";
            return;
        }

        echo "<h1>Detail Mahasiswa (ID: {$id})</h1>";
        echo "<p>" . htmlspecialchars("{$mhs['nim']} - {$mhs['nama']} ({$mhs['prodi']})") . "</p>";
        echo "<p>Email: " . htmlspecialchars($mhs['email']) . "</p>";
        echo "<p>Angkatan: " . htmlspecialchars($mhs['angkatan']) . "</p>";
        echo "<a href='" . self::URL . "'>Kembali</a>";
    }

    public function edit(int $id): void
    {
        $mhs = $this->service->find($id);

        if ($mhs === null) {
            http_response_code(404);
            echo "404 - Mahasiswa dengan ID {$id} tidak ditemukan";
            return;
        }

        $prodiList = $this->service->prodiOptions();

        $this->view('mahasiswa/form', compact('mhs', 'prodiList'));
    }

    public function update(int $id): void
    {
        try {
            $hasil = $this->service->update($id, $_POST);
        } catch (Throwable $e) {
            $this->tangani($e, "mengubah mahasiswa id={$id}", 'Data gagal disimpan', self::URL . "/{$id}/edit");
        }

        if (!$hasil['success']) {
            $this->flash('danger', implode('; ', $hasil['errors']));
            $this->redirect(self::URL . "/{$id}/edit");
        }

        $this->flash('success', 'Data mahasiswa berhasil diubah');
        $this->redirect(self::URL);
    }

    public function destroy(int $id): void
    {
        try {
            $this->service->delete($id);
        } catch (Throwable $e) {
            $this->tangani($e, "menghapus mahasiswa id={$id}", 'Data gagal dihapus', self::URL);
        }

        $this->flash('success', 'Data mahasiswa berhasil dihapus');
        $this->redirect(self::URL);
    }

    // ===== Helper =====

    // Flash message: disimpan di session, ditampilkan sekali oleh partials/flash.php
    private function flash(string $type, string $message): void
    {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }

    // Penanganan error database (di Acara 14 ditambah logging)
        // Penanganan error: catat detail ke log, pengguna hanya melihat pesan aman
    private function tangani(Throwable $e, string $aksi, string $pesan, string $kembali): void
    {
        Logger::error($e->getMessage(), ['aksi' => $aksi]);

        // 1062 = Duplicate entry (NIM sama dikirim bersamaan / lolos dari pengecekan)
        if ($e instanceof PDOException && ($e->errorInfo[1] ?? null) === 1062) {
            $pesan = 'NIM sudah terdaftar';
        }

        $this->flash('danger', $pesan);
        $this->redirect($kembali);
    }
}