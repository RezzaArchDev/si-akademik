<?php

require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';
require_once __DIR__ . '/../app/Controllers/DosenController.php';

$url = $_GET['url'] ?? 'Mahasiswa';

$mahasiswaController = new MahasiswaController();
$dosenController = new DosenController();

if ($url === 'Mahasiswa') {

    $mahasiswaController->index();

} elseif ($url === 'Mahasiswa/detail') {

    $mahasiswaController->detail();

} elseif ($url === 'Dosen') {

    $dosenController->index();

} elseif ($url === 'Dosen/detail') {

    $dosenController->detail();

} else {

    echo "404 - Halaman tidak ditemukan";

}