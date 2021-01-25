<?php

/**
 * Composer
 */
require 'vendor/autoload.php';

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Get main framework bootstrapper.
 */
require 'App/Routes.php';
require 'Core/Bootstrap.php';
