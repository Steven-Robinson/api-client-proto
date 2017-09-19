<?php

namespace Client;

use Psr\Log\LoggerInterface;

class Logger
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function log(string $message)
    {
        $this->logger->info($message);
    }
}
