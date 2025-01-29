<?php

use App\Core\Router;

$router = Router::getInstance();

$router->get('/login', 'Auth@login');
