<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Core/Config.php';
require_once __DIR__ . '/Core/Database.php';
require_once __DIR__ . '/Config/Routes.php';

use App\Core\Config;
use App\Core\Database;

// Load Configurations
Config::load();

// Initialize the Singleton Database Connection
Database::getInstance();
