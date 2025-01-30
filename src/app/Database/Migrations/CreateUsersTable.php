<?php

namespace App\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateUsersTable {
    public static function up(): void
    {
        Capsule::schema()->create('users', function ($table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->char('employee_id', 7)->unique()->nullable();
            $table->string('password')->default('');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('RESTRICT');
        });

        echo "Created users table.\n";
    }

    public static function down(): void
    {
        Capsule::schema()->dropIfExists('users');
        echo "Rolled back users table.\n";
    }
}