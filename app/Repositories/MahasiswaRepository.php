<?php

namespace App\Repositories;

use App\Models\Mahasiswa;
use PDO;

class MahasiswaRepository
{
    private PDO $db;

    // Constructor injection: koneksi diberikan dari luar,
    // Repository tidak membuat koneksi sendiri.
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        $sql = "SELECT m.*, p.nama AS prodi
                FROM mahasiswa m
                JOIN prodi p ON m.prodi_id = p.id
                ORDER BY m.nim";

        return $this->db->query($sql)->fetchAll();
    }

    // Pencarian dari Acara 8
    public function search(string $keyword): array
    {
        $sql = "SELECT m.*, p.nama AS prodi
                FROM mahasiswa m
                JOIN prodi p ON m.prodi_id = p.id
                WHERE m.nama LIKE :kw_nama OR m.nim LIKE :kw_nim
                ORDER BY m.nim";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'kw_nama' => "%{$keyword}%",
            'kw_nim'  => "%{$keyword}%",
        ]);

        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT m.*, p.nama AS prodi
             FROM mahasiswa m
             JOIN prodi p ON m.prodi_id = p.id
             WHERE m.id = :id"
        );
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        return $row ?: null;
    }

    // Menerima objek Mahasiswa yang sudah tervalidasi oleh setter
    public function create(Mahasiswa $m): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan, status)
             VALUES (:nim, :nama, :email, :prodi_id, :angkatan, :status)"
        );
        $stmt->execute([
            'nim'      => $m->getNim(),
            'nama'     => $m->getNama(),
            'email'    => $m->getEmail(),
            'prodi_id' => $m->getProdiId(),
            'angkatan' => $m->getAngkatan(),
            'status'   => $m->getStatus(),
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function update(Mahasiswa $m): void
    {
        $stmt = $this->db->prepare(
            "UPDATE mahasiswa
             SET nim = :nim, nama = :nama, email = :email,
                 prodi_id = :prodi_id, angkatan = :angkatan, status = :status
             WHERE id = :id"
        );
        $stmt->execute([
            'nim'      => $m->getNim(),
            'nama'     => $m->getNama(),
            'email'    => $m->getEmail(),
            'prodi_id' => $m->getProdiId(),
            'angkatan' => $m->getAngkatan(),
            'status'   => $m->getStatus(),
            'id'       => $m->getId(),
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}