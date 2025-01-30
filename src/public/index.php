<?php

require_once '../app/bootstrap.php';

use App\Core\Router;

// Get a singleton instance of the Router and dispatch request to the appropriate controller and method
$router = Router::getInstance();
$router->dispatch();
