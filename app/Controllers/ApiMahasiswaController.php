<?php

namespace App\Controllers;

use App\Core\Logger;
use App\Services\MahasiswaService;
use Throwable;

class ApiMahasiswaController
{
    public function __construct(private MahasiswaService $service)
    {
    }

    // GET /api/mahasiswa           -> semua mahasiswa
    // GET /api/mahasiswa?id=1      -> satu mahasiswa
    // GET /api/mahasiswa?q=budi    -> pencarian nama / NIM
    public function index(): void
    {
        try {
            if (isset($_GET['id'])) {
                if (!ctype_digit((string) $_GET['id'])) {
                    $this->json(400, false, 'ID harus berupa angka');
                }

                $mhs = $this->service->find((int) $_GET['id']);

                if ($mhs === null) {
                    $this->json(404, false, 'Mahasiswa dengan ID ' . (int) $_GET['id'] . ' tidak ditemukan');
                }

                $this->json(200, true, 'Data berhasil diambil', $this->format($mhs));
            }

            $daftar = $this->service->all(trim($_GET['q'] ?? ''));
            $this->json(200, true, 'Data berhasil diambil', array_map([$this, 'format'], $daftar));
        } catch (Throwable $e) {
            $this->error($e, 'GET /api/mahasiswa');
        }
    }

    // POST /api/mahasiswa  (body JSON)
    public function store(): void
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!is_array($input)) {
            $this->json(400, false, 'Body harus berupa JSON yang valid');
        }

        // Angkatan boleh dikosongkan: diambil dari 2 digit pertama NIM (23004 -> 2023)
        if (!isset($input['angkatan']) && isset($input['nim']) && preg_match('/^\d{2}/', (string) $input['nim'], $m)) {
            $input['angkatan'] = 2000 + (int) $m[0];
        }

        try {
            $hasil = $this->service->create($input);

            if (!$hasil['success']) {
                $this->json(422, false, 'Data tidak valid', null, $hasil['errors']);
            }

            $baru = $this->service->find($hasil['id']);
            $this->json(201, true, 'Data berhasil ditambahkan', $this->format($baru));
        } catch (Throwable $e) {
            $this->error($e, 'POST /api/mahasiswa');
        }
    }

    // ===== Helper =====

    // Hanya field yang perlu dikirim ke client
    private function format(array $m): array
    {
        return [
            'id'       => (int) $m['id'],
            'nim'      => $m['nim'],
            'nama'     => $m['nama'],
            'email'    => $m['email'],
            'prodi_id' => (int) $m['prodi_id'],
            'prodi'    => $m['prodi'],
            'angkatan' => (int) $m['angkatan'],
            'status'   => $m['status'],
        ];
    }

    private function error(Throwable $e, string $aksi): void
    {
        Logger::error($e->getMessage(), ['aksi' => $aksi]);
        $this->json(500, false, 'Terjadi kesalahan pada server');
    }

    // Mengirim response JSON terstruktur lalu menghentikan eksekusi
    private function json(int $code, bool $success, string $message, mixed $data = null, array $errors = []): void
    {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');

        $body = ['success' => $success, 'message' => $message, 'data' => $data];

        if (!empty($errors)) {
            $body['errors'] = $errors;
        }

        echo json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}