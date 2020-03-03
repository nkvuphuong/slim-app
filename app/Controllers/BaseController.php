<?php


namespace App\Controllers;


use Psr\Log\LoggerInterface;

class BaseController
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}