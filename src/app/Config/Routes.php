<?php

use App\Core\Router;
use App\Middleware\AuthMiddleware;
use App\Middleware\HasRoleMiddleware;

$router = Router::getInstance();

$router->get('/login', 'Auth@login');
$router->post('/login', 'Auth@processLogin');
$router->get('/logout', 'Auth@logout');

$router->get('/', 'Home@index', [AuthMiddleware::class]);

$router->get('/users', 'User@index', [AuthMiddleware::class, [HasRoleMiddleware::class, 'Manager']]);
$router->get('/users/create', 'User@create', [AuthMiddleware::class, [HasRoleMiddleware::class, 'Manager']]);
$router->post('/users', 'User@store', [AuthMiddleware::class, [HasRoleMiddleware::class, 'Manager']]);
$router->get('/users/{id}/edit', 'User@edit', [AuthMiddleware::class, [HasRoleMiddleware::class, 'Manager']]);
$router->post('/users/{id}', 'User@update', [AuthMiddleware::class, [HasRoleMiddleware::class, 'Manager']]);
$router->get('/users/{id}/delete', 'User@delete', [AuthMiddleware::class, [HasRoleMiddleware::class, 'Manager']]);

$router->get('/vacations', 'Vacation@index', [AuthMiddleware::class, [HasRoleMiddleware::class, ['Manager', 'Employee']]]);
$router->get('/vacations/create', 'Vacation@create', [AuthMiddleware::class, [HasRoleMiddleware::class, 'Employee']]);
$router->post('/vacations', 'Vacation@store', [AuthMiddleware::class, [HasRoleMiddleware::class, 'Employee']]);
$router->get('/vacations/{id}/delete', 'Vacation@delete', [AuthMiddleware::class, [HasRoleMiddleware::class, 'Employee']]);
$router->get('/vacations/{id}/approve', 'Vacation@approve', [AuthMiddleware::class, [HasRoleMiddleware::class, 'Manager']]);
$router->get('/vacations/{id}/reject', 'Vacation@reject', [AuthMiddleware::class, [HasRoleMiddleware::class, 'Manager']]);
