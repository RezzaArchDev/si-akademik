<?php

namespace App\Services;

use App\Models\Mahasiswa;
use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;

class MahasiswaService
{
    public function __construct(
        private MahasiswaRepository $repo,
        private ProdiRepository $prodiRepo
    ) {
    }

    // ===== Membaca data =====
    public function all(string $keyword = ''): array
    {
        return $keyword !== '' ? $this->repo->search($keyword) : $this->repo->all();
    }

    public function find(int $id): ?array
    {
        return $this->repo->find($id);
    }

    public function prodiOptions(): array
    {
        return $this->prodiRepo->all();
    }

    // ===== Business logic =====
    public function create(array $input): array
    {
        $input  = $this->bersihkan($input);
        $errors = $this->validate($input);

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $id = $this->repo->create($this->buatEntitas($input));

        return ['success' => true, 'id' => $id];
    }

    public function update(int $id, array $input): array
    {
        if ($this->repo->find($id) === null) {
            return ['success' => false, 'errors' => ['id' => 'Data mahasiswa tidak ditemukan']];
        }

        $input  = $this->bersihkan($input);
        $errors = $this->validate($input, $id);

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $this->repo->update($this->buatEntitas($input, $id));

        return ['success' => true, 'id' => $id];
    }

    public function delete(int $id): void
    {
        $this->repo->delete($id);
    }

    // ===== Private helper =====
    private function bersihkan(array $input): array
    {
        return [
            'nim'      => trim((string) ($input['nim'] ?? '')),
            'nama'     => trim((string) ($input['nama'] ?? '')),
            'email'    => trim((string) ($input['email'] ?? '')),
            'prodi_id' => (int) ($input['prodi_id'] ?? 0),
            'angkatan' => (int) ($input['angkatan'] ?? date('Y')),
            'status'   => (string) ($input['status'] ?? 'aktif'),
        ];
    }

    // Mengembalikan array error per field (kosong = valid)
    private function validate(array $input, ?int $ignoreId = null): array
    {
        $errors = [];

        if ($input['nim'] === '') {
            $errors['nim'] = 'NIM wajib diisi';
        } elseif (!ctype_digit($input['nim'])) {
            $errors['nim'] = 'NIM harus berupa angka';
        } elseif (strlen($input['nim']) > 20) {
            $errors['nim'] = 'NIM maksimal 20 karakter';
        } elseif ($this->repo->existsByNim($input['nim'], $ignoreId)) {
            $errors['nim'] = 'NIM sudah terdaftar';
        }

        if ($input['nama'] === '') {
            $errors['nama'] = 'Nama wajib diisi';
        } elseif (strlen($input['nama']) > 100) {
            $errors['nama'] = 'Nama maksimal 100 karakter';
        }

        if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Format email tidak valid';
        }

        if ($this->prodiRepo->find($input['prodi_id']) === null) {
            $errors['prodi_id'] = 'Program studi tidak valid';
        }

        if ($input['angkatan'] < 2000 || $input['angkatan'] > (int) date('Y')) {
            $errors['angkatan'] = 'Angkatan tidak valid';
        }

        if (!in_array($input['status'], ['aktif', 'cuti', 'lulus'], true)) {
            $errors['status'] = 'Status tidak valid';
        }

        return $errors;
    }

    // Setter pada class Mahasiswa (Acara 9) menjadi lapisan validasi kedua
    private function buatEntitas(array $input, ?int $id = null): Mahasiswa
    {
        $m = new Mahasiswa();

        if ($id !== null) {
            $m->setId($id);
        }

        $m->setNim($input['nim']);
        $m->setNama($input['nama']);
        $m->setEmail($input['email']);
        $m->setProdiId($input['prodi_id']);
        $m->setAngkatan($input['angkatan']);
        $m->setStatus($input['status']);

        return $m;
    }
}