<?php

namespace Client;

use Monolog\Logger as Log;

class Logger
{
    private $logger;

    public function __construct(Log $logger)
    {
        $this->logger = $logger;
    }

    public function log(string $message)
    {
        $this->logger->info($message);
    }
}
