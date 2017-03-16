<?php
namespace App\Models;

use Psr\Log\LoggerInterface;
use GuzzleHttp\Client;


/**
 * Class DealsFactory.
 */
class HttpClient
{
    private $client;
    private $hapiKey;
    private $logger;

    public function __construct(LoggerInterface $logger, Client $client, $hapiKey)
    {
        $this->logger = $logger;
        $this->client = $client;
        $this->hapiKey = $hapiKey;
    }

    public function fetchDeal(Int $dealId)
    {

        $url = "URL";

        $response = $this->client->request('get', $url);
        $body = $response->getBody();

        return json_decode((string)$body, TRUE);
    }


}