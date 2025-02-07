<?php

require_once __DIR__ . '/../../bootstrap.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Insert roles
Capsule::table('roles')->insert([
    [
        'name' => 'Employee',
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ],
    [
        'name' => 'Manager',
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ]
]);

// Insert test users
Capsule::table('users')->insert([
    [
        'role_id' => 1,
        'name' => 'Nikolaos Pispas',
        'email' => 'npispas@example.com',
        'username' => 'npispas',
        'employee_id' => '1000000',
        'password' => password_hash('password', PASSWORD_DEFAULT),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ],
    [
        'role_id' => 2,
        'name' => 'John Lock',
        'email' => 'john@example.com',
        'username' => 'jlock',
        'employee_id' => '1000001',
        'password' => password_hash('password', PASSWORD_DEFAULT),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ]
]);

// Insert test vacations
Capsule::table('vacations')->insert([
    [
        'user_id' => 1,
        'start_date' => '2025-02-20',
        'end_date' => '2025-02-25',
        'reason' => 'Farming',
        'status' => 'pending',
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ],
    [
        'user_id' => 1,
        'start_date' => '2025-05-01',
        'end_date' => '2025-05-10',
        'reason' => 'Easter Time',
        'status' => 'pending',
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ],
]);

echo "Seed data inserted successfully.\n";
