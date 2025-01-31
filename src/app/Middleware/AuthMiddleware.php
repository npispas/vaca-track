<?php

namespace App\Middleware;

use App\Core\Auth;
use App\Core\Response;

class AuthMiddleware implements Middleware
{
    /**
     * Handle the request before proceeding to the controller.
     * Middleware classes implementing this method can enforce authentication, authorization,
     * request modifications, or any pre-processing logic.
     *
     * @return void
     */
    public function handle(): void
    {
        if (! Auth::check()) {
            Response::redirect('/login')->send();
        }
    }
}
