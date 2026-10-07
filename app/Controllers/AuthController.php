<?php

namespace App\Controllers;

class AuthController
{
    public function loginForm(): void
    {
        // Kalau sudah login, tidak perlu lihat form login lagi
        if (!empty($_SESSION['logged_in'])) {
            header('Location: /bkpm/acara13/si-akademik/public/dashboard');
            exit;
        }

        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        $content = __DIR__ . '/../Views/auth/login.php';
        require __DIR__ . '/../Views/layouts/main.php';
    }

    public function login(): void
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        // Login disimulasikan dengan hardcode (nanti diganti database)
        if ($username === 'admin' && $password === 'admin123') {
            session_regenerate_id(true);
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id']   = 1;
            $_SESSION['user_name'] = 'Admin';

            // ===== TUGAS MANDIRI =====
            $_SESSION['flash'] = [
                'type'    => 'success',
                'message' => 'Selamat datang, ' . $_SESSION['user_name'],
            ];
            // ===== AKHIR TUGAS MANDIRI =====

            header('Location: /bkpm/acara13/si-akademik/public/dashboard');
            exit;
        }

        $_SESSION['error'] = 'Username atau password salah';
        header('Location: /bkpm/acara13/si-akademik/public/login');
        exit;
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();

        // ===== TUGAS MANDIRI =====
        // session_destroy() menghapus semua data, jadi buka session baru untuk pesan
        session_start();
        session_regenerate_id(true);
        $_SESSION['flash'] = [
            'type'    => 'info',
            'message' => 'Anda telah logout',
        ];
        // ===== AKHIR TUGAS MANDIRI =====

        header('Location: /bkpm/acara13/si-akademik/public/login');
        exit;
    }
}