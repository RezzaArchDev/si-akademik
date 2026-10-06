<?php

namespace App\Core;

abstract class BaseController
{
    // Menampilkan sebuah view di dalam layout utama
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        $content = __DIR__ . '/../Views/' . $view . '.php';
        require __DIR__ . '/../Views/layouts/main.php';
    }

    // Mengarahkan pengguna ke URL lain
    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
}