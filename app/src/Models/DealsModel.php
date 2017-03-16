<?php

namespace App\Models;

// use App\Models\HubSpotClient;
use Psr\Log\LoggerInterface;
use PDO;

/**
 * Class DealsFactory.
 */
class DealsModel
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param \PDO                     $pdo
     */
    public function __construct(LoggerInterface $logger, PDO $pdo)
    {
        $this->logger = $logger;
        $this->pdo = $pdo;
    }

    public function getDeals(Array $dealIds)
    {

        $dealIdsStr = implode(",", $dealIds);
        $query = "SELECT 
                    *
                  FROM deals 
                  WHERE deals_id IN ({$dealIdsStr})
                  ";



        $statement = $this->pdo->prepare($query);
        $statement->execute();

        if($statement->rowCount() == 0){
            return FALSE;
        }

        return $statement->fetchAll();

    }



}
