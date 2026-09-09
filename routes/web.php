<?php

require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';
require_once __DIR__ . '/../app/Controllers/DosenController.php';

$url = strtolower($_GET['url'] ?? 'mahasiswa');

$mahasiswaController = new MahasiswaController();
$dosenController = new DosenController();

if ($url === 'mahasiswa') {

    $mahasiswaController->index();

} elseif ($url === 'mahasiswa/detail') {

    $mahasiswaController->detail();

} elseif ($url === 'dosen') {

    $dosenController->index();

} elseif ($url === 'dosen/detail') {

    $dosenController->detail();

} else {

    echo "404 - Halaman tidak ditemukan";

}