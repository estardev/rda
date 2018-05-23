<?php
/**
 * Created by PhpStorm.
 * User: francesco.galli
 * Date: 12/03/2018
 * Time: 15:09
 */

namespace estar\rda\RdaBundle\Services;

use Monolog\Logger as Logger;


class RdaLogger
{
    private $logger;

    /**
     * Costruttore
     * @param Logger $logger
     *
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function log($message){

        $this->logger->info($message);
    }



}