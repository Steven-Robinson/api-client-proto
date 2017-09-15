<?php

namespace Client;

use Monolog\Handler\StreamHandler as MonologStreamHandler;
use Monolog\Logger as MonologLogger;
use Pimple\Container;
use Symfony\Component\EventDispatcher\EventDispatcher;

class App extends Container
{
    const LOG_FILE_LOCATION = '/logs/app.log';

    private $appRoot;

    public function __construct(string $appRoot)
    {
        $this->appRoot = $appRoot;

        $this->setupAppConfig();
        $this->setupAppObjects();
    }

    private function setupAppConfig()
    {
        $this['log-location'] = $this->appRoot . self::LOG_FILE_LOCATION;
    }

    private function setupAppObjects()
    {
        $this['event.dispatcher'] = function (Container $c) {
            return new EventDispatcher();
        };

        $this['app.logger'] = function (Container $c) {
            $monolog = new MonologLogger('API client logger');
            $monolog->pushHandler(new MonologStreamHandler($c['log-location'], MonologLogger::INFO));

            return new Logger($monolog);
        };

        $this['event.listener'] = function (Container $c) {
            return new Listener(
                $c['event.dispatcher'],
                $c['app.logger']
            );
        };

        $this['event.manager'] = function (Container $c) {
            return new EventManager(
                $c['event.dispatcher'],
                $c['event.listener']
            );
        };
    }
}
