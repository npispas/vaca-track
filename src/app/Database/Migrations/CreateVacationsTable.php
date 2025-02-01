<?php

namespace App\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateVacationsTable
{
    public static function up(): void
    {
        Capsule::schema()->create('vacations', function ($table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('reason');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });

        echo "Created vacations table.\n";
    }

    public static function down(): void
    {
        Capsule::schema()->dropIfExists('vacations');
        echo "Rolled back vacations table.\n";
    }
}
