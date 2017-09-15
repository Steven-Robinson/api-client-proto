<?php

namespace Client;

use Symfony\Component\EventDispatcher\EventDispatcher;

class Listener
{
    protected $eventDispatcher;

    private $logger;

    public function __construct(EventDispatcher $eventDispatcher, Logger $logger)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->logger = $logger;
    }

    public function onBootstrapComplete()
    {
        $this->logger->log('Application bootstrap complete... Triggered from event.');
    }
}
