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
