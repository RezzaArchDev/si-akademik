<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
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

} elseif ($url === 'dosen/create') {

    $authMiddleware->handle();
    $dosenController->create();

} elseif ($url === 'dosen/store' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $authMiddleware->handle();
    $dosenController->store();

} elseif ($url === 'dosen/edit' && isset($_GET['id'])) {

    $authMiddleware->handle();
    $dosenController->edit($_GET['id']);

} elseif ($url === 'dosen/update' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {

    $authMiddleware->handle();
    $dosenController->update($_GET['id']);

} elseif ($url === 'dosen/delete' && isset($_GET['id'])) {

    $authMiddleware->handle();
    $dosenController->delete($_GET['id']);

} else {

    http_response_code(404);
    echo "404 - Halaman tidak ditemukan";

}