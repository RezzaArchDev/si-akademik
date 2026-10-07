<?php
session_start();   // harus dipanggil sebelum ada output

// Autoloader sederhana: App\Folder\NamaClass -> app/Folder/NamaClass.php
spl_autoload_register(function (string $class): void {
    if (str_starts_with($class, 'App\\')) {
        $file = __DIR__ . '/../app/' . str_replace('\\', '/', substr($class, 4)) . '.php';
        if (is_file($file)) {
            require_once $file;
        }
    }
});

require_once __DIR__ . '/../routes/web.php';

use App\Core\Database;
use App\Core\Logger;
use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;
use App\Services\MahasiswaService;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$base = '/bkpm/acara14/si-akademik/public';
if (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base)) ?: '/';
}

$method = $_SERVER['REQUEST_METHOD'];

// 1. Cari route yang cocok persis
$route  = $routes[$method][$uri] ?? null;
$params = [];

// 2. Kalau tidak ada, cari route berparameter, misal /mahasiswa/5/edit
if ($route === null) {
    foreach ($routes[$method] ?? [] as $pattern => $r) {
        if (!str_contains($pattern, '{')) {
            continue;
        }
        $regex = '#^' . preg_replace('#\{\w+\}#', '(\d+)', $pattern) . '$#';
        if (preg_match($regex, $uri, $cocok)) {
            array_shift($cocok);
            $route  = $r;
            $params = array_map('intval', $cocok);
            break;
        }
    }
}

// 3. Tidak ketemu -> 404
if ($route === null) {
    http_response_code(404);
    echo "404 - Halaman tidak ditemukan";
    exit;
}

try {
    // 4. Jalankan middleware (jika ada)
    foreach ($route['middleware'] ?? [] as $mw) {
        $mwInstance = new $mw();
        $mwInstance->handle();
    }

    // 5. Siapkan controller
    if ($route[0] === 'MahasiswaController') {
        // Dependency injection: koneksi -> Repository -> Service -> Controller
        $db         = Database::getInstance();
        $service    = new MahasiswaService(new MahasiswaRepository($db), new ProdiRepository($db));
        $controller = new \App\Controllers\MahasiswaController($service);
    } else {
        $controllerClass = "App\\Controllers\\{$route[0]}";
        $controller = new $controllerClass();
    }

    // 6. Panggil method controller
    $controller->{$route[1]}(...$params);
} catch (Throwable $e) {
    // Detail error hanya masuk ke log, pengguna melihat halaman 500 yang aman
    Logger::error($e->getMessage(), ['url' => $uri, 'method' => $method]);
    http_response_code(500);
    require __DIR__ . '/../app/Views/errors/500.php';
}
