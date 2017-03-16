<?php

// To help the built-in PHP dev server, check if the request was actually for
// something which should probably be served as a static file
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

// Get Env variable to automatically include environment config
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? 
                                  getenv('APPLICATION_ENV') : 
                                  'local'));

// show errors when working on local
if(APPLICATION_ENV === 'local'){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

require __DIR__.'/../vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/src/Settings/'.strtolower(APPLICATION_ENV).'.settings.php';
$app = new \Slim\App($settings);


// Set up dependencies
require __DIR__.'/dependencies.php';

// Register middleware
require __DIR__.'/middleware.php';

// Register routers
$routers = glob( __DIR__.'/src/Routes/*.routes.php' );
foreach ($routers as $router) {
    require $router;
}

// Run!
$app->run();
