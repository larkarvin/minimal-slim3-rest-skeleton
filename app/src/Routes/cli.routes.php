<?php
if (!isset($argv)) {
    return;
}

use App\Action\Deals;

// use: php public/index.php /foo GET event=true
$app->get('/foo', Deals::class.':foo');

