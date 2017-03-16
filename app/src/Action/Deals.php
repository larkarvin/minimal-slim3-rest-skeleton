<?php

namespace App\Action;

use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Deals;

/**
 * Class HomeAction.
 */
final class Deals
{

    private $logger;
    private $dealsModel;
    private $httpClient;

    public function __construct(LoggerInterface $logger, $dealsModel, $httpClient)
    {
        $this->logger = $logger;
        $this->dealsModel = $dealsModel;
        $this->httpClient = $httpClient; // example of injecting 

    }

    public function getDeals(Request $request, Response $response, $args)
    {

        $this->logger->info("Chrome Deals '/' route");
        $queryParams = $request->getQueryParams();

        // Get Body
        $body = $request->getParsedBody();

        if(!isset($body['dealIds']) && count($body['dealIds']) == 0){
            return $response
                ->withJson(
                    ['result' => false, 
                    'message'=>'dealsIds are missing in request body'])
                ->withStatus(501);;
        }
        $dealIds = $body['dealIds'];

        $result = $this->dealsModel->getDeals($dealIds);

        // example
        foreach($result as $row){

            $responseArray[] = [
                                'dealId' => (int)$row['dealId'],
                                'dealName' => $row['dealName']
                                ];
        }

        return $response->withJson(['result' => true, 'deals' => $responseArray])
                        ->withHeader('Content-type', 'application/json')
                        ->withHeader('Access-Control-Allow-Origin', '*')
                        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                        ->withHeader('Access-Control-Allow-Methods', 'POST, PUT, DELETE, OPTIONS')
                        ->withStatus(200);
    }


}