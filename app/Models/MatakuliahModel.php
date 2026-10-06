<?php

namespace App\Models;

use App\Core\Model;

class MatakuliahModel extends Model
{
    public function all(): array
    {
        $sql = "SELECT mk.*, p.nama AS prodi
                FROM matakuliah mk
                JOIN prodi p ON mk.prodi_id = p.id
                ORDER BY mk.kode";

        return $this->db->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM matakuliah WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $d): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO matakuliah (kode, nama, sks, prodi_id)
             VALUES (:kode, :nama, :sks, :prodi_id)"
        );
        $stmt->execute([
            'kode'     => $d['kode'],
            'nama'     => $d['nama'],
            'sks'      => $d['sks'],
            'prodi_id' => $d['prodi_id'],
        ]);
    }

    public function update(int $id, array $d): void
    {
        $stmt = $this->db->prepare(
            "UPDATE matakuliah
             SET kode = :kode, nama = :nama, sks = :sks, prodi_id = :prodi_id
             WHERE id = :id"
        );
        $stmt->execute([
            'kode'     => $d['kode'],
            'nama'     => $d['nama'],
            'sks'      => $d['sks'],
            'prodi_id' => $d['prodi_id'],
            'id'       => $id,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM matakuliah WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}