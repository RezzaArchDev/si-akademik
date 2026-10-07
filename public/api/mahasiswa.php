<?php

require_once __DIR__ . '/../../app/Core/Database.php';
require_once __DIR__ . '/../../app/Core/Logger.php';

use App\Core\Database;
use App\Core\Logger;

// Memberi tahu client bahwa response berupa JSON
header('Content-Type: application/json; charset=utf-8');

try {
    $pdo  = Database::getInstance();
    $stmt = $pdo->query("SELECT id, nim, nama, email FROM mahasiswa ORDER BY id");
    $data = $stmt->fetchAll();

    echo json_encode([
        'success' => true,
        'message' => 'Data berhasil diambil',
        'data'    => $data,
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    Logger::error($e->getMessage(), ['aksi' => 'api/mahasiswa.php']);
    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan pada server',
        'data'    => null,
    ], JSON_PRETTY_PRINT);
}