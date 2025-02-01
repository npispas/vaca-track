<?php

namespace App\Middleware;

use App\Core\Auth;
use App\Core\View;

class HasRoleMiddleware implements Middleware
{
    private array $allowedRoles;

    /**
     * Constructor to set allowed roles.
     *
     * @param array|string $roles The required role(s) to access the route
     */
    public function __construct(array|string $roles)
    {
        $this->allowedRoles = is_array($roles) ? $roles : [$roles];
    }

    /**
     * Handle the request and enforce role-based access control.
     */
    public function handle(): void
    {
        $user = Auth::user();

        if (! in_array($user->role->name, $this->allowedRoles)) {
            http_response_code(403);
            View::render('errors/403');
            die();
        }
    }
}
