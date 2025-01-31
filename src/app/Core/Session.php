<?php

namespace App\Core;

/**
 * Class SessionHandler
 *
 * Manages session data, including flash messages.
 */
class Session
{
    /**
     * Start session if not already started.
     */
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Store a value in session.
     *
     * @param string $key The session key
     * @param mixed $value The value to store
     */
    public static function put(string $key, mixed $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Retrieve a session value.
     *
     * @param string $key The session key
     * @param mixed|null $default Default value if key does not exist
     * @return mixed The session value or default
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Check if a session key exists.
     *
     * @param string $key The session key
     * @return bool True if exists, false otherwise
     */
    public static function has(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    /**
     * Remove a session key.
     *
     * @param string $key The session key to remove
     */
    public static function remove(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    /**
     * Completely destroy the session and remove all stored data.
     */
    public static function destroy(): void
    {
        self::start();

        $_SESSION = [];

        session_destroy();
    }

    /**
     * Set a flash message.
     *
     * @param string $key The type of message (e.g., 'success', 'error')
     * @param array|string $value The value content
     */
    public static function flash(string $key, array|string $value): void
    {
        self::start();
        $_SESSION['flash'][$key] = $value;
    }

    /**
     * Retrieve and clear flash messages from session.
     *
     * @return array|null Flash messages, or null if none exist
     */
    public static function getFlashMessages(): ?array
    {
        self::start();

        if (! isset($_SESSION['flash'])) {
            return null;
        }

        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);

        return $flash;
    }
}
