<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class Database
 *
 * Manages the database connection using a singleton pattern.
 */
class Database
{
    private static $capsule = null;

    /**
     * Get the database connection instance.
     *
     * @return Capsule
     */
    public static function getInstance(): Capsule
    {
        if (self::$capsule === null) {
            self::$capsule = new Capsule();
            self::$capsule->addConnection(Config::get('database'));
            self::$capsule->setAsGlobal();
            self::$capsule->bootEloquent();
        }
        return self::$capsule;
    }
}
