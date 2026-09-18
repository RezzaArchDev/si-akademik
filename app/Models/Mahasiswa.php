<?php

class Mahasiswa
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $sql = "SELECT mahasiswa.*, dosen.nama AS nama_dosen
                FROM mahasiswa
                LEFT JOIN dosen
                ON mahasiswa.dosen_id = dosen.id
                ORDER BY mahasiswa.nama ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByNim($nim)
    {
        $sql = "SELECT mahasiswa.*, dosen.nama AS nama_dosen
                FROM mahasiswa
                LEFT JOIN dosen
                ON mahasiswa.dosen_id = dosen.id
                WHERE mahasiswa.nim = :nim";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nim' => $nim]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}