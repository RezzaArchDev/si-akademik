<?php

class AuthMiddleware
{
    public function handle()
    {
        if (empty($_SESSION['login'])) {
            header('Location: /si-akademik/public/login');
            exit;
        }
    }
}