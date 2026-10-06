<?php

namespace App\Models;

use InvalidArgumentException;

class Mahasiswa
{
    // Semua atribut private: tidak bisa diubah langsung dari luar class
    private ?int $id = null;
    private string $nim = '';
    private string $nama = '';
    private string $email = '';
    private int $prodiId = 0;
    private int $angkatan = 0;
    private string $status = 'aktif';

    // ===== GETTER =====
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNim(): string
    {
        return $this->nim;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getProdiId(): int
    {
        return $this->prodiId;
    }

    public function getAngkatan(): int
    {
        return $this->angkatan;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    // ===== SETTER (dengan validasi: langkah 5) =====
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNim(string $nim): void
    {
        $nim = trim($nim);

        if ($nim === '' || !ctype_digit($nim)) {
            throw new InvalidArgumentException('NIM harus berupa angka');
        }
        $this->nim = $nim;
    }

    public function setNama(string $nama): void
    {
        $nama = trim($nama);

        if ($nama === '') {
            throw new InvalidArgumentException('Nama tidak boleh kosong');
        }
        $this->nama = $nama;
    }

    public function setEmail(string $email): void
    {
        $email = trim($email);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Format email tidak valid');
        }
        $this->email = $email;
    }

    public function setProdiId(int $prodiId): void
    {
        if ($prodiId < 1) {
            throw new InvalidArgumentException('Program studi wajib dipilih');
        }
        $this->prodiId = $prodiId;
    }

    public function setAngkatan(int $angkatan): void
    {
        if ($angkatan < 2000 || $angkatan > (int) date('Y')) {
            throw new InvalidArgumentException('Angkatan tidak valid');
        }
        $this->angkatan = $angkatan;
    }

    public function setStatus(string $status): void
    {
        if (!in_array($status, ['aktif', 'cuti', 'lulus'], true)) {
            throw new InvalidArgumentException('Status tidak valid');
        }
        $this->status = $status;
    }
}