<?php

$router = new Core\Router();

// Add your routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);

// Add wildcard for /controller or /controller/action methods
$router->add('{controller}');
$router->add('{controller}/{action}');
