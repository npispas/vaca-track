<?php

namespace App\Core;

use App\Models\User;

class Auth
{
    /**
     * Check if the user is logged in.
     *
     * @return bool
     */
    public static function check(): bool
    {
        return Session::has('user');
    }

    /**
     * Get the authenticated user.
     *
     * @return User|null
     */
    public static function user(): ?User
    {
        $user = Session::get('user');

        return $user->fresh();
    }

    /**
     * Attempt to log in a user.
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public static function attempt(string $username, string $password): bool
    {
        $user = User::where('username', $username)->first();

        if ($user && password_verify($password, $user->password)) {
            Session::put('user', $user);

            return true;
        }

        return false;
    }

    /**
     * Log out the user.
     *
     * @return void
     */
    public static function logout(): void
    {
        Session::remove('user');
        Session::destroy();
    }
}
