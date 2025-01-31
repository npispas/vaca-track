<?php

namespace App\Controllers;

use App\Core\Auth as AuthProvider;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;

class Auth extends Controller
{
    public function login(): void
    {
        if (AuthProvider::check()) {
            Response::redirect('/')->send();
        }

        View::render('auth/login');
    }

    public function processLogin(): void
    {
        $errors = Request::validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if ($errors) {
            Response::redirect('/login')->with('errors', $errors)->send();
        }

        $data = Request::all();

        if (AuthProvider::attempt($data['username'], $data['password'])) {
            Response::redirect('/')->send();
        }

        Response::redirect('/login')->with('errors', ['User' => ['User not found!']])->send();
    }

    public function logout(): void
    {
        AuthProvider::logout();

        Response::redirect('/login')->send();
    }
}
