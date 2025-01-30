<?php

use App\Core\Router;

$router = Router::getInstance();

$router->get('/login', 'Auth@login');

$router->get('/users', 'User@index');
$router->get('/users/create', 'User@create');
$router->post('/users', 'User@store');
$router->get('/users/{id}/edit', 'User@edit');
$router->post('/users/{id}', 'User@update');
$router->get('/users/{id}/delete', 'User@delete');
