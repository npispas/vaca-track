<?php

namespace App\Controllers;

use App\Core\View;

class Auth
{
    public function login(): void
    {
        View::render('login');
    }
}
