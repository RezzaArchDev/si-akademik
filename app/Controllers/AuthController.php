<?php

class AuthController
{
    public function showLogin()
    {
        if (!empty($_SESSION['login'])) {
            header('Location: /si-akademik/public/dashboard');
            exit;
        }

        $error = null;
        require_once __DIR__ . '/../Views/Auth/login.php';
    }

    public function process()
    {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($username === 'admin' && $password === '12345') {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;

            header('Location: /si-akademik/public/dashboard');
            exit;
        }

        $error = 'Username atau password salah.';
        require_once __DIR__ . '/../Views/Auth/login.php';
    }

    public function logout()
    {
        $_SESSION = [];
        session_unset();
        session_destroy();

        header('Location: /si-akademik/public/login');
        exit;
    }

    public function dashboard()
    {
        $username = $_SESSION['username'] ?? 'admin';
        require_once __DIR__ . '/../Views/Dashboard/index.php';
    }
}