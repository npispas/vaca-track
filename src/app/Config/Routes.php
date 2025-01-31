<?php

use App\Core\Router;
use App\Middleware\AuthMiddleware;

$router = Router::getInstance();

$router->get('/login', 'Auth@login');
$router->post('/login', 'Auth@processLogin');
$router->get('/logout', 'Auth@logout');

$router->get('/', 'Home@index', [AuthMiddleware::class]);

$router->get('/users', 'User@index', [AuthMiddleware::class]);
$router->get('/users/create', 'User@create', [AuthMiddleware::class]);
$router->post('/users', 'User@store', [AuthMiddleware::class]);
$router->get('/users/{id}/edit', 'User@edit', [AuthMiddleware::class]);
$router->post('/users/{id}', 'User@update', [AuthMiddleware::class]);
$router->get('/users/{id}/delete', 'User@delete', [AuthMiddleware::class]);
