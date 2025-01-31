<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;

class Home extends Controller
{
    public function index(): void
    {
        View::render('home/index');
    }
}
