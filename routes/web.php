<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Middleware/AuthMiddleware.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';
require_once __DIR__ . '/../app/Controllers/DosenController.php';

$url = strtolower(trim($_GET['url'] ?? '', '/'));

$authController = new AuthController();
$mahasiswaController = new MahasiswaController();
$dosenController = new DosenController();
$authMiddleware = new AuthMiddleware();

if ($url === '' || $url === 'login') {

    $authController->showLogin();

} elseif ($url === 'login/process') {

    $authController->process();

} elseif ($url === 'logout') {

    $authController->logout();

} elseif ($url === 'dashboard') {

    $authMiddleware->handle();
    $authController->dashboard();

} elseif ($url === 'mahasiswa') {

    $authMiddleware->handle();
    $mahasiswaController->index();

} elseif ($url === 'mahasiswa/detail') {

    $authMiddleware->handle();
    $mahasiswaController->detail();

} elseif ($url === 'dosen') {

    $authMiddleware->handle();
    $dosenController->index();

} elseif ($url === 'dosen/detail') {

    $authMiddleware->handle();
    $dosenController->detail();

} else {

    http_response_code(404);
    echo "404 - Halaman tidak ditemukan";

}