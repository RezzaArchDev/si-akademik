<?php

require_once __DIR__ . '/../Models/Mahasiswa.php';

class MahasiswaController
{
    public function index()
    {
        global $pdo;
        $model = new Mahasiswa($pdo);

        $mahasiswaList = $model->getAll();

        require_once __DIR__ . '/../Views/Mahasiswa/index.php';
    }

    public function detail()
    {
        global $pdo;
        $model = new Mahasiswa($pdo);

        $nim = $_GET['nim'] ?? null;

        $mahasiswa = $model->getByNim($nim);

        require_once __DIR__ . '/../Views/Mahasiswa/detail.php';
    }
}