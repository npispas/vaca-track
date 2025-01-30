<?php

namespace App\Core;

/**
 * Class Controller
 *
 * Base controller that handles session management.
 * All controllers should extend this class.
 */
class Controller
{
    public function __construct()
    {
        Session::start();
    }
}
