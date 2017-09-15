<?php

namespace Client;

class Listener
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function onBootstrapComplete()
    {
        $this->logger->log('Application bootstrap complete... Triggered from event.');
    }
}
