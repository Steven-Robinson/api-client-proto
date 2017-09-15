<?php

namespace Client;

use Symfony\Component\EventDispatcher\EventDispatcher;

class EventManager
{
    const BOOTSTRAPPED_EVENT = 'app.bootstrap.complete';

    private $eventDispatcher;

    private $listener;

    public function __construct(EventDispatcher $eventDispatcher, Listener $listener)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->listener = $listener;

        $this->assignListeners();
    }

    public function fire(string $event)
    {
        $this->eventDispatcher->dispatch($event);
    }

    public function assignListeners()
    {
        $this->eventDispatcher->addListener(self::BOOTSTRAPPED_EVENT, [
            $this->listener,
            'onBootstrapComplete'
        ]);
    }
}
