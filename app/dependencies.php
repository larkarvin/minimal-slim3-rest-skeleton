<?php

use App\Action\Deals;
use App\Models\DealsModel;
use App\Models\HttpClient;
use GuzzleHttp\Client;


$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['logger']['path'], Monolog\Logger::DEBUG));

    return $logger;
};

// Database
$container['pdo'] = function ($c) {
    $settings = $c->get('settings')['pdo'];

    return new PDO($settings['dsn'], $settings['username'], $settings['password']);
};

// HTTP Client


$container[App\Models\HttpClient::class] = function ($c) {
    $hapiKey = $c->get('settings')['hapiKey'];
    return new HttpClient($c->get('logger'),
                    new GuzzleHttp\Client(),
                    $hapiKey);
};

// Test

$container[App\Models\DealsModel::class] = function ($c) {
    return new DealsModel($c->get('logger'), $c->get('pdo'));
};


$container[App\Action\Deals::class] = function ($c) {
    return new Deals($c->get('logger'),
                         $c->get('App\Models\DealsModel'),
                         $c->get('App\Models\HttpClient'));
};
