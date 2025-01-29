<?php

namespace App\Controllers;

use App\Core\View;

class Auth
{
    public function login()
    {
        return View::render('login');
    }
}
