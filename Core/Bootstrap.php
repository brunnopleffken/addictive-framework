<?php

/**
 * Set database connection throughout the application lifecycle.
 */
Core\Model::connection();

/**
 * Dispatch the route, creating the controller object and running the
 * action method.
 */
$router->dispatch($_SERVER['QUERY_STRING']);
