<?php

use App\Action\Deals;

// Routes

$app->get('/', Deals::class)
    ->setName('homepage');

$app->post('/deals', Deals::class.':getDeals');
