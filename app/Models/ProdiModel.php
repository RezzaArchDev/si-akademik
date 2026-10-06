<?php

namespace App\Models;

use App\Core\Model;

class ProdiModel extends Model
{
    public function all(): array
    {
        return $this->db->query("SELECT * FROM prodi ORDER BY kode")->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM prodi WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $d): void
    {
        $stmt = $this->db->prepare("INSERT INTO prodi (kode, nama) VALUES (:kode, :nama)");
        $stmt->execute(['kode' => $d['kode'], 'nama' => $d['nama']]);
    }

    public function update(int $id, array $d): void
    {
        $stmt = $this->db->prepare("UPDATE prodi SET kode = :kode, nama = :nama WHERE id = :id");
        $stmt->execute(['kode' => $d['kode'], 'nama' => $d['nama'], 'id' => $id]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM prodi WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}