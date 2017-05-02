<?php

// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
if(isset($argv)){
    $app->add(new App\Middleware\CliRequest());
}



