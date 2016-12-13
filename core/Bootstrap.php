<?php

namespace Core;

use Core\Http\Router;

class Bootstrap
{
    public function __construct()
    {
        // Define global constants
        define('ROOT', __DIR__ . '/../');

        // Poll framework helpers
		require_once 'helpers.php';

        // Initialize routing system
        $route = new Router();
        $route->execute();
    }
}
