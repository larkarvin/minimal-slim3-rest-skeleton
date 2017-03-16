<?php

return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'hapiKey' => 'aaaaaaaaaaaaaa',

        // database settings
        'pdo' => [
            'dsn' => 'mysql:host=localhost;dbname=salesforce;charset=utf8',
            'username' => 'root',
            'password' => 'password',
        ],

        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__.'/../../../log/app.log',
        ],
    ],
];
