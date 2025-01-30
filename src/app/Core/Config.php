<?php

namespace App\Core;

/**
 * Class Config
 *
 * Handles application configuration loading and retrieval.
 */
class Config
{
    private static array $settings = [];

    /**
     * Load configuration files from the `Config/` directory.
     *
     * This method scans and loads all available config files into memory,
     * making them accessible via `Config::get()`.
     *
     * @return void
     */
    public static function load(): void
    {
        self::$settings['database'] = require __DIR__ . '/../Config/Database.php';
        self::$settings['routes'] = require __DIR__ . '/../Config/Routes.php';
        self::$settings['app'] = require __DIR__ . '/../Config/App.php';
    }

    /**
     * Retrieve a configuration value by key.
     *
     * @param string $key The configuration key to retrieve (e.g., 'database', 'routes').
     * @param mixed|null $default Default value if the key does not exist.
     * @return mixed The configuration value, or the default value if key is not found.
     */
    public static function get(string $key, string $default = null): mixed
    {
        return self::$settings[$key] ?? $default;
    }
}
