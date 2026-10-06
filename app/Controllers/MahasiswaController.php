<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\Mahasiswa;
use App\Models\ProdiModel;
use App\Repositories\MahasiswaRepository;
use InvalidArgumentException;
use PDOException;

class MahasiswaController extends BaseController
{
    private MahasiswaRepository $repo;

    // Constructor injection (dari Acara 9)
    public function __construct(MahasiswaRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(): void
    {
        $keyword = trim($_GET['q'] ?? '');
        $daftarMahasiswa = $keyword !== '' ? $this->repo->search($keyword) : $this->repo->all();

        // view() diwarisi dari BaseController
        $this->view('mahasiswa/index', compact('daftarMahasiswa', 'keyword'));
    }

    public function create(): void
    {
        $mhs = null;   // null = form tambah
        $prodiList = (new ProdiModel())->all();

        $this->view('mahasiswa/form', compact('mhs', 'prodiList'));
    }

    public function store(): void
    {
        try {
            $mhs = $this->buatMahasiswa();   // setter memvalidasi
            $this->repo->create($mhs);
        } catch (InvalidArgumentException $e) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => $e->getMessage()];
            $this->redirect('/bkpm/acara10/si-akademik/public/mahasiswa/create');
        } catch (PDOException $e) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Gagal menyimpan: NIM sudah terdaftar'];
            $this->redirect('/bkpm/acara10/si-akademik/public/mahasiswa/create');
        }

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Mahasiswa berhasil ditambahkan'];
        $this->redirect('/bkpm/acara10/si-akademik/public/mahasiswa');
    }

    public function show(int $id): void
    {
        $mhs = $this->repo->find($id);

        if ($mhs === null) {
            http_response_code(404);
            echo "404 - Mahasiswa dengan ID {$id} tidak ditemukan";
            return;
        }

        echo "<h1>Detail Mahasiswa (ID: {$id})</h1>";
        echo "<p>" . htmlspecialchars("{$mhs['nim']} - {$mhs['nama']} ({$mhs['prodi']})") . "</p>";
        echo "<p>Email: " . htmlspecialchars($mhs['email']) . "</p>";
        echo "<p>Angkatan: " . htmlspecialchars($mhs['angkatan']) . "</p>";
        echo "<a href='/bkpm/acara10/si-akademik/public/mahasiswa'>Kembali</a>";
    }

    public function edit(int $id): void
    {
        $mhs = $this->repo->find($id);   // berisi data lama = form edit

        if ($mhs === null) {
            http_response_code(404);
            echo "404 - Mahasiswa dengan ID {$id} tidak ditemukan";
            return;
        }

        $prodiList = (new ProdiModel())->all();

        $this->view('mahasiswa/form', compact('mhs', 'prodiList'));
    }

    public function update(int $id): void
    {
        try {
            $mhs = $this->buatMahasiswa($id);   // setter memvalidasi
            $this->repo->update($mhs);
        } catch (InvalidArgumentException $e) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => $e->getMessage()];
            $this->redirect("/bkpm/acara10/si-akademik/public/mahasiswa/{$id}/edit");
        } catch (PDOException $e) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Gagal mengubah: NIM sudah dipakai'];
            $this->redirect("/bkpm/acara10/si-akademik/public/mahasiswa/{$id}/edit");
        }

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Data mahasiswa berhasil diubah'];
        $this->redirect('/bkpm/acara10/si-akademik/public/mahasiswa');
    }

    public function destroy(int $id): void
    {
        $this->repo->delete($id);

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Data mahasiswa berhasil dihapus'];
        $this->redirect('/bkpm/acara10/si-akademik/public/mahasiswa');
    }

    // Membuat objek Mahasiswa dari input form.
    // Setiap setter bisa melempar InvalidArgumentException jika data tidak valid.
    private function buatMahasiswa(?int $id = null): Mahasiswa
    {
        $mhs = new Mahasiswa();

        if ($id !== null) {
            $mhs->setId($id);
        }

        $mhs->setNim($_POST['nim'] ?? '');
        $mhs->setNama($_POST['nama'] ?? '');
        $mhs->setEmail($_POST['email'] ?? '');
        $mhs->setProdiId((int) ($_POST['prodi_id'] ?? 0));
        $mhs->setAngkatan((int) ($_POST['angkatan'] ?? date('Y')));
        $mhs->setStatus($_POST['status'] ?? 'aktif');

        return $mhs;
    }
}