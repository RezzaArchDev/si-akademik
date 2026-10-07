<?php

namespace App\Controllers;

class HomeController
{
    public function index(): void
    {
        echo "<h1>Selamat datang di SI Akademik</h1>";
        echo "<p><a href='/bkpm/acara15/si-akademik/public/dashboard'>Masuk ke Dashboard</a> | <a href='/bkpm/acara15/si-akademik/public/login'>Login</a></p>";
    }
}