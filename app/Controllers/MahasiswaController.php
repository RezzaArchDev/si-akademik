<?php

require_once __DIR__ . '/../Models/Mahasiswa.php';

class MahasiswaController
{
    public function index()
    {
        $model = new Mahasiswa();

        $mahasiswaList = $model->getAll();

        require_once __DIR__ . '/../Views/Mahasiswa/index.php';
    }

    public function detail()
    {
        $model = new Mahasiswa();

        $nim = $_GET['nim'] ?? null;

        $mahasiswa = $model->getByNim($nim);

        require_once __DIR__ . '/../Views/Mahasiswa/detail.php';
    }
}