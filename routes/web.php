<?php

use App\Core\Middleware\AuthMiddleware;

$auth = [AuthMiddleware::class];

$routes = [
    'GET' => [
        '/'                      => ['HomeController', 'index'],
        '/login'                 => ['AuthController', 'loginForm'],
        '/logout'                => ['AuthController', 'logout'],
        '/dashboard'             => ['DashboardController', 'index', 'middleware' => $auth],

        '/mahasiswa'             => ['MahasiswaController', 'index',  'middleware' => $auth],
        '/mahasiswa/create'      => ['MahasiswaController', 'create', 'middleware' => $auth],
        '/mahasiswa/{id}'        => ['MahasiswaController', 'show',   'middleware' => $auth],
        '/mahasiswa/{id}/edit'   => ['MahasiswaController', 'edit',   'middleware' => $auth],

        '/prodi'                 => ['ProdiController', 'index',  'middleware' => $auth],
        '/prodi/create'          => ['ProdiController', 'create', 'middleware' => $auth],
        '/prodi/{id}/edit'       => ['ProdiController', 'edit',   'middleware' => $auth],

        '/matakuliah'            => ['MatakuliahController', 'index',  'middleware' => $auth],
        '/matakuliah/create'     => ['MatakuliahController', 'create', 'middleware' => $auth],
        '/matakuliah/{id}/edit'  => ['MatakuliahController', 'edit',   'middleware' => $auth],

        '/api/mahasiswa'         => ['ApiMahasiswaController', 'index'],
    ],
    'POST' => [
        '/login'                  => ['AuthController', 'login'],

        '/mahasiswa'              => ['MahasiswaController', 'store',   'middleware' => $auth],
        '/mahasiswa/{id}/update'  => ['MahasiswaController', 'update',  'middleware' => $auth],
        '/mahasiswa/{id}/delete'  => ['MahasiswaController', 'destroy', 'middleware' => $auth],

        '/prodi'                  => ['ProdiController', 'store',   'middleware' => $auth],
        '/prodi/{id}/update'      => ['ProdiController', 'update',  'middleware' => $auth],
        '/prodi/{id}/delete'      => ['ProdiController', 'destroy', 'middleware' => $auth],

        '/matakuliah'             => ['MatakuliahController', 'store',   'middleware' => $auth],
        '/matakuliah/{id}/update' => ['MatakuliahController', 'update',  'middleware' => $auth],
        '/matakuliah/{id}/delete' => ['MatakuliahController', 'destroy', 'middleware' => $auth],

        '/api/mahasiswa'          => ['ApiMahasiswaController', 'store'],
    ],
];