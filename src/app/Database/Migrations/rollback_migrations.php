<?php

require_once __DIR__ . '/../../bootstrap.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Get the latest migration
$latestMigration = Capsule::table('migrations')->orderBy('id', 'desc')->first();

if (!$latestMigration) {
    echo "No migrations to rollback.\n";
    exit;
}

$migrationClass = $latestMigration->migration;
$migrationPath = __DIR__ . "/$migrationClass.php";

if (!file_exists($migrationPath)) {
    echo "Migration file missing: $migrationClass\n";
    exit;
}

// Rollback the migration
require_once $migrationPath;
$className = "\\App\\Database\\Migrations\\$migrationClass";
$className::down();

// Remove from migrations table
Capsule::table('migrations')->where('migration', $migrationClass)->delete();

echo "Rolled back: $migrationClass\n";
