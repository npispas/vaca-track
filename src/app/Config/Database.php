<?php

return [
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST') ?: 'localhost',
    'database'  => getenv('DB_NAME') ?: 'vaca_track',
    'username'  => getenv('DB_USER') ?: 'root',
    'password'  => getenv('DB_PASS') ?: 'root',
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
];