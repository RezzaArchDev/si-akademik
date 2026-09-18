<?php

require_once __DIR__ . '/../Models/Dosen.php';

class DosenController
{
    public function index()
    {
        global $pdo;
        $model = new Dosen($pdo);

        $dosenList = $model->getAll();

        require_once __DIR__ . '/../Views/Dosen/index.php';
    }

    public function detail()
    {
        global $pdo;
        $model = new Dosen($pdo);

        $nidn = $_GET['nidn'] ?? null;

        $dosen = $model->getByNidn($nidn);

        require_once __DIR__ . '/../Views/Dosen/detail.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../Views/Dosen/create.php';
    }

    public function store()
    {
        global $pdo;
        $model = new Dosen($pdo);

        $model->create([
            'nidn' => $_POST['nidn'],
            'nama' => $_POST['nama'],
            'bidang_keahlian' => $_POST['bidang_keahlian']
        ]);

        header('Location: /si-akademik/public/dosen');
        exit;
    }

    public function edit($id)
    {
        global $pdo;
        $model = new Dosen($pdo);

        $dosen = $model->getById($id);

        require_once __DIR__ . '/../Views/Dosen/edit.php';
    }

    public function update($id)
    {
        global $pdo;
        $model = new Dosen($pdo);

        $model->update($id, [
            'nidn' => $_POST['nidn'],
            'nama' => $_POST['nama'],
            'bidang_keahlian' => $_POST['bidang_keahlian']
        ]);

        header('Location: /si-akademik/public/dosen');
        exit;
    }

    public function delete($id)
    {
        global $pdo;
        $model = new Dosen($pdo);

        $model->delete($id);

        header('Location: /si-akademik/public/dosen');
        exit;
    }
}