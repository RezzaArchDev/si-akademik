<?php

namespace App\Controllers;

use App\Core\BaseController;

class DashboardController extends BaseController
{
    public function index(): void
    {
        $this->view('dashboard/index');
    }
}