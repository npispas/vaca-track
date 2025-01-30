<?php

require_once __DIR__ . '/../../bootstrap.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Ensure the migrations table exists
if (! Capsule::schema()->hasTable('migrations')) {
    Capsule::schema()->create('migrations', function ($table) {
        $table->id();
        $table->string('migration');
        $table->timestamp('created_at')->default(Capsule::raw('CURRENT_TIMESTAMP'));
    });
}

// Get all migration files
$dir = __DIR__;
$migrationFiles = glob("$dir/*.php");

// Get applied migrations
$appliedMigrations = Capsule::table('migrations')->pluck('migration')->toArray();

foreach ($migrationFiles as $migration) {
    $migrationClass = pathinfo($migration, PATHINFO_FILENAME);

    if ($migrationClass !== 'run_migrations' && $migrationClass !== 'rollback_migrations' && !in_array($migrationClass, $appliedMigrations)) {
        echo "Running migration: $migrationClass\n";
        require_once $migration;
        $className = "\\App\\Database\\Migrations\\$migrationClass";
        $className::up();

        // Store migration in database
        Capsule::table('migrations')->insert(['migration' => $migrationClass]);
    }
}

echo "All migrations completed successfully.\n";
