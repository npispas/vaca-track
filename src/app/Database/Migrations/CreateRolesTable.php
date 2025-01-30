<?php

namespace App\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateRolesTable
{
    public static function up(): void
    {
        Capsule::schema()->create('roles', function ($table) {
            $table->id('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        echo "Created roles table.\n";
    }

    public static function down(): void
    {
        Capsule::schema()->dropIfExists('roles');
        echo "Rolled back roles table.\n";
    }
}
