<?php

require_once __DIR__ . '/../Models/Dosen.php';

class DosenController
{
    public function index()
    {
        $model = new Dosen();

        $dosenList = $model->getAll();

        require_once __DIR__ . '/../Views/Dosen/index.php';
    }

    public function detail()
    {
        $model = new Dosen();

        $nidn = $_GET['nidn'] ?? null;

        $dosen = $model->getByNidn($nidn);

        require_once __DIR__ . '/../Views/Dosen/detail.php';
    }
}